<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Models\ResetCredentials;
use Carbon\Carbon;
use App\User;
use App\Http\Models\Sms;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function UserResendotp(Request $request){
        $this->validate($request, [
            'email'   => 'required',
            'mobile_number'   => 'required',
        ]);

        $get_user_details=  User::where('mobile_number',$request['mobile_number'])->where('user_type',0)->first();
        if($get_user_details){
            $digits = 5;
            $email = $request['email'];
            $opt = rand(pow(10, $digits-1), pow(10, $digits)-1);
            $sms = Sms::registred_otp($request->mobile_number, $opt);
            ResetCredentials::create_record($get_user_details, 3, $opt);
            return redirect('/verifyotp')->with('success','Otp Send to your mobile number');
        }
        else{
            return redirect()->back()->with('failure','Invalid Credentials');
        }
    }

    public function UserVerfity(Request $request){
        $this->validate($request, [
            'mobile_number'   => 'required',
            'otp'   => 'required',
        ]);
        $data = $request->all();
        $get_user_details=  User::where('mobile_number',$data['mobile_number'])->where('user_type',0)->first();
        if($get_user_details){
            $get_otp = ResetCredentials::where('rc_us_id',$get_user_details->id)->where('rc_otp',$data['otp'])->where('rc_status',0)->first();
            if($get_otp){
              
                $updated_at = $get_otp['rc_date_time'];
                $updated_at = new Carbon($updated_at);
                $timeNow = Carbon::parse('now');
                $diffInMinutes = $updated_at->diffInMinutes($timeNow);
                if(($diffInMinutes > 0)){
                   
                    User::where('mobile_number',$data['mobile_number'])->update(array('user_verified' => 1));
                    ResetCredentials::where('rc_us_id',$get_user_details->id)->where('rc_otp',$data['otp'])->where('rc_status',0)->delete();                            
                    if(Auth::guard('user')->attempt(['mobile_number' => $get_user_details->mobile_number, 'password' => $get_user_details->password_user, 'user_type' =>0], $request->get('remember'))) {
                        return redirect('users')->with('success', 'Logged In  Successfully');
                    }
                    elseif(Auth::guard('user')->attempt(['user_id' => $get_user_details->mobile_number, 'password' => $get_user_details->password_user, 'user_type' =>0], $request->get('remember'))){
                        return redirect('users')->with('success', 'Logged In  Successfully');
                    }
                    else{
                        return redirect('/')->with('failure', 'Invalid Credentails');
                    }
                }
                else{
                    return redirect()->back()->with('failure','Otp expired');
                }
            }
            else{
                return redirect()->back()->with('failure','Invalid Otp');
            }
        
            return redirect()->back()->with('failure','Otp Send to your mail id and mobile number');
        }
        else{
            return redirect()->back()->with('failure','Invalid Mobile Number');
        }
    }
}
