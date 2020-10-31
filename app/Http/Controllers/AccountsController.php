<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
//use Distributor\UserModel\ApiUserModel;
use Inventory\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inventory\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;

class AccountsController extends Controller
{     
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
       load view accounts index
    */
    public function index(){

     	return view('accounts');
    }
    /*
     get all Account send view
    */
    public function GetAllAccounts(){
      

      
      if (Auth::user()->is_super_admin == 1) {
        
        $sql=DB::table('users')
        ->get();
      }else{

        $sql=DB::table('users')
        ->where('id',Auth::user()->id)
        ->get();

      }



      // set data 
      $data = array();
      foreach ($sql as $value) {

        $role = userRole($value->id);

        $data['data'][] = array('id'=>$value->id,
                                'name' => $value->name,
                                'role'=>$role,
                                'email'=>$value->email,
                                'mobile' => $value->mobile,
                                'address'=>$value->address
                              );
      }
      if (!empty($data) || !is_null($data) || isset($data) ) { 
        echo json_encode($data);
      }else{
       echo "{\"data\":[]}";
      }
    

    }
    /*
      validator form
    */
    public function Validator($request){
    
      $this->validate($request,[
            'name' => 'required|min:3|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,mobile'
          ],[
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'mobile.required' =>'The name field is required.',
            'mobile.min' =>'Required 10 digits, match requested format!.'
          ]);

    }
    /*
      Create new Accounts 
    */
    public function Create(Request $request){

        //validate function call
        $this->Validator($request);

        $name = $request['name'];
        $dname = $request['dname'];
        $email = $request['email'];
        $mobile = $request['mobile'];
        $address = $request['address'];
        $password = $request['password'];
        $role = $request['role'];

        $is_admin = 0; $is_user = 0;
        if ($role  == 'admin') {
          $is_admin = 1;
        }else if ($role == 'user') {
          $is_user = 1;
        }
         if (empty($dname) || is_null($dname)) {
           $dname = $name;
         }

        $data = array('name' => $name,
                      'displayName'=>$dname,
                      'mobile'=>$mobile,
                      'email'=>$email,
                      'is_admin'=>$is_admin,
                      'is_user'=>$is_user,
                      'manager_id'=> Auth::user()->id,
                      'address'=>$address,
                      'created_at' => date('Y-m-d H:i:s'),
                      'updated_at' => date('Y-m-d H:i:s'),
                      'password'=> Hash::make($password) 
                    );

          $insertId = DB::table('users')->insertGetId($data);

          if($insertId!=0){
                return redirect('account/add')->with('success',''.$name.' Added Successfully.');
          }else
          {
               return redirect('account/add')->with('error','Account Not Added.');
          }
                    
  }

  /*
     delete Accounts
  */ 
  public function AccountDelete(Request $request){

    $name = DB::table('users')->where('id',$request['id'])->value('name');

    $sqlDelete = DB::table('users')
    ->where('id',$request['id'])
    ->delete();

    if ($sqlDelete) {
      $data = array('success' => true,'message'=>''.$name.' Deleted Successfully.');
      return response()->json($data); 
    }else{
      $data = array('success' => false,'message'=>'Account Not Deleted!');
      return response()->json($data);
    }

  } 
  

}
