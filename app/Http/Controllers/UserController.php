<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\User;
use Image;

class UserController extends Controller
{
    public function profile(){
    	if(Auth::guard('superadmin')->user() != null){
    		$this->data['user'] = Auth::guard('superadmin')->user();
    		return view('common/admin/superadmin_profile',$this->data);
    	}elseif(Auth::guard('admin')->user() != null){
    		$this->data['user'] = Auth::guard('admin')->user();
    		return view('common/admin/admin_profile',$this->data);
    	}elseif(Auth::guard('seller')->user() != null){
    		$this->data['user'] = Auth::guard('seller')->user();
    		return view('common/admin/seller_profile',$this->data);
    	}
    }

    public function update_profile_image(Request $request){

    	if(Auth::guard('superadmin')->user() != null){

    		if($request->hasFile('profile_image')){
                // echo "<pre>";
            // print_r($request->hasFile('profile_image'));
            // exit();
                // dd($request->file('profile_image'));
    		$profile_image = $request->file('profile_image');
    		$filename = time() . '.' . $profile_image->getClientOriginalExtension();
		    $profile_image->move(public_path('uploads/profile_image/'. $filename));  
    		$user = Auth::guard('superadmin')->user();
    		$user->profile_image = $filename;
    		$user->save();
            // dd($user);
    		array('user' => Auth::guard('superadmin')->user());
    	}
	    	return view('common/admin/superadmin_profile',array('user' => Auth::guard('superadmin')->user()) );
	    }elseif(Auth::guard('admin')->user() != null){

            if($request->hasFile('profile_image')){
            $profile_image = $request->file('profile_image');
            $filename = time() . '.' . $profile_image->getClientOriginalExtension();
            $profile_image->move(public_path('uploads/profile_image/'. $filename));  
            $user = Auth::guard('admin')->user();
            $user->profile_image = $filename;
            $user->save();
            array('user' => Auth::guard('admin')->user());
            }
            return view('common/admin/seller_profile',array('user' => Auth::guard('admin')->user()) );
	    }elseif(Auth::guard('seller')->user() != null){

            if($request->hasFile('profile_image')){
            $profile_image = $request->file('profile_image');
            $filename = time() . '.' . $profile_image->getClientOriginalExtension();
            $profile_image->move(public_path('uploads/profile_image/'. $filename));  
            $user = Auth::guard('seller')->user();
            $user->profile_image = $filename;
            $user->save();
            array('user' => Auth::guard('seller')->user());
            }
            return view('common/admin/seller_profile',array('user' => Auth::guard('seller')->user()) );
        }

    }


    public function data()
    {

        if(Auth::guard('superadmin')->user() != null){
            $this->data['user'] = Auth::guard('superadmin')->user();
            return view('common/admin/superadmin_profile_detail',$this->data);
        }elseif(Auth::guard('admin')->user() != null){
            $this->data['user'] = Auth::guard('admin')->user();
            return view('common/admin/admin_profile_detail',$this->data);
        }elseif(Auth::guard('seller')->user() != null){
            $this->data['user'] = Auth::guard('seller')->user();
            return view('common/admin/seller_profile_detail',$this->data);
        }

    }

    public function update(Request $request)
    {
             
        // dd($request);
      $user=User::where('id',$request->id)->first();

       $user->first_name   = $request->first_name;
       $user->email        = $request->email;  
       $user->save();
       
        return redirect('profile_detail')->with('success','User Detail updated successfully');
    }   



}
