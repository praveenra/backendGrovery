<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\Register;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Models\Sms;
use App\Http\Models\ResetCredentials;
use App\Http\Models\Settings;
use Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected $datas = array(
        'status'=>false, 
        'message' => 'Servr Busy Try After Sometime',
        'cart' =>'',
    );


    protected function validator(array $data)
    {
        exit;
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'mobile', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function UserRegister(Register $request){
        
        $get_settimgs = Settings::first();
        if($get_settimgs){
            $get_sponsor_id = User::where('user_id', $request->sponsorid)->first();
            $new_user = new User;
            if($get_sponsor_id){
                $user_result = $new_user->create_user($request, $get_sponsor_id);
                if($user_result['success']){
                    if(Auth::guard('user')->attempt(['user_id' => $request->user_id, 'password' => $request->password, 'user_type' =>0], $request->get('remember'))) {
                        $digits = 5;
                        $opt = rand(pow(10, $digits-1), pow(10, $digits)-1);
                        $sms = Sms::register(auth()->guard('user')->user()->mobile_number,auth()->guard('user')->user()->user_id, auth()->guard('user')->user()->password_user, auth()->guard('user')->user()->first_name);
                        ResetCredentials::create_record(auth()->guard('user')->user(), 3, $opt);
                        $this->datas['status']=true;
                        $this->datas['message']='Registered Successfully';
                        return response()->json( $this->datas);

                    }
                    else{
                        $this->datas['status']=true;
                        $this->datas['message'] = $user_result['message'];
                        return response()->json( $this->datas);
                    }
                    
                }
                else{
                    $this->datas['status']=false;
                    $this->datas['message'] = $user_result['message'];
                    return response()->json( $this->datas);
                }
            }
            else{
                $this->datas['status']=false;
                $this->datas['message'] = 'Sponsor Id does not exists';
                return response()->json( $this->datas);
            }
        }
        else{
            $this->datas['status']=false;
            $this->datas['message'] = 'Settings Not Yet created';
            return response()->json( $this->datas);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        exit;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
