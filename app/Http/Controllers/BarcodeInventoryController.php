<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inventory\Exports\BarcodeInventoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;  
use Illuminate\Support\Facades\Log;


class BarcodeInventoryController extends Controller
{     
  public function __construct()
  {
      $this->middleware('auth');
  }
  /*
     load view show
  */
  public function show(){

    
    $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                          ->get();


    // all device array
    $allDevice = DB::table('device')
    ->select('imei')
    ->get();

    $allDeviceArr = array();
    foreach ($allDevice as $value) {
     
      array_push($allDeviceArr, $value->imei);
    }

    // all Sim array
    $allSim = DB::table('sim')
    ->select('sim_no')
    ->get();


    $allSimArr = array();
    foreach ($allSim as $value) {
    
      array_push($allSimArr, $value->sim_no);

    }


    // check sim / device added  not added              
    foreach ($barcodeimeiDisplay as $value) {
        


        if (in_array($value->imei, $allDeviceArr) &&  !empty($allDeviceArr)){ // check device 
        
          $value->in_stock = 'in';
          $value->in_stock_type = 'device';
          
        }else if(in_array($value->imei, $allSimArr) && !empty($allSimArr)) {// check sim
        
          $value->in_stock = 'in';
          $value->in_stock_type = 'sim';

        }else{

          $value->in_stock = 'NA';
          $value->in_stock_type = 'NA';
        
        }

    }

    return view('showBarcodeInventory',['barcodeimeiDisplay'=>$barcodeimeiDisplay,'filterBy'=>'7']);
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

      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->whereDate('created_at', Carbon::today())
                           ->get();

      $filterByName = "Today's";
   
    }else if ($filterBy == '7') {
    
      //echo die("last week ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                           ->get();

      $filterByName = "Last Weel";

    }else if($filterBy == '15'){
    
      $last15day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last15day)
                           ->get();

      $filterByName = "Last 15 Days's";

    }else if($filterBy == '31'){
    
      //echo die("one month "); 
      $last31day = \Carbon\Carbon::today()->subDays(31);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last31day)
                           ->get();

     $filterByName = "Last 1 Month";

    }else if($filterBy == '182'){
    
      //echo die("six month's "); 
      $last182day = \Carbon\Carbon::today()->subDays(182);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last182day)
                           ->get();

      $filterByName = "Last 6 Month";

    }else if($filterBy == '365'){
    
      //echo die("six month's "); 
      $last365day = \Carbon\Carbon::today()->subDays(365);
      //echo die("15 day's ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->where('created_at', '>=', $last365day)
                           ->get();

      $filterByName = "Last 1 Year";

    }else if($filterBy == 'all'){
    
      //echo die("All ");
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->get();

      $filterByName = "All";

    }else{
      //echo die("today's "); // defulat
      $barcodeimeiDisplay = DB::table('advgps.barcode_imei_inventory')
                           ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                           ->get();
      $filterByName = "Last Week Defulat";
    }


    // all device array
    $allDevice = DB::table('device')
    ->select('imei')
    ->get();

    $allDeviceArr = array();
    foreach ($allDevice as $value) {
      array_push($allDeviceArr, $value->imei);
    }

    // all Sim array
    $allSim = DB::table('sim')
    ->select('sim_no')
    ->get();


    $allSimArr = array();
    foreach ($allSim as $value) {
      array_push($allSimArr, $value->sim_no);
    }


    // check sim / device added  not added              
    foreach ($barcodeimeiDisplay as $value) {
      
            if (in_array($value->imei, $allDeviceArr) &&  !empty($allDeviceArr)){ // check device 
            
              $value->in_stock = 'in';
              $value->in_stock_type = 'device';
              
            }else if(in_array($value->imei, $allSimArr) && !empty($allSimArr)) {// check sim
            
              $value->in_stock = 'in';
              $value->in_stock_type = 'sim';

            }else{

              $value->in_stock = 'NA';
              $value->in_stock_type = 'NA';
            
            }

    }
    
  
    if (!empty($barcodeimeiDisplay)) { // if not empty

      return view('showBarcodeInventory',['barcodeimeiDisplay'=>$barcodeimeiDisplay,'filterBy'=>$filterBy]);

    }else{

      return view('showBarcodeInventory',['barcodeimeiDisplay'=>$barcodeimeiDisplay,'filterBy'=>$filterBy])->with('error',''.$filterByName.'  Not Found.  please try Other.');
    }

    
  }

  /*
    Create new  
  */
  public function Create(Request $request){

    //dd($request['imei']);

      $validation =  Validator::make($request->all(),[
          'imei' => 'required|min:3|max:225',
        ]);

      $data = array('imei' => (int) $request['imei'],
                    'deviceType'=>$request['device_type'],
                    'description'=>$request['description'],
                    'purchased_from'=>$request['purchased_from'],
                    'assigned_to'=>$request['assigned_to'],
                    'assigned_at'=>$request['assigned_at'],
                    //'manager_id'=> Auth::user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                  );

        $insertId = DB::table('advgps.barcode_imei_inventory')->insert($data);

        if($insertId){
              return redirect('barcode-inventory/show')->with('success',''.$request['imei'].' Added Successfully.');
        }else
        {
             return redirect('barcode-inventory/show')->with('error','imei Not Added.');
        }
                  
}


  /*
    Add Stock To Device  
  */
  public function addStockDevice(Request $request){

        // check imei Exi
        $validation =  Validator::make($request->all(),[
            'imei' => 'required|min:3|unique:sim,imei'
        ]);

            
        $selling_date = date("Y-m-d",strtotime($request['selling_date']));
        $purchase_date = date("Y-m-d",strtotime($request['purchase_date'])); 


      $data = array('imei' => (int) $request['imei'],
                    'email'=>$request['customerList'],
                    'vehicleName'=>$request['vehicleName'],
                    'device_type'=>$request['deviceType'],
                    'cost'=>(int) $request['cost'],
                    'purchase_date'=>$purchase_date,
                    'selling_date'=>$selling_date,
                    'billing_frequency'=>$request['billing_frequency'],
                    'description'=>$request['description'],
                    'purchased_from'=>$request['purchased_from'],
                    'assigned_to'=>$request['assigned_to'],
                    'created_by'=>Auth::user()->name,
                    'manager_id'=>Auth::user()->id,
                    'last_update_by'=>Auth::user()->name,
                    'iccd'=>$request['iccd'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                  );

        $insertGetId = DB::table('device')
            ->insertGetId($data);

        if(!empty($insertGetId)){
              return redirect('barcode-inventory/show')->with('success',''.$request['imei'].' Added Device Stock Successfully.');
        }else
        {
             return redirect('barcode-inventory/show')->with('error','imei Not Added.');
        }
                  
    }


  /**
  * @return \Illuminate\Support\Collection
  */
  public function export(Request $data, $request) 
  {


      return Excel::download(new BarcodeInventoryExport($data), 'barcode-inventory-'.date('Y-m-d H:i:s').'.xlsx');
  }
  /*
  *
  *
  * // add Stock To 
  *
  */
  public function addStock(Request $request){

     Log::info("addStock():"); 

     

      // check device table
      $device = DB::table('device')
      ->select('imei')
      ->get();
      $imei = array();
      foreach ($device as $key => $value) {
        $imei[] = $value->imei;
      }
      
      $stock = DB::table('advgps.barcode_imei_inventory')
              ->whereNotIn('imei',$imei)
              ->get();
      
      if(!empty($stock)){

            Log::info("addStock(): view stock Available");
            return view('addStock',['stock'=>$stock]);

      }else{
            Log::info("addStock(): view stock not Available");
            return view('addStock',['stock'=>$stock])->with('error','Stock Not Available.');
      }
    
  }



  /*
  *
  *
  * // add addStockToDevice
  *
  */
  public function addStockToDevice(Request $request){

     Log::info("addStockToDevice():"); 
     //print_r('hello ');

     //dd(count($request['item']));
    $insertImeiArr = array();
    for ($i=0;$i<count($request['items']); $i++) 
    { 
        
            if (!empty($request['items'][$i]) ) 
            {
              try{
                 
                  $insertGetId = DB::table('device')
                                ->insertGetId(['imei' => (int) $request['items'][$i],
                                              'email'=>$request['customerList'],
                                              'vehicleName'=>$request['vehicleName'][$i],
                                              'device_type'=>$request['deviceType'][$i],
                                              'cost'=>(int) $request['price'][$i],
                                              'purchase_date'=>$request['purchase_date'][$i],
                                              'selling_date'=>$request['selling_date'][$i],
                                              'billing_frequency'=>$request['billing_frequency'][$i],
                                              'purchased_from'=>$request['purchased_from'][$i],
                                              'assigned_to'=>$request['assigned_to'][$i],
                                              'created_by'=>Auth::user()->name,
                                              'manager_id'=>Auth::user()->id,
                                              'last_update_by'=>Auth::user()->name,
                                              'iccd'=>$request['ICCD'][$i],
                                              'created_at' => date('Y-m-d H:i:s'),
                                              'updated_at' => date('Y-m-d H:i:s'),
                                            ]);
                  $status = null;
                  if (!empty($insertGetId)) {
                      
                      $status = 'is insert Successfully,';
                  }else{
                      
                      $status = 'is failed,';
                  }

                  $insertImeiArr[] = $request['items'][$i].' - '.$status;
                  

              } catch (\Exception $e) {
                Log::error("error catch");
                    \Session::flash('error', $e->getMessage());
                    return redirect('addStock');
            }
          }else{

            Log::error("addStockToDevice(): items/imei, something wrong please try again");
            return view('addStock',['stock'=>$stock])->with('error','Stock Not Available.');

          }
      }


      Log::info("addStockToDevice(): return");
     $insertImeiArrString = implode(" ",$insertImeiArr);

      return redirect('addStock')->with('success',' '.$insertImeiArrString.' items status.');



    
  }




  


}
