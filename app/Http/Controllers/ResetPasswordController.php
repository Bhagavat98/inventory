<?php

namespace Inventory\Http\Controllers;

use Cache;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\UserCanReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Mail;
use App\Mail\PasswordResetNotification;

class ResetPasswordController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('resetPassword');
    }
   //get password token
    public function getPasswordToken($user)
    {
        //THis will create new entry or update if password token is not expired in password_reset table
        $token = app('auth.password.broker')->createToken($user);
        Log::info("User $user->email , token: $token");
        return $token;
    }
    //reset password for user 
    public function resetUserPassword(Request $request) 
    {
    	$this->validate($request, [
            'email' => 'required|min:6',
        ]);

        $email = $request['email'];
        

        $user = DB::table('users')->where('email',$email)->first();
        
        if ( !empty($user))
            Log::info("User $user->email found");
        else
            return response()->json(['message' => $email.' not found.']);

        //if user found
        if ( !empty($user) ) {
            $token = $this->getPasswordToken($user);
            Log::info("Password token=$token user=$user->email");
            $manager = \App\User::where('id',$user->managerId)->first();
            $fromEmail = 'bsolanke9890@gmail.com';//$manager->;
            $name = $manager->name;

            $title = 'Reset Password';
            $subject = 'Reset Password from '.$brandName;
           // $content =  WEB_BASE_URL.'tracking/password/reset/'.$token;
            $content =  WEB_BASE_URL.'Inventory/resetPassword/'.$token;
            Log::info("Password token=$token user=$user->email, fromEmail=$fromEmail content=$content");
            //Send email with reset password link

            Mail::to($user->email)
                    // ->cc($user->ccEmail)
                    // ->bcc($user->bccEmail)
                    ->send(new PasswordResetNotification($title, $user->email, $fromEmail, $content, $name));
                    Log::info("Sending Password Reset email:  ".$email.", content=".$content);

            return response()->json(['message' => 'Reset Password email has been sent to you!']);
        }else{
            return response()->json(['message' => $email.' not found.']);
        }       
    }

    


}
