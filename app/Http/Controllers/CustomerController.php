<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
//use Distributor\UserModel\ApiUserModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inventory\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;

class CustomerController extends Controller
{     
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
       load view accounts index
    */
    public function index(){

     	return view('customer');
    }
    /*
     get all Account send view
    */
    public function GetAllCustomer(){
      

      $sql=DB::table('customer')
      //->where('manager_id',Auth::user()->id)
      ->get();

      // set data 
      $data = array();
      foreach ($sql as $value) {

        $role = userRole($value->id);

        if ($value->customer_type ==  'end_customer') {
          $customer_type = 'End Customer';
        }else if ($value->customer_type ==  'distributor') {
          $customer_type = 'Distributor';
        }else if ($value->customer_type == 'retailer') {
          $customer_type = 'retailer';
        }else{
          $customer_type = 'other';
        }

        $data['data'][] = array('id'=>$value->id,
                                'name' => $value->name,
                                'email'=>$value->email,
                                'mobile' => $value->mobile,
                                'billing_code'=>$value->billing_code,
                                'application'=>$value->application,
                                'customer_type'=>$customer_type,
                                'created_at_employee'=>$value->created_at_employee,
                                'created_at'=>$value->created_at,
                                'updated_at'=>$value->updated_at

                              );
      }
     

      if (!empty($data) ) { 
        echo json_encode($data);
      }else{
       echo "{\"data\":[]}";
      }



    }

    /*
    * customer add view return
    *
    */
    public function addCustomer(Request $request){


      $maxID =  DB::table('customer')->max('id');
      if (empty($maxID)) { // if first time set 0
        $maxID =0;
      }

        $five_digit_random_number = mt_rand(10000, 99999);

        $billing_code = $five_digit_random_number.$maxID;
        //dd($billing_code);

        return view('addCustomer',['billing_code'=>$billing_code]);

    }

    /*
      Create new customer 
    */
    public function Create(Request $request){

        $request->validate([
            'name' => 'required|min:3|max:225',
            'email' => 'required|email|unique:customer,email',
            'mobile' => 'required|min:10|unique:customer,mobile',
            'customer_type' => 'required'
        ]);

        $data = array('name' => $request['name'],
                      'mobile'=>$request['mobile'],
                      'email'=>$request['email'],
                      'application'=>$request['application'],
                      'address'=>$request['address'],
                      'customer_type'=>$request['customer_type'],
                      'billing_code'=>$request['billing_code'],
                      'created_at_employee'=>Auth::user()->id,//$request['employee'],
                      'manager_id'=> Auth::user()->id,
                      'created_at' => date('Y-m-d H:i:s'),
                      'updated_at' => date('Y-m-d H:i:s'),
                    );

          $insertId = DB::table('customer')->insertGetId($data);

          if($insertId!=0){
                return redirect('customer/add')->with('success',''.$request['name'].' Customer Successfully.');
          }else
          {
               return redirect('customer/add')->with('error','Customer Not Added.');
          }
                    
  }

  /*
      edit view reture 
  */
  public function edit($custID){


        $customer = DB::table('customer')
        ->where('id',$custID)
        ->first();

        return view('editCustomer',['customer'=>$customer]);                
  }


    /*
    *
    *
      update customer 
    */
    public function update(Request $request, $custID){

        $request->validate([
            'name' => 'required|min:3|max:225',
            'email' => 'required|email|unique:customer,email'.$custID,
            'mobile' => 'required|min:10|unique:custmer,mobile'.$custID,
            'customer_type' => 'required'
        ]);

        $data = array('name' => $request['name'],
                      'mobile'=>$request['mobile'],
                      'email'=>$request['email'],
                      'application'=>$request['application'],
                      'address'=>$request['address'],
                      'customer_type'=>$request['customer_type'],
                      'created_at_employee'=>Auth::user()->id,//$request['employee'],
                      'updated_at' => date('Y-m-d H:i:s'),
                    );

          $update = DB::table('customer')->where('id',$custID)->update($data);

          if($update){
              return redirect('Customer')->with('success',''.$request['name'].' Update Successfully.');
              
          }else
          {
              return redirect('customer/edit/'.$custID.'')->with('error','Update Not Added.');
          }
                    
  }


  /*
     delete Customer
  */ 
  public function CustomerDelete(Request $request){

    $name = DB::table('customer')->where('id',$request['id'])->value('name');

    $sqlDelete = DB::table('customer')
    ->where('id',$request['id'])
    ->delete();

    if ($sqlDelete) {
      $data = array('success' => true,'message'=>''.$name.' Deleted Successfully.');
      return response()->json($data); 
    }else{
      $data = array('success' => false,'message'=>'Customer Not Deleted!');
      return response()->json($data);
    }

  } 
  

}
