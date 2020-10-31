<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inventory\Imports\DeviceImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use Inventory\Exports\SIMExport;
use Inventory\Exports\InvoicesExport;



class ReportsController extends Controller
{     
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
       load view Device Reports index
    */
    public function device(Request $request){

    	$operators = DB::table('device')
                 ->groupBy('email')
                 ->get();

        $deviceType = DB::table('device') // 
                 ->groupBy('device_type')
                 ->get();
                 
     	return view('deviceReports',['operators'=>$operators,'deviceType'=>$deviceType]);
    }
    /*
    *
    * Device Reports on deive type start date end date 
    */
    public function deviceReport(Request $request){

        // Current Auth id
        $id = Auth::user()->id;

        $device_type = $request['device_type'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $client_type = $request['client_type'];
        $report_type = $request['report_type'];

         // convert form date
        $from_date = strtotime($from_date);
        $convert_from_date = date('Y-m-d', $from_date);

        $convert_to_date = date('Y-m-d', strtotime($to_date . ' +1 day'));

        $clientEmail = DB::table('customer')
                       ->select('email')
                       ->where('customer_type',$client_type)
                       ->get();

        if ($report_type === 'expiry') { //selling //purchase

            $devices=DB::table('device')
                    ->leftjoin('custoemr','device.email','custoemr.email')
                    ->where(function ($query) use ($device_type) {
                    if($device_type !== 'all'){
                      $query->where('device.device_type',$device_type);
                    }
                    })
                    ->where(function ($query) use ($client_type) {
                    if($client_type !== 'all'){
                      $query->where('custoemr.email',$client_type);
                    }
                    }) 
                    ->whereBetween(DB::raw('SELECT DATE_ADD(selling_date,  INTERVAL billing_frequency DAY) as expiry_date FROM `device`'),[$convert_from_date,$convert_to_date])
                    //->orderBy('expiry_date', 'desc')
                    ->get();

           

            $deviceEx = DB::select("SELECT * FROM `device` WHERE  DATE_ADD(selling_date,  INTERVAL billing_frequency DAY) < '".date('Y-m-d')."'  AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive'");



        }else if ($report_type === 'selling') {

            $devices=DB::table('device')
                    ->where(function ($query) use ($device_type) {
                    if($device_type !== 'all'){
                      $query->where('device_type',$device_type);
                    }
                    })
                    ->where(function ($query) use ($operatorEmail) {
                    if($operatorEmail !== 'all'){
                      $query->where('email',$operatorEmail);
                    }
                    })
                    ->whereBetween('selling_date',[$convert_from_date,$convert_to_date])
                    ->orderBy('selling_date', 'desc')
                   ->get();

        }else if ($report_type === 'purchase') {

            $devices=DB::table('device')
                    ->where(function ($query) use ($device_type) {
                    if($device_type !== 'all'){
                      $query->where('device_type',$device_type);
                    }
                    })
                    ->where(function ($query) use ($operatorEmail) {
                    if($operatorEmail !== 'all'){
                      $query->where('email',$operatorEmail);
                    }
                    })
                    ->whereBetween('purchase_date',[$convert_from_date,$convert_to_date])
                    ->orderBy('purchase_date', 'desc')
                   ->get();

        }

        $counter = 1;
        foreach ($devices as $value) {
                
                $value->index = $counter++;

                $selling_date = $value->selling_date;
                if (!empty($selling_date)) {
                    $s_date = date('d-m-Y',strtotime($selling_date));
                }else{
                    $s_date = '';
                }
                $value->s_date = $s_date;


                $expiry_date = $value->expiry_date;
                if (!empty($expiry_date)) {
                    $e_date = date('d-m-Y',strtotime($expiry_date));
                }else{
                    $e_date = '';
                }
                $value->e_date = $e_date;

                $purchase_date = $value->purchase_date;
                if (!empty($purchase_date)) {
                    $p_date = date('d-m-Y',strtotime($purchase_date));
                }else{
                    $p_date = '';
                }
                $value->p_date = $purchase_date;
            }
        
        return $devices;
    }


/*********************************** SIM *********************************/

    /*
       load view Sim Reports index
    */
    public function sim(Request $request){

        $operators = DB::table('sim')
                 ->groupBy('email')
                 ->get();

        $providers = DB::table('sim') // 
                 ->groupBy('sim_provider')
                 ->get();
                 
        return view('simReports',['operators'=>$operators,'providers'=>$providers]);
    }

    /*
    *
    * Sim Reports on SIM Providers start date end date reports type expiry ,in use ,closed
    */
    public function simReport(Request $request){


        $providers = $request['providers'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $operatorEmail = $request['operator'];
        $report_type = $request['report_type'];

         // convert form date
        $from_date = strtotime($from_date);
        $convert_from_date = date('Y-m-d', $from_date);

        $convert_to_date = date('Y-m-d', strtotime($to_date . ' +1 day'));

        if ($report_type === 'expiry') { //selling //purchase

            $sim=DB::table('sim')
                    ->where(function ($query) use ($providers) {
                    if($providers !== 'all'){
                      $query->where('sim_provider',$providers);
                    }
                    })
                    ->where(function ($query) use ($operatorEmail) {
                    if($operatorEmail !== 'all'){
                      $query->where('email',$operatorEmail);
                    }
                    })
                    ->whereBetween('expiry_date',[$convert_from_date,$convert_to_date])
                    ->orderBy('expiry_date', 'desc')
                   ->get();


        }else if ($report_type === 'in_used') {

            $sim=DB::table('sim')
                    ->where(function ($query) use ($providers) {
                    if($providers !== 'all'){
                      $query->where('sim_provider',$providers);
                    }
                    })
                    ->where(function ($query) use ($operatorEmail) {
                    if($operatorEmail !== 'all'){
                      $query->where('email',$operatorEmail);
                    }
                    })
                    ->where('status',$report_type)
                    ->whereBetween('sale_date',[$convert_from_date,$convert_to_date])
                    ->orderBy('sale_date', 'desc')
                    ->get();
                   
        }else if ($report_type === 'closed') {

            $sim=DB::table('sim')
                    ->where(function ($query) use ($providers) {
                    if($providers !== 'all'){
                      $query->where('sim_provider',$providers);
                    }
                    })
                    ->where(function ($query) use ($operatorEmail) {
                    if($operatorEmail !== 'all'){
                      $query->where('email',$operatorEmail);
                    }
                    })
                    ->where('status',$report_type)
                    ->whereBetween('sale_date',[$convert_from_date,$convert_to_date])
                    ->orderBy('sale_date', 'desc')
                    ->get();
                
        }else if ($report_type === 'InActive') {

            $sim=DB::table('sim')
                    ->where(function ($query) use ($providers) {
                    if($providers !== 'all'){
                      $query->where('sim_provider',$providers);
                    }
                    })
                    ->where(function ($query) use ($operatorEmail) {
                    if($operatorEmail !== 'all'){
                      $query->where('email',$operatorEmail);
                    }
                    })
                    ->where('status',$report_type)
                    //->whereBetween('sale_date',[$convert_from_date,$convert_to_date])
                    ->orderBy('sale_date', 'desc')
                    ->get();
                
        }


        $counter = 1;
        foreach ($sim as $value) {
                
                $value->index = $counter++;

                $expiry_date = $value->expiry_date;
                if (!empty($expiry_date)) {
                    $e_date = date('d-m-Y',strtotime($expiry_date));
                }else{
                    $e_date = '';
                }
                $value->e_date = $e_date;
            }
        
        return $sim;
    }


    // excel Style
    public function excelStyle(Request $request){

        //return view('excel.customerList');
        return Excel::download(new InvoicesExport, 'cusomerList.xlsx');
        

    }
   
  

}
