<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inventory\Imports\DeviceImport;
use Inventory\Exports\DeviceExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{     
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
       load view Device index
    */
    public function index(){



        // $deviceEx = DB::select("SELECT * FROM `device` WHERE DATE_ADD(selling_date, + INTERVAL billing_frequency DAY) <= ".date('Y-m-d')." AND features_allowed != ".SOFT_DELETE_FLAG." AND status !='InActive'");

        $deviceEx = DB::select("SELECT * FROM `device` WHERE  DATE_ADD(selling_date,  INTERVAL billing_frequency DAY) < '".date('Y-m-d')."'  AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive'");

      //customer List
      $customerList = DB::table('customer')
                  ->get();

      
     	return view('device',['deviceEx'=>$deviceEx,'customerList'=>$customerList]);
    }
    /*
     get all devices send view
    */
    public function GetAllDevice(){
      
  
      $sql=DB::table('device')
      ->where('status','!=','InActive')
      ->where('features_allowed','!=',SOFT_DELETE_FLAG)
      ->orderBy('updated_at','desc')
      ->get();

      foreach ($sql as $value) {
        
        $expiry_date = date('Y-m-d', strtotime($value->selling_date . " +".$value->billing_frequency." days"));
        $value->expiry_date = $expiry_date;
        $value->expiry_date_h = date('d M Y', strtotime($expiry_date));

        $value->is_expiry=0;
        if ($value->expiry_date <= date('Y-m-d')) {
          $value->is_expiry=1;
        }

        $value->selling_date_h  = date('d M Y', strtotime($value->selling_date));
        $value->purchase_date_h  = date('d M Y', strtotime($value->purchase_date));
        $value->created_by_h  = date('d M Y', strtotime($value->created_at));
       
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $value->selling_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $diff_in_days = $to->diffInDays($from);
        $value->use_days = 'Used '.$diff_in_days.' Days';

        $exDate = \Carbon\Carbon::createFromFormat('Y-m-d', $expiry_date);
        $Cdate = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $diff_in_days_r = $exDate->diffInDays($Cdate);
        $value->remaining_days = 'Remaining '.$diff_in_days_r.' Days';


    
      }

      // set data
      $data = array();
      $data[] = $data['data'] =$sql;
      if (!empty($data) || !is_null($data) || isset($data) ) { 
        echo json_encode($data);
      }else{
       echo "{\"data\":[]}";
      }
    
    }

  /*
  *  Upload Excel csv other excel format to database. device table data improt
  *
  */
  public function import(Request $request) 
  {

        Log::info("call import()");
        $validation =  Validator::make($request->all(),[
          'file'  => 'required|mimes:xls,xlsx,csv',
        ]);

        if($request->hasFile('file'))
        {

          $data = Excel::toArray(new DeviceImport, request()->file('file'));
          //dd($data);
          Log::info("import();  hasFile true");
        
        if(!empty($data) && count($data)  != 0){

          Log::info("not empty data");

          
          $error_count = 0; 
          $error_print = false;
          $rowCouter =1;
           foreach ($data[0] as $value) {

            $rowCouter++;
            $error = false;
            $imei1 = trim($value['imei']);
            $email1 = trim($value['email']);
            Log::info("imei = $imei1, email = $email1");
            $checkImeiEx = DB::table('device')->where('imei',trim($value['imei']))->first();

            $imei_ex = 0;
            $error_imei_color = 'green';
            if (!empty($checkImeiEx)) {
                    
                $imei_ex = 1; 
                $error_imei_color = 'red';
                $error = true;// errro true
            }

            $checEmailValidateORNot = DB::table('customer')->where('email',trim($value['email']))->first();
            $validate_email = 0; 
            $error_email_color = 'green';
            $display_e = 'none';
            if (empty($checEmailValidateORNot)) {
                
                 $validate_email = 1;
                 $error = true;//error true
                 $error_email_color = 'red';
                 $display_e = 'block';
              }
            
            $billing_frequency_invalid = 0;
            $error_billing_f_color = 'green';
            $display_b ='none';
            if (!is_numeric(trim($value['billing_frequency']))) {
               $error = true;//error true
               $billing_frequency_invalid =1;
               $error_billing_f_color = 'red';
               $display_b = 'block';
            }

            // $selling_date = date("Y-m-d",strtotime(trim($value['selling_date'])));
            // $purchase_date = date("Y-m-d",strtotime(trim($value['purchase_date']))); 

            $selling_date = $this->is_Date(trim($value['selling_date']));
            $purchase_date = $this->is_Date(trim($value['purchase_date']));
    

            $insert[] = [
                        'email' => trim($value['email']),
                        'imei' => (int) trim($value['imei']),
                        'vehicleName'=>trim($value['vehicle_name']),
                        'cost'=>(float) trim($value['cost']),
                        'device_type' => trim($value['device_type']), 
                        'renewal_charges'  => trim($value['renewal_charges']),
                        'purchase_date' => $purchase_date,
                        'selling_date' => $selling_date,
                        'billing_frequency' => trim($value['billing_frequency']),
                        'unique_serial'=> trim($value['unique_serial']),
                        'ICCD'=>trim($value['iccd']),
                        'manager_id'=>Auth::user()->id,
                        'last_update_by'=>Auth::user()->name,
                        'payment_status'=>'pending',
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'created_at'=>date('Y-m-d H:i:s')
                        ];

            if ($error == true) {
                $error_count++;
                $error_print = true;
                if ($error_count == 1) {
                    echo "<a href=".route('Device')."><button type='button' style='background-color:green; color:white;height:34px; float:left;'>Back To Device Panal</button></a>";
                    echo "<h2 style='text-align:center'>Something wrong please try again please check excel double entry, format etc. wrong.<h2>
                    <h4 style='text-align:right'>Note :- Red column are duplicate </h4>";
                  echo "<table style='width: 90%; text-align: center; color: white; font-weight: 900;' cellpadding='8'>
                        <tr style='background-color:gray;'>
                          <th>Row</th>
                          <th>Email</th>
                          <th>Imei</th>
                          <th>Billing Frequency</th>
                        </tr>";
                }
              echo "<tr>
                      <td style='background-color: gray''>".$rowCouter."</td>
                      <td style='background-color: ".$error_email_color.";''>".trim($value['email'])."<br><p style='text-align:right; font-size:12px; display:".$display_e.";'> Note:-please Check Your Custoemr is not Found<p></td>
                      <td style='background-color: ".$error_imei_color.";''>".(int) trim($value['imei'])."</td>
                      <td style='background-color: ".$error_billing_f_color.";''>".trim($value['billing_frequency'])."
                      <p style='text-align:right; font-size:12px; display:".$display_b.";'> Note:-please Check Your billing Frequency Format is required Only Number<p></td>
                    </tr>";

            }

           }if ($error_print == true) {
            die();
           }

          if(!empty($insert) && $error == false){

            try { 
                
                $insertData = DB::table('device')->insert($insert);

               return redirect('Device')->with('success','Your Data has successfully imported.');

            } catch (\Exception $e) {
                \Session::flash('error', $e->getMessage());
                return redirect('Device');
            }

           }
        }

        return redirect('Device')->with('error','Error inserting the data not found..');
    }
      
        
  }
  /**
  *
  * Date convert to Database Format YYYY-mm-dd
  */ 
  function is_Date($str){

      Log::info("is_Date() = date= $str");
      if(count(explode("-", $str))>1) {
        
        Log::info("is_Date() = explodable is -");
        $arr = explode('-', $str);       
      }
      else if(count(explode("/", $str))>1){
        Log::info("is_Date() = explodable is /"); 
         $arr = explode('/', $str);
      }else{
           Log::info("is_Date() = No use of exploding plase check your date format");
      }      
 
      if(strlen($arr[2]) == '2'){
                        
          $yyyy  = '20'.$arr[2];
          
      }else{
          $yyyy  = $arr[2];     
      }
  
      $dateconcat = $arr[0].'-'.$arr[1].'-'.$yyyy;
      //echo $dateconcat."<br>";
      Log::info("is_Date() = dateconcat =$dateconcat");

      $stamp = strtotime($dateconcat);
    
      if (is_numeric($stamp)){  
         $month = date( 'm', $stamp ); 
         $day   = date( 'd', $stamp ); 
         $year  = date( 'Y', $stamp ); 

         Log::info("is_Date() year=$year, month=$month, day=$day"); 

          return $year."-".$month."-".$day;
      }  
      return false; 
}
  /*
  *
  *
  *
  *Import OLd
  */
  public function importOLD(Request $request) 
  {
        // $validation = Validator::make($request, [
        //       'imei' => 'required|imei|unique:device,imei'
        //   ]);

        $data = Excel::import(new DeviceImport,request()->file('file'));

        //$array = Excel::toArray(new DeviceImport, request()->file('file'));
        if (!empty($data)) {

          return redirect('/Device')->with('success',''.$request['file']->getClientOriginalName().' Imports Added Successfully.');
        }else{

          return redirect('/Device')->with('error',''.$request['file']->getClientOriginalName().' Not Added.');
        }
      
        
  }


  /**
  * @return \Illuminate\Support\Collection
  */
  public function export(Request $request) 
  {
      return Excel::download(new DeviceExport, 'Device-'.date('Y-m-d H:i:s').'.xlsx');
  }

  /**
  * @return \Illuminate\Support\Collection
  */
  public function edit(Request $request) 
  {
      
        $arr = array(
                    'email' => $request['email'],
                    'imei' => $request['imei'],
                    'vehicleName'=>$request['vehicle_name'],
                    'cost'=>$request['cost'],
                    'device_type' => $request['device_type'], 
                    'renewal_charges'  => $request['renewal_charges'],
                    'purchase_date' => $request['purchase_date'],
                    'selling_date' => $request['selling_date'],
                    'ICCD'=>$request['iccd'],
                    'billing_frequency' => $request['billing_frequency'],
                    'payment_status'=>$request['payment_status'],
                    'last_update_by'=>Auth::user()->name,
                    'status'=>$request['statusList'],
                    'updated_at'=>date('Y-m-d H:i:s'),

                    );
    

          if (empty($request['vehicle_name']) ){
                $name  =  $request['imei']; 
            }else{
              $name=  $request['vehicle_name'];
            }

          try{

            
               $sql = DB::table('device')
                        ->where('id',$request['id'])
                        ->update($arr);

                if ($request['statusList'] == 'InActive') {
                    
                    $InActive = DB::table('device')
                        ->where('id',$request['id'])
                        ->update(['features_allowed'=>SOFT_DELETE_FLAG]);
                }

              if ($sql) {
            
              $data = array('success' => true,'message'=>''.$name.' Update Successfully.');
                    return response()->json($data); 
              }

          } catch (\Exception $e) {

                      \Session::flash('error', $e->getMessage());
                      //return redirect('Device');
                    $data = array('success' => false,'message'=>$e->getMessage());
                    return response()->json($data);
          }

           

            
           
              
  
           

   
  }




  /*
  *  delete Device
  *
  */ 
  public function DeviceDelete(Request $request){

    
    $sqlDelete = DB::table('device')
    ->where('id',$request['id'])
    ->update(['features_allowed'=>SOFT_DELETE_FLAG,'updated_at'=>date('Y-m-d H:i:s')]);

    if ($sqlDelete) {
      $data = array('success' => true,'message'=>''.$request['imei'].' Deleted Successfully.');
      return response()->json($data); 
    }else{
      $data = array('success' => false,'message'=>'Device Not Deleted!');
      return response()->json($data);
    }

  } 

  /*
  *
  * Expiry Device
  *
  */
  public function expiry(Request $request){

    

    // $sql = DB::select("SELECT device.*,DATE_ADD(selling_date, INTERVAL billing_frequency DAY) as expiry_date FROM `device` WHERE DATE_ADD(selling_date, INTERVAL billing_frequency DAY) > ".date('Y-m-d')." AND features_allowed != ".SOFT_DELETE_FLAG." AND status !='InActive' ORDER BY updated_at = 'ASC'");

    $sql = DB::select("SELECT `device`.*,DATE_ADD(selling_date,  INTERVAL billing_frequency DAY) as expiry_date  FROM `device` WHERE  DATE_ADD(selling_date,  INTERVAL billing_frequency DAY) < '".date('Y-m-d')."'  AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive' ORDER BY updated_at = 'ASC'");


      

      return view('deviceExpiryOrRenewal',['device'=>$sql]);


  }  

  /*
  *
  * Renewal Device
  *
  */
  public function renewal(Request $request){

        $this->validate($request,[
          'id' => 'required',
          'imei'=>'required',
          //'expiry_date'=>'required',
          'renewal_date'=>'required',
          'renewal_charges' => 'required'
          ]);


        $renewal_date = $request['renewal_date'];

        $sqlUpdate = DB::table('device')
                        ->where('id',$request['id'])
                        ->update(['selling_date'=>$renewal_date,
                                  'renewal_charges'=>$request['renewal_charges'],
                                  'last_update_by'=>Auth::user()->name,
                                  'updated_at'=>date('Y-m-d H:i:s')
                                ]);
                        
        if($sqlUpdate){

                return redirect('device/expiry')->with('success',''.$request['imei'].' Device has been renewal Successfully.');
        }else{

               return redirect('device/expiry')->with('error',''.$request['imei'].' Not Renewal.');
        }

 
  }

  public function InActive(Request $request){


      $this->validate($request,[
            'id' => 'required',
            'imei'=>'required'
          ]);

       $simUpdate = DB::table('device')
                    ->where('id',$request['id'])
                    ->update(['status'=>'InActive','updated_at'=>date('Y-m-d H:i:s')]);

        if($simUpdate){

              return redirect('device/expiry')->with('success',''.$request['imei'].' In-Active Successfully.');
        }else{

             return redirect('device/expiry')->with('error',''.$request['imei'].' Not In-Active.');
        }


  }

  /*
  *
  *
  *   //Download Device Template
  */

  public function downloadTemplate(Request $request){

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=template_device.csv");
    return readfile('template_device.csv');

  }
  

}
