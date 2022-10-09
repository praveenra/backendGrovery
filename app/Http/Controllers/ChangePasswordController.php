<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class ChangePasswordController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    
        if(Auth::guard('superadmin')->user() != null){
            $this->data['user'] = Auth::guard('superadmin')->user();
            return view('common/admin/superadmin_changePassword',$this->data);
        }elseif(Auth::guard('admin')->user() != null){
            $this->data['user'] = Auth::guard('admin')->user();
            return view('common/admin/admin_changePassword',$this->data);
        }elseif(Auth::guard('seller')->user() != null){
            $this->data['user'] = Auth::guard('seller')->user();
            return view('common/admin/seller_changePassword',$this->data);
        }

    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {

       $user=User::where('id',$request->id)->first();

       // $user->password   = $request->password;
       $user->password = Hash::make($request->password);
       $user->save();
       
        return redirect('change-password')->with('success','Password updated successfully');
    }
}