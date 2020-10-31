<?php

namespace Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //SUPER ADMIN processing for view 
        // if ( Auth::user()->is_super_admin === 1){
            // $device = DB::table('device')
            // ->where('expiry_date','<=',date('Y-m-d'))
            // ->get();

            $deviceEx = DB::select("SELECT * FROM `device` WHERE  DATE_ADD(selling_date,  INTERVAL billing_frequency DAY) < '".date('Y-m-d')."'  AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive'");
            $totalExDevice = count($deviceEx);

            $simEx = DB::select("SELECT * FROM `sim` WHERE DATE_ADD(sale_date, INTERVAL billing_frequency DAY) < '".date('Y-m-d')."' AND features_allowed != '".SOFT_DELETE_FLAG."' AND status !='InActive'");
            $totalExSim = count($simEx); // sim count expire date

            //dd('totalExDevice '.$totalExDevice.' totalExSim '.$totalExSim);
            // total device
            $totalDevice=DB::table('device')
              ->where('status','!=','InActive')
              ->where('features_allowed','!=',SOFT_DELETE_FLAG)
              ->count();

            // total sim
            $totalSim=DB::table('sim')
              ->where('status','!=','InActive')
              ->where('features_allowed','!=',SOFT_DELETE_FLAG)
              ->count();


             // total customer
            $totalCustomer = DB::table('customer')
            //->where('features_allowed','!=',SOFT_DELETE_FLAG)
            ->count(); 


            // total accounts
            $totalAccounts = DB::table('users')
            ->count();
            
            // total challan
            $totalChallan = DB::table('challan_no')
            ->count(); 

                
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
            $totalBarcodestock  = count($stock);


            
             $deviceInDeliveryChallan = DB::table('delivery_challan')
              ->where('item_type','Device')
              ->get();

              $imeichallan = array();
              foreach ($deviceInDeliveryChallan as $key => $value) {
                $imeichallan[] = $value->items;
              }

            //dd($imeichallan);
            $deviceStock = DB::table('device')
                      ->select('device_type', DB::raw('count(*) as total'))
                      ->where('features_allowed','!=',SOFT_DELETE_FLAG)
                      ->where(function($query) use ($imeichallan)  {
                            if(!empty($imeichallan)) {
                                $query->whereNotIn('imei', $imeichallan);
                            }
                       })
                      ->groupBy('device_type')
                      ->get();
            //dd($deviceStock);



            $simInDeliveryChallan = DB::table('delivery_challan')
              ->where('item_type','sim')
              ->get();

              $simnochallan = array();
              foreach ($simInDeliveryChallan as $key => $value) {
                $simnochallan[] = $value->items;
              }

            //dd($simnochallan);
            $simStock = DB::table('sim')
                      ->select('sim_provider', DB::raw('count(*) as total'))
                      ->where('features_allowed','!=',SOFT_DELETE_FLAG)
                      ->where(function($query) use ($simnochallan)  {
                            if(!empty($simnochallan)) {
                                $query->whereNotIn('sim_no', $simnochallan);
                            }
                       })
                      ->groupBy('sim_provider')
                      ->get();
            //dd($simStock);

            $stock = DB::table('advgps.barcode_imei_inventory')
                      ->whereNotIn('imei',$imei)
                      ->get();

            //$totalExDevice = count($device); // device count expire date


            $otherstock=DB::table('other_stock')
             ->where('status','!=',SOFT_DELETE_OTHER_STOCK_FLAG)
             ->get();

            foreach ($otherstock as  $value) {
              $value->available_stock = abs($value->quantity - $value->sold_stock);
            }

            return view('home',['totalExDevice'=>$totalExDevice,'totalExSim'=>$totalExSim,'totalDevice'=>$totalDevice,'totalSim'=>$totalSim,'totalCustomer'=>$totalCustomer,'totalAccounts'=>$totalAccounts,'totalChallan'=>$totalChallan,'totalBarcodestock'=>$totalBarcodestock,'simStock'=>$simStock,'deviceStock'=>$deviceStock,'otherstock'=>$otherstock]); 
            
        
    }
    // super admin login multiple
    public function adminUserLogin(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');

        //dd("id - ".$id." email - ".$email);

        session_unset('user_admin');
        session(['user_admin' => Auth::id()]);
        
        Log::info("Admin user id ".Auth::id());
        
        //login to admin panel
        Auth::loginUsingId($id);
        
        return redirect('home');   
    }

    /*
    * setting 
    */
    public function settings(Request $request){

        return view('settings');
    }

    /*
    * setting 
    */
    public function recentactivity(Request $request){

        $this->validate($request,[
            'type' => 'required',
            'recentactivityday' => 'required',
            ],[
            'type.required' => 'The Type field is required.',
            'recentactivity.required' => 'The Recent Activity field is required.',
        ]);
        // para 
        $type = $request['type'];
        $recentactivityday = $request['recentactivityday'];

        $checkEx = DB::table('recentactivity')->where('type',$type)->first(); // get insert id
        
          if(empty($checkEx) || $checkEx === null){

            $query = DB::table('recentactivity')->insertGetId(array('type' =>$type ,'recentactivityday'=>$recentactivityday,'created_at'=>date('Y-m-d H:i:s')));

          }else {

            $query = DB::table('recentactivity')->where('type',$type)->update(array('recentactivityday'=>$recentactivityday,'created_at'=>date('Y-m-d H:i:s')));
          }
          
          if(!empty($query)){
               
            return redirect('Settings')->with('success',' '.$request['type'].' '.$recentactivityday.' days Save Successfully');
                
          }else {
              return redirect('Settings')->with('error','somethings wrong. please check again');
          }         
    }

    /*
    *
    * /// my Profile 
    *
    *
    */
    public function myProfile(){

        return view('myProfile');
    }
    /*
    *
    * /// change / update  my Profile 
    *
    *
    */
    public function updateProfile(Request $request, $accountId){

         $this->validate($request,[
            'name' => 'required|min:3|max:225',
          ],[
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
          ]);

         $rows = DB::table('users')
                        ->where('id', $accountId)
                        ->update([
                            'name' => $request['name'],
                            'displayName' => $request['display_name'],
                            'address' => $request['address'],
                            'updated_at' => date('Y-m-d H:i:s'),
                            ]);

            if ( $rows ) {
                return redirect('myProfile')->with('success', 'Yours Profile has been updated successfully!');  //back to password change    
            }
            else{
                return redirect('myProfile')->with('error', 'Yours Profile updated failed!');  //back to password change    
            }

    }
    /*
    *
    *
    *
    * /// change password 
    *
    *
    */
    public function passwordChangeView(){

        return view('passwordChange');
    }
    /*
    *
    *
    *
    * Change Password 
    */
    public function passwordChange(Request $request){

        $this->validate($request, [
            'new_password' => 'required|min:6',
            'password_conform' => 'required|min:6|same:new_password',
        ]);
        
            $password = bcrypt($request['new_password']);
            
            $rows = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update([
                            'password' => $password,
                            'updated_at' => date('Y-m-d H:i:s'),
                            ]);

            if ( $rows ) {
                return redirect('passwordChange')->with('success', 'Yours password has been updated successfully!');  //back to password change    
            }
            else{
                return redirect('passwordChange')->with('error', 'Yours password updated failed!');  //back to password change    
            }
    }


    
    //reset password for user using api method
    // public function resetUserPassword(Request $request) 
    // {
    //     $email = $request['email'];

    //     $user = \App\UserCanReset::where('email',$email)->first();
        
    //     if ( !empty($user))
    //         Log::info("User $user->email found");
    //     else
    //         return response()->json(['message' => $email.' not found.']);

    //     //if user found
    //     if ( !empty($user) ) {
    //         $token = $this->getPasswordToken($user);
    //         Log::info("Password token=$token user=$user->email");
    //         $manager = \App\User::where('id',$user->managerId)->first();
    //         $fromEmail = $manager->fromEmail;
    //         $brandName = $manager->brandName;

    //         $title = 'Reset Password';
    //         $subject = 'Reset Password from '.$brandName;
    //         $content =  WEB_BASE_URL.'tracking/password/reset/'.$token;
    //         Log::info("Password token=$token user=$user->email, fromEmail=$fromEmail content=$content");
    //         //Send email with reset password link

    //         Mail::to($user->email)
    //                 // ->cc($user->ccEmail)
    //                 // ->bcc($user->bccEmail)
    //                 ->send(new PasswordResetNotification($title, $user->email, $fromEmail, $content, $brandName));
    //                 Log::info("Sending Password Reset email:  ".$email.", content=".$content);

    //         return response()->json(['message' => 'Reset Password email has been sent to you!']);
    //     }else{
    //         return response()->json(['message' => $email.' not found.']);
    //     }       
    // }


}
