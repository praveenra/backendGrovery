<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class Addform extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      /*  echo "<pre>";
        print_r($this->request);
        exit;*/
        return [
            'first_name'=>'required',
            'mobile_number'=>'required|unique:users|digits:10',
            'email'=>'required|email|unique:users',
            'password' => 'required|string|min:6',
            'storedetails.main_category'=>'required',
            'storedetails.sd_sname'=>'required',
            'storedetails.sd_snumber'=>'required|digits:10',
            'storedetails.sd_sadminshare'=>'required',
            'storedetails.sd_scityid'=>'required',
            'storedetails.sd_sdeliverykm'=>'required',
            'storedetails.sd_address'=>'required',
            'storedetails.sd_spincode'=>'required|digits_between:6,7',
            'storedetails.sd_lat'=>'required',
            'storedetails.sd_lng'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Enter First Name',
            'mobile_number.unique' => 'Mobile Number Already Exists',        
            'mobile_number.required' => 'Enter Mobile Number',    
            'mobile_number.digits' => 'Mobile Number Must Be 10 Digits',
            'email.unique' => 'EmailId Already Exists',        
            'email.required' => 'Enter EmailId',   
            'password.required' => 'Enter Password',   
            'storedetails.sd_sname.required' => 'Enter store Name',    
            'storedetails.main_category.required' => 'Choose Main Category',    
            'storedetails.sd_snumber.required' => 'Enter store Number', 
            'storedetails.sd_snumber.digits' => 'store Number Must Be 10 Digits', 
            'storedetails.sd_sadminshare.required' => 'Enter Admin Share', 
            'storedetails.sd_scityid.required' => 'Choose City', 
            'storedetails.sd_sdeliverykm.required' => 'Enter store delivery Km', 
            'storedetails.sd_address.required' => 'Enter store Address', 
            'storedetails.sd_spincode.required' => 'Enter store Pincode', 
            'storedetails.sd_spincode.digits_between' => 'Pincode must be between 6 and 7 Digits',
            'storedetails.sd_lat.required' => 'Enter store Latitude',
            'storedetails.sd_long.required' => 'Enter store Longitude',

            
        ];
    }
}
