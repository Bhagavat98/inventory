<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use PDF;
use Illuminate\Support\Facades\Log;
use Mail;


class DeliveryChallanController extends Controller
{     
  public function __construct()
  {
      $this->middleware('auth');
  }
  /*
     load view Device index
  */
  public function index(){

    $challan_no = DB::table('challan_no')
            ->max('id');
    if (empty($challan_no)) { // if first time table has empty
    	$challan_no = '1000'; 
    }else {
    	$challan_no = $challan_no+1;
    }

    // customer list
    $customerList = DB::table('customer')
                   ->get();


    $deviceList = DB::table('device')
                  ->where([['features_allowed','!=',SOFT_DELETE_FLAG],['features_allowed','!=',REMOVE_FROM_STACK]]) //SOFT_DELETE_FLAG 
                  ->get();

    $simList = DB::table('sim')
                  ->where([['features_allowed','!=',SOFT_DELETE_FLAG],['features_allowed','!=',REMOVE_FROM_STACK]]) //SOFT_DELETE_FLAG 
                  ->get();

     $otherstock=DB::table('other_stock')
         ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
         ->get();

      foreach ($otherstock as  $value) {
        $value->available_stock = abs($value->quantity - $value->sold_stock);
      }
     // dd($otherstock);
  

   	return view('deliveryChallan',['challan_no'=>$challan_no,'deviceList'=>$deviceList,'simList'=>$simList,'customerList'=>$customerList,'otherstock'=>$otherstock]);
  }
  /*
  *
  * delivery Challan create
  **
  *
  */
  public function create(Request $request){

    Log::info("create():"); 

  	$challan_no = DB::table('challan_no')
            ->max('id');

    if (empty($challan_no)) { // if first time table has empty
    	$challan_no = '1000'; 
    }else {
    	$challan_no = $challan_no+1;
    }


   	$created_by = Auth::user()->id; //$request['created_by'];
    $created_date = $request['created_date'];
    $delivery_challan_description = $request['delivery_challan_description'];
    $gst = $request['gst'];
    $payment_status =  'complete';//$request['payment_status'];
    $sumtotal = $request['sumtotal'];
    $customerID =  $request['customerList'];
    $customer_email = DB::table('customer')->where('id',$customerID)->value('email');
    

    Log::info("create():  Parameter:- customer_email = $customer_email, customerID =$customerID created_by = $created_by, created_date= $created_date, delivery_challan_description = $delivery_challan_description, gst= $gst, sumtotal=$sumtotal,"); 
     
   	$insertArr = array();
    for ($i=0;$i<count($request['items']); $i++) { 
        
            if (!empty($request['items'][$i])  && $request['price'][$i] != null) 
            {

            	# code...
              $items_t = (int) $request['items'][$i];
              Log::info("create(): in for loop  items = $items_t"); 

	            $insertArr[]=array('items' =>$request['items'][$i],
        	            				   'item_type'=>$request['item_type'][$i],
                                 'other_stock_id'=>(int)$request['stock_id'][$i],
        	            				   'price'=>(int) $request['price'][$i],
        	            				   'quantity'=>(int)$request['quantity'][$i],
        	            				   'challan_no'=>$challan_no,
        	            				   'updated_at'=>date('Y-m-d H:i:s')
        	            				   );
	        }
	    }


    if (!empty($insertArr)) {
    Log::info("create(): in for loop  items = $items_t");
   			 try { 
                //print_r($insertArr);
		            $insertGetId = DB::table('challan_no')
    		            			    ->insertGetId(['status'=>$payment_status,
              		            						  'created_by'=>Auth::user()->id,
              		            						  'description'=>$delivery_challan_description,
              		            						  'gst'=>$gst,
                                            'payment_status'=>$request['payment_status'],
                                            'customer_id'=>$customerID,
              		            						  'total'=>(int)$sumtotal
              		            						]);

                Log::info("create():  challan_no insert id  = $insertGetId");

		            $insert = DB::table('delivery_challan')
		            ->insert($insertArr);

                Log::info("create():  delivery_challan  insert id = $insert");
                $updateDevice = null;
		            // device/sim stock maintenance
		            foreach ($insertArr as $value) {
		                
		                if ($value['item_type'] == 'Device'  && !empty($value['items'])) { // Device table remove from stock
		                		
                      Log::info("create():  items item_type Device ");
		                	$updateDevice = DB::table('device')
		                	->where('imei',$value['items'])
		                	->update(['features_allowed'=>REMOVE_FROM_STACK,'customer_id'=>$customerID,'email'=>$customer_email]);

		                }else if ($value['item_type'] == 'Sim' && !empty($value['items'])) {// sim table remove from stock
		                	
                      Log::info("create():  items item_type Sim ");
		                	$updateDevice = DB::table('sim')
		                	->where('sim_no',$value['items'])
		                	->update(['features_allowed'=>REMOVE_FROM_STACK,'customer_id'=>$customerID,'email'=>$customer_email]);

		                }else if($value['item_type'] == 'Other' && !empty($value['items'])){

                      Log::info("create():  items item_type Other other_stock_id =  ".$value['other_stock_id']." ");

                      $lastSold_stock = DB::table('other_stock')
                      ->where('id',$value['other_stock_id'])
                      ->value('sold_stock');

                      $sold_stock = abs($lastSold_stock + $value['quantity']);
                      
                      //stock_id
                      $updateDevice = DB::table('other_stock')
                      ->where('id',$value['other_stock_id'])
                      ->update(['sold_stock'=>$sold_stock]);

                    }
		            }

                Log::info("create():  updateDevice =$updateDevice");
		            return redirect('DeliveryChallan/show')->with('success','Delivery Challan Create Successfully.');

		        } catch (\Exception $e) {
              Log::error("error catch");
		              \Session::flash('error', $e->getMessage());
		              return redirect('DeliveryChallan');
		        }
    }




  }

  /*
  *
  * delivery Challan show
  **
  *
  */
  public function show(Request $request){

  	$challanList = DB::table('challan_no')
            ->leftJoin('customer','challan_no.customer_id','customer.id')
            ->select('challan_no.*','customer.name')
  			    ->get();


    $challan = DB::table('challan_no')
              ->leftJoin('users','challan_no.created_by','users.id')
              ->leftJoin('customer','challan_no.customer_id','customer.id')
              ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
              ->orderBy('challan_no.created_at','DESC')
              ->get();


    //dd($challan);
  	return view('showDeliveryChallan',['challan'=>$challan,'challanList'=>$challanList,'filterBy'=>'7']);
		            		

  }

  /*
  *
  *
  *
  * FROM DATE view show
  */
  public function showFromDate(Request $request){


    $filterBy = $request['filterBy'];

    
    if ($filterBy == '1') {
      
      //echo die("today's ");
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                ->whereDate('challan_no.created_at', Carbon::today())
                ->get();
      $filterByName = "Today's";
   
    }else if ($filterBy == '7') {
    
      //echo die("last week ");
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                ->whereBetween('challan_no.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();

      $filterByName = "Last Week";

    }else if($filterBy == '15'){
    
      $last15day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                ->where('challan_no.created_at', '>=', $last15day)
                ->get();

      $filterByName = "Last 15 Day";

    }else if($filterBy == '31'){
    
      //echo die("one month "); 
      $last31day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                ->where('challan_no.created_at', '>=', $last31day)
                ->get();

      $filterByName = "Last 1 Month";

    }else if($filterBy == '182'){
    
      //echo die("six month's "); 
      $last182day = \Carbon\Carbon::today()->subDays(182);
      //echo die("15 day's ");
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
               ->where('challan_no.created_at', '>=', $last182day)
               ->get();

      $filterByName = "Last 6 Month";

    }else if($filterBy == '365'){
    
      //echo die("six month's "); 
      $last365day = \Carbon\Carbon::today()->subDays(365);
      //echo die("15 day's ");
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                ->where('challan_no.created_at', '>=', $last365day)
                ->get();
      
      $filterByName = "Last 1 Year";

    }else if($filterBy == 'all'){
  
      //echo die("All");
      // $challan = DB::table('challan_no')
      //                      ->get();
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                
                ->get();

      
      $filterByName = "All";

    }else{
      //echo die("today's "); // defulat
      $challan = DB::table('challan_no')
                ->leftJoin('users','challan_no.created_by','users.id')
                ->leftJoin('customer','challan_no.customer_id','customer.id')
                ->select('challan_no.*','users.name as created_by_name','customer.name as customer_name','customer.email as customer_email')
                ->whereBetween('challan_no.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();

      $filterByName = "Last Week Defulat";
    } 


    $challanList = DB::table('challan_no')
            ->leftJoin('customer','challan_no.customer_id','customer.id')
            ->select('challan_no.*','customer.name')
            ->get();

          

    if (!empty($challan)) { // if not empty

      return view('showDeliveryChallan',['challan'=>$challan,'challanList'=>$challanList,'filterBy'=>$filterBy]);

    }else{

      return view('showDeliveryChallan',['challan'=>$challanList,'challanList'=>$challanList,'filterBy'=>$filterBy])->with('error',''.$filterByName.'  Not Found.  please try Other.');
    }

    
  }

  /*
  *
  *
  *
  * Download Invoice Format pdf Challan 
  */
  public function downloadPDF(Request $request, $challan_no){

      set_time_limit(500); // 
      // challan info 
      $challanINFO = DB::table('challan_no as cn')
                    ->leftJoin('customer as c','cn.customer_id','c.id')
                    ->select('cn.*','c.name','c.mobile','c.email','c.address','c.billing_code')
                    ->where('cn.id',$challan_no)
                    ->first();

      // challan items 
      $challanItems = DB::table('delivery_challan')
                    ->where('challan_no',$challan_no)
                    ->get();



     ///dd($challanINFO);
    // return view('pdf.DeliveryChallanPdf',['challanINFO'=>$challanINFO,'challanItems'=>$challanItems]);
    $pdf = PDF::loadView('pdf.DeliveryChallanPdf',['challanINFO'=>$challanINFO,'challanItems'=>$challanItems]);
    //$pdf = PDF::loadView('pdf.DeliveryChallanPdf');
     return $pdf->download('PaymentInvoice.pdf');
  }


    /*
  *
  *
  *
  *  print Challan 
  */
  public function printChallan(Request $request, $challan_no){

      // challan info 
      $challanINFO = DB::table('challan_no as cn')
                    ->leftJoin('customer as c','cn.customer_id','c.id')
                    ->select('cn.*','c.name','c.mobile','c.email','c.address','c.billing_code')
                    ->where('cn.id',$challan_no)
                    ->first();

      // challan items 
      $challanItems = DB::table('delivery_challan')
                    ->where('challan_no',$challan_no)
                    ->get();


    return view('pdf.DeliveryChallanPdf',['challanINFO'=>$challanINFO,'challanItems'=>$challanItems]);

  }

    /*
  *
  *
  *
  *  delivery Challan Status Update
  */
  public function deliveryChallanStatusUpdate(Request $request){ 
    
    Log::info("deliveryChallanStatusUpdate() ");

    $id = $request['id'];
    $payment_status = $request['payment_status'];
    $payment_status_desc = $request['payment_status_desc'];

    if(empty($payment_status) || empty($id)){
      Log::error("deliveryChallanStatusUpdate() invaild Parameter.  please try agen.");
      return redirect('DeliveryChallan/show')->with('error','invaild Parameter.  please try agen.');
    }

    $updateStatus = DB::table('challan_no')
                    ->where('id',$id)
                    ->update(['payment_status'=>$payment_status,'payment_status_desc'=>$payment_status_desc,'created_by'=>Auth::user()->id]);

    if ($updateStatus) {

     Log::info("deliveryChallanStatusUpdate() ".$id." Hase Been Successfully Update. ");
     return redirect('DeliveryChallan/show')->with('success',' '.$id.' has Been Successfully Update.');;

    }else{
      Log::error("deliveryChallanStatusUpdate() invaild Parameter.  please try agen.1");
      return redirect('DeliveryChallan/show')->with('error','invaild Parameter.  please try agen.');
    }
                    

  }

  /*
  *
  * delivery Challan Send Email By Customers 
  *
  *
  */
  // public function sendChallanEmail(Request $request){

  //     $data = array('name'=>"Virat Gandhi");
  //     $to = $request['to_email'];
  //     $cc = $request['to_cc_email'];

  //     Mail::send(['text'=>'mail'], $data, function($message) {
  //        $message->to('bsolanke1234@gmail.com', 'Test Email Send in Laravel')->subject
  //           ('Laravel Basic Testing Mail');
  //         $message->attachData($pdf->output(), "invoice.pdf");
  //         $message->from('info@advancevts.com','Advance VTS');
  //     });
  //     echo "Basic Email Sent. Check your inbox.";
   

  // }

  public function sendChallanEmail(Request $request){
        
        $to = $request["to_email"];
        $to_name = $request['to_name'];
        $to_cc_email = $request["to_cc_email"];
        $challan_no = $request["challanNo"];

        set_time_limit(500); // 

        // challan info 
        $challanINFO = DB::table('challan_no as cn')
                      ->leftJoin('customer as c','cn.customer_id','c.id')
                      ->select('cn.*','c.name','c.mobile','c.email','c.address','c.billing_code')
                      ->where('cn.id',$challan_no)
                      ->first();

        // challan items 
        $challanItems = DB::table('delivery_challan')
                    ->where('challan_no',$challan_no)
                    ->get();

        $pdf = PDF::loadView('pdf.DeliveryChallanPdf',['challanINFO'=>$challanINFO,'challanItems'=>$challanItems]);

        $data = array('name'=>$to_name);

        try{
            Mail::send('emails.challanMail', $data, function($message)use($pdf,$data,$to,$to_name,$challan_no) {
            $message->to($to, $to_name)
            ->cc($to, $to_name)
            ->subject('COSMICA TELEMATICS GPS Challan')
            ->attachData($pdf->output(), "cosmica_challan-".$challan_no.".pdf");
            });
        }catch(JWTException $exception){
            
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();

            Log::error("sendChallanEmail() invaild Parameter  please try agen.1");
            return redirect('DeliveryChallan/show')->with('error',' '.$exception->getMessage().' please try agen.');
        }
        if (Mail::failures()) {

             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
             Log::error("sendChallanEmail() failures.  please try agen.1");
             return redirect('DeliveryChallan/show')->with('error',' '.$exception->getMessage().' please try agen.');

        }else{

          $this->statusdesc  =   "Message sent Succesfully";
          $this->statuscode  =   "1";
          Log::info("sendChallanEmail() Succesfully.");
          return redirect('DeliveryChallan/show')->with('success',' Email Message sent Succesfully.');
        }
        //return response()->json(compact('this'));
 }




  /*
  *
  *
  *
  *  delivery Challan Delete
  */
  public function challanDelete(Request $request){

    

    $challan_no = $request['id'];
    Log::info("challanDelete() challan_no : $challan_no");


    $challanItems = DB::table('delivery_challan')
                ->where("challan_no",$challan_no)
                ->get();

    if(!empty($challanItems)){
      Log::info("challanDelete() challanItems not empty");



    }





  }

  /*
  *
  *
  *
  *  search autocomp
  */
  public function searchChallanItems(Request $request){

    Log::info("searchChallanItems()");

        $data = DB::table('delivery_challan')
                ->select("items","challan_no")
                ->where("items","LIKE","%{$request->input('query')}%")
                ->get();

        $value1 = array();
        foreach ($data as  $value) {
            $value1[]  = "challan No :-  ".$value->challan_no." items :-  ".$value->items."";
        }
   
        return response()->json($value1);
    
  }

  /*
  *
  *
  *
  *  Show Challan Items
  */
  public function showChallanItems(Request $request, $challan_no){

    Log::info("showChallanItems()");


        $data = DB::table('delivery_challan')
                ->where("challan_no",$challan_no)
                ->get();

        
        return response()->json($data);
    
  }

  



  

  
  


}
