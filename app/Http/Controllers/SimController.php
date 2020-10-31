<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inventory\Imports\SimImport;
use Inventory\Exports\SIMExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Log;

class SimController extends Controller
{     
  public function __construct()
  {
      $this->middleware('auth');
  }
  /*
     load view Device index
  */
  public function index(){

    // $simEx = DB::table('sim')
    //         ->where('features_allowed','!=',SOFT_DELETE_FLAG)
    //         ->where('status','!=','InActive')
    //         ->where('expiry_date','<=',date('Y-m-d'))
    //         ->get();

    $simEx = DB::select("SELECT * FROM `sim` WHERE DATE_ADD(sale_date, INTERVAL billing_frequency DAY) < '".date('Y-m-d')."' AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive'");
    //customer List
    $customerList = DB::table('customer')
                  ->get();

   	return view('sim',['simEx'=>$simEx,'customerList'=>$customerList]);
  }
  /*
  *     get all sim data return view page
  */ 
  public function GetAllSim(Request $request){

      $sql=DB::table('sim')
      ->where('status','!=','InActive')
      ->where('features_allowed','!=',SOFT_DELETE_FLAG)
      ->orderBy('created_at','DESC')
      ->get();


      foreach ($sql as $value) {
        

      
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

    
    }

      $data = array(); // set data
      $data[] = $data['data'] =$sql;
      if (!empty($data) || !is_null($data) || isset($data) ) { 
        echo json_encode($data);
      }else{
       echo "{\"data\":[]}";
      }
  }

  /*
  *   Upload Excel csv other excel format to database. device table data improt
  *
  */
public function import(Request $request){
      
    $validation =  Validator::make($request->all(),[
          'file'  => 'required|mimes:xls,xlsx,csv',
    ]);


  if($request->hasFile('file'))
  {

      $data = Excel::toArray(new SimImport, request()->file('file'));

      
      //return json_encode($data[0]);
      if(!empty($data) && count($data)){

        $error_count = 0; 
        $error_print = false;
        $rowCouter =1;
         foreach ($data[0] as $value) {
          $error = false;
          $rowCouter++;
          $checkMobileEx = DB::table('sim')->where('mobile_no',(int)trim($value['mobile_no']))->first();

          $mobile_no_ex = 0;
          $error_mobile_color = 'green';
          if (!empty($checkMobileEx)) {
                  
              $mobile_no_ex = 1; 
              $error_mobile_color = 'red';
              $error = true;// errro true
            }

          $check_sim_no_ex = DB::table('sim')->where('sim_no',(int)trim($value['sim_no']))->first();
          $sim_no_ex = 0; 
          $error_sim_no_color = 'green';
          if (!empty($check_sim_no_ex)) {
              
               $sim_no_ex = 1;
               $error_sim_no_color = 'red';
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

          $sale_date = $this->is_Date(trim($value['sale_date']));

          $insert[] = [
                        'email' => trim($value['email']),
                        'sim_no' => (int) trim($value['sim_no']),
                        'sim_provider' => trim($value['sim_provider']),
                        'mobile_no'=>(int) trim($value['mobile_no']),
                        'price'=>(float) trim($value['price']),
                        'billing_frequency'=>(int) trim($value['billing_frequency']),
                        'sale_date'=>$sale_date,
                        'status'=>trim($value['status']),
                        'manager_id'=>Auth::user()->id,
                        'payment_status'=>'pending',
                        'last_update_by'=>Auth::user()->name,
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'created_at'=>date('Y-m-d H:i:s')
                      ];

          if ($error == true) {
              $error_count++;
              $error_print = true;
              if ($error_count == 1) {

                  echo "<a href=".route('Sim')."><button type='button' style='background-color:green; color:white;height:34px;float:left;'>Back To Sim Panal</button></a>";

                  echo "<h2 style='text-align:center'>Something wrong please try again please check excel double entry, format etc. wrong.<h2>
                  <h4 style='text-align:right'>Note :- Red column are duplicate </h4>";
                echo "<table style='width: 90%; text-align: center; color: white; font-weight: 900;' cellpadding='8'>
                      <tr style='background-color:gray;'>
                        <th>Row</th>
                        <th>Email</th>
                        <th>Sim No</th>
                        <th>Mobile</th>
                        <th>Billing Frequency</th>
                      </tr>";
              }
            echo "<tr>
                    <td style='background-color: gray''>".$rowCouter."</td>
                    <td style='background-color: ".$error_email_color.";''>".$value['email']."<br><p style='text-align:right; font-size:12px; display:".$display_e.";'> Note:-please Check Your Custoemr is not Found<p></td>
                    <td style='background-color: ".$error_sim_no_color.";''>".(int)$value['sim_no']."</td>
                    <td style='background-color: ".$error_mobile_color.";''>".(int)$value['mobile_no']."</td>
                    <td style='background-color: ".$error_billing_f_color.";''>".trim($value['billing_frequency'])."
                      <p style='text-align:right; font-size:12px; display:".$display_b.";'> Note:-please Check Your billing Frequency Format is required Only Number<p></td>
                  </tr>";

          }

         }if ($error_print == true) {
          die();
         }

        if(!empty($insert) && $error == false){

          try { 

              $insertData = DB::table('sim')->insert($insert);

             return redirect('Sim')->with('success','Your Data has successfully imported.');

          } catch (\Exception $e) {
              \Session::flash('error', $e->getMessage());
              return redirect('Sim');
          }

         }
      }

      return redirect('Sim')->with('error','Error inserting the data not found..');
    
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

  /**
  * @return \Illuminate\Support\Collection
  */
  public function export(Request $request) 
  {
      return Excel::download(new SIMExport, 'SIM-'.date('Y-m-d H:i:s').'.xlsx');
  }

  /**
  * @return \Illuminate\Support\Collection
  */
  public function edit(Request $request) 
  {
            $selling_date = $request['selling_date'];

            
            $arr = array(
                         'email' => $request['email'],
                        'sim_no' => $request['sim_no'],
                        'sim_provider' => $request['sim_provider'],
                        'mobile_no'=>$request['mobile_no'],
                        'price'=>$request['price'],
                        'billing_frequency'=>$request['billing_frequency'],
                        'sale_date'=>$selling_date,
                        'status'=>$request['status'],
                        'last_update_by'=>Auth::user()->name,
                        'updated_at'=>date('Y-m-d H:i:s')
                        );
        
           //DB::enableQueryLog(); // Enable query log
           $sql = DB::table('sim')
                  ->where('id',$request['id'])
                  ->update($arr);
          //dd(DB::getQueryLog()); 
          
           if ($sql) {
                    
                    $data = array('success' => true,'message'=>''.$request['sim_no'].' Update Successfully.');
                    return response()->json($data); 
            }else{
                    $data = array('success' => false,'message'=>'SIM Not Update!');
                    return response()->json($data);
            }

   
  }


  /*
  *  delete Sim
  *
  */ 
  public function SimDelete(Request $request){

    $name = DB::table('sim')->where('id',$request['id'])->value('sim_no');

    $sqlDelete = DB::table('sim')
    ->where('id',$request['id'])
    ->update(['features_allowed'=>SOFT_DELETE_FLAG,'last_update_by'=>Auth::user()->name,'updated_at'=>date('Y-m-d H:i:s')]);

    if ($sqlDelete) {
      $data = array('success' => true,'message'=>''.$name.' Deleted Successfully.');
      return response()->json($data); 
    }else{
      $data = array('success' => false,'message'=>'Sim Not Deleted!');
      return response()->json($data);
    }

  }
    
  /*
  *
  * Expiry Sim
  *
  */
  public function expiry(Request $request){

      // $sim = DB::table('sim')
      //       ->where('status','!=','InActive')
      //       ->where('expiry_date','<=',date('Y-m-d'))
      //       ->get();

      $sim = DB::select("SELECT sim.*, DATE_ADD(sale_date, INTERVAL billing_frequency DAY) as expiry_date  FROM `sim` WHERE DATE_ADD(sale_date, INTERVAL billing_frequency DAY) < '".date('Y-m-d')."' AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive'");

      return view('simExpiryOrRenewal',['sim'=>$sim]);


  }  

  /*
  *
  * Renewal SIM
  *
  */
  public function renewal(Request $request){

        $this->validate($request,[
          'id' => 'required',
          'sim_no'=>'required',
          'expiry_date'=>'required',
          'renewal_date'=>'required',
          'renewal_charges' => 'required'
          ]);


        $renewal_date = $request['renewal_date'];

        $s_date = strtotime($renewal_date);

        $sqlUpdate = DB::table('sim')
                        ->where('id',$request['id'])
                        ->update([
                                  'last_update_by'=>Auth::user()->name,
                                  'renewal_charges'=>$request['renewal_charges'],
                                  'updated_at'=>date('Y-m-d H:i:s')
                                ]);
                        
        if($sqlUpdate){

                return redirect('sim/expiry')->with('success',''.$request['sim_no'].' Sim has been renewal Successfully..');
        }else{

               return redirect('sim/expiry')->with('error',''.$request['sim_no'].' Not Renewal.');
        }

 
  }

  public function InActive(Request $request){


      $this->validate($request,[
            'id' => 'required',
            'sim_no'=>'required'
          ]);

       $simUpdate = DB::table('sim')
                    ->where('id',$request['id'])
                    ->update(['status'=>'InActive','last_update_by'=>Auth::user()->name,'updated_at'=>date('Y-m-d H:i:s')]);

        if($simUpdate){

                  return redirect('sim/expiry')->with('success',''.$request['sim_no'].' In-Active Successfully.');
        }else{

             return redirect('sim/expiry')->with('error',''.$request['sim_no'].' Not In-Active.');
        }


  }

  /*
  *
  *
  *   //Download SIM Template
  */

  public function downloadTemplate(Request $request){

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=template_sim.csv");
    return readfile('template_sim.csv');

  }
  
  


}
