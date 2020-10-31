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


class OtherStockController extends Controller
{     
  public function __construct()
  {
      $this->middleware('auth');
  }
  /*
     load view show
  */
  public function index(){

         $stock=DB::table('other_stock')
         ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
         ->get();

      foreach ($stock as $value) {
        
          $expiry_date = date('Y-m-d', strtotime($value->sale_date . " +".$value->billing_frequency." days"));
          $value->expiry_date = $expiry_date;
          $value->expiry_date_h = date('d M Y', strtotime($expiry_date));

          $value->selling_date_h  = date('d M Y', strtotime($value->sale_date));
          $value->created_by_h  = date('d M Y', strtotime($value->created_at));
       
          $to = \Carbon\Carbon::createFromFormat('Y-m-d', $value->sale_date);
          $from = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
          $diff_in_days = $to->diffInDays($from);
          $value->use_days = 'Used '.$diff_in_days.' Days';

          $exDate = \Carbon\Carbon::createFromFormat('Y-m-d', $value->expiry_date);
          $Cdate = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
          $diff_in_days_r = $exDate->diffInDays($Cdate);
          $value->remaining_days = 'Remaining '.$diff_in_days_r.' Days';

          if ($value->expiry_date <= date('Y-m-d')) {
            $value->is_ex = 'yes';
          }else{
            $value->is_ex = 'no';
          }

          
          
          $value->available_stock = abs($value->quantity - $value->sold_stock);
          


    }

      
      return view('otherStock',['stock'=>$stock,'filterBy'=>'all']);
  }

// CREATE TABLE `other_stock` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `name` varchar(255) NOT NULL,
//   `quantity` bigint(20) NOT NULL,
//   `price` bigint(20) NOT NULL,
//   `description` longtext NULL DEFAULT NULL,
//   `sale_date` date DEFAULT NULL,
//   `billing_frequency` int(11) NULL DEFAULT NULL,
//   `sold_stock` int(11) NULL DEFAULT NULL,
//   `manager_id` int(11) NOT  NULL,
//   `last_update_by` varchar(222) NOT NULL,
//   `status` int(11) DEFAULT '1',
//   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//   `updated_at` int(11) NOT NULL,
//   PRIMARY KEY (id)
// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

   	
  

  /*
  *
  *
  *
  * add Stock bulg multipl at same time
  */
  public function addStock(Request $request){

    return view('addOtherStock');
  }

  
  /*
  *
  *
  * // add others stock multiple  
  *
  */
  public function create(Request $request){

     Log::info("create():"); 
     //print_r('hello ');

     //dd(count($request['stockName']));
    $insertstockNameArr = array();
    $array = array();
    for ($i=0;$i<count($request['stockName']); $i++) 
    { 
        
            if (!empty($request['stockName'][$i]) ) 
            {
              try{
                 
                  $insertGetId = DB::table('other_stock')
                                ->insertGetId(['name' =>$request['stockName'][$i],
                                               'quantity'=>(int)$request['quantity'][$i],
                                               'price'=>(int)$request['price'][$i],
                                               'billing_frequency'=>(int)$request['billing_frequency'][$i],
                                               'sale_date'=>$request['sale_date'][$i],
                                               'description'=>$request['description'][$i],
                                               'sold_stock'=>'0',
                                               'manager_id'=>Auth::user()->id,
                                               'last_update_by'=>Auth::user()->name,
                                               'created_at' => date('Y-m-d H:i:s'),
                                               'updated_at' => date('Y-m-d H:i:s'),
                                            ]);

               // $array[] = ['name' =>$request['stockName'][$i],
               //                                 'quantity'=>$request['quantity'][$i],
               //                                 'price'=>$request['price'][$i],
               //                                 'billing_frequency'=>(int) $request['price'][$i],
               //                                 'sale_date'=>$request['sale_date'][$i],
               //                                 'description'=>$request['description'][$i],
               //                                 'sold_stock'=>'0',
               //                                 'manager_id'=>Auth::user()->id,
               //                                 'last_update_by'=>Auth::user()->name,
               //                                 'created_at' => date('Y-m-d H:i:s'),
               //                                 'updated_at' => date('Y-m-d H:i:s'),
               //                              ];


                  $status = null;
                  if (!empty($insertGetId)) {
                      
                      $status = 'is insert Successfully,';
                  }else{
                      
                      $status = 'is failed,';
                  }

                  $insertstockNameArr[] = $request['stockName'][$i].' - '.$status;
                  

              } catch (\Exception $e) {
                Log::error("error catch");
                    \Session::flash('error', $e->getMessage());
                    return redirect('addStock');
            }
          }else{

            Log::error("create(): stock Name, something wrong please try again");
            return view('add/other/stock',['stock'=>$stock])->with('error','Stock Not Added Available.');

          }
      }

      //dd($array);
      Log::info("create(): return");
     $insertstockNameArrString = implode(" ",$insertstockNameArr);

      return redirect('add/other/stock')->with('success',' '.$insertstockNameArrString.' items status.');



    
  }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $data, $request) 
    {


        return Excel::download(new BarcodeInventoryExport($data), 'other_stock-'.date('Y-m-d H:i:s').'.xlsx');
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
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->whereDate('created_at', Carbon::today())
        ->get();

      $filterByName = "Today's";
   
    }else if ($filterBy == '7') {
    
      //echo die("last week ");
    
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();

      $filterByName = "Last Weel";

    }else if($filterBy == '15'){
    
      $last15day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->where('created_at', '>=', $last15day)
        ->get();


      $filterByName = "Last 15 Days's";

    }else if($filterBy == '31'){
    
      //echo die("one month "); 
      $last31day = \Carbon\Carbon::today()->subDays(15);
      //echo die("15 day's ");
    
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->where('created_at', '>=', $last31day)
        ->get();

     $filterByName = "Last 1 Month";

    }else if($filterBy == '182'){
    
      //echo die("six month's "); 
      $last182day = \Carbon\Carbon::today()->subDays(182);
      //echo die("15 day's ");
      
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->where('created_at', '>=', $last182day)
        ->get();

      $filterByName = "Last 6 Month";

    }else if($filterBy == '365'){
    
      //echo die("six month's "); 
      $last365day = \Carbon\Carbon::today()->subDays(365);
      //echo die("15 day's ");
      
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->where('created_at', '>=', $last365day)
        ->get();

      $filterByName = "Last 1 Year";

    }else if($filterBy == 'all'){
    
      //echo die("All ");
     
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->get();

      $filterByName = "All";

    }else{
      //echo die("today's "); // defulat
      
      $stock=DB::table('other_stock')
        ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();
      $filterByName = "Last Week Defulat";
    }



    foreach ($stock as $value) {
        
          $expiry_date = date('Y-m-d', strtotime($value->sale_date . " +".$value->billing_frequency." days"));
          $value->expiry_date = $expiry_date;
          $value->expiry_date_h = date('d M Y', strtotime($expiry_date));

          $value->selling_date_h  = date('d M Y', strtotime($value->sale_date));
          $value->created_by_h  = date('d M Y', strtotime($value->created_at));
       
          $to = \Carbon\Carbon::createFromFormat('Y-m-d', $value->sale_date);
          $from = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
          $diff_in_days = $to->diffInDays($from);
          $value->use_days = 'Used '.$diff_in_days.' Days';

          $exDate = \Carbon\Carbon::createFromFormat('Y-m-d', $value->expiry_date);
          $Cdate = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
          $diff_in_days_r = $exDate->diffInDays($Cdate);
          $value->remaining_days = 'Remaining '.$diff_in_days_r.' Days';

          if ($value->expiry_date <= date('Y-m-d')) {
            $value->is_ex = 'yes';
          }else{
            $value->is_ex = 'no';
          }

          if ($value->sold_stock <= date('Y-m-d')) {

          }
          
          $value->available_stock = abs($value->quantity - $value->sold_stock);
          


    }
  
    return view('otherStock',['stock'=>$stock,'filterBy'=>$filterByName]);

    
  }
  





  


}
