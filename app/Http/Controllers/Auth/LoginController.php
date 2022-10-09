<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Login;
use Auth;
use Cart;
use Socialite;
use App\Models\ActivityLog;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $datas = array(
        'status'=>true, 
        'message' => 'Login Successful',
        'cart' =>'',
    );

    public function __construct(){
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:superadmin')->except('logout');
    }

    public function UserLogin(Login $request){
  
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' =>0], $request->get('remember'))) {
            return redirect()->intended('/users');
        }
        elseif(Auth::guard('user')->attempt(['mobile_number' => $request->email, 'password' => $request->password, 'user_type' =>0], $request->get('remember'))) {
            return redirect('users')->with('success', 'Logged In  Successfully');
        }
        elseif(Auth::guard('user')->attempt(['user_id' => $request->email, 'password' => $request->password, 'user_type' =>0], $request->get('remember'))){
            return redirect('users')->with('success', 'Logged In  Successfully');
        }
        else{
            return redirect('/')->with('failure', 'Invalid Credentails');
        }

        return back()->with('error','Invalid Credentials');
    }
	
	public function SellerLogin(Request $request){

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' =>2], $request->get('remember'))) {

            $activity_log = new ActivityLog;
            $activity_log->user_id = Auth::guard('seller')->user()->id;
            $activity_log->module = 'Login';
            $activity_log->activity = 'User Logged In';
            $activity_log->created_at = now();
            $activity_log->updated_at = now();
            $activity_log->save();

            return redirect()->intended('/seller');
        }
        $this->datas['status'] = false;
      
       //return back()->with('failure','Invalid Credentials');
       return back()->with('error','Invalid Credentials');

    }


    public function SuperadminLogin(Request $request){

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' =>4], $request->get('remember'))) {
            return redirect()->intended('/superadmin');
        }
        $this->datas['status'] = false;
      
       //return back()->with('failure','Invalid Credentials');
       return back()->with('error','Invalid Credentials');

    }

    public function adminLogin(Request $request){

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
    
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'user_type' =>3], $request->get('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }
        $this->datas['status'] = false;
        
       return back()->with('error','Invalid Credentials');

    }

    public function redirectToProvider()
    {
       return Socialite::with('facebook')->redirect();
    //  return Socialite::with('facebook')->stateless()->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
    }

}
