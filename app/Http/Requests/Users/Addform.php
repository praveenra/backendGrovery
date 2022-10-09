<?php

namespace App\Http\Requests\Users;

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

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Enter First Name',
            'mobile_number.unique' => 'Mobile Number Already Exists',        
            'mobile_number.required' => 'Enter Mobile Number',    
            'mobile_number.digits:10' => 'Enter Valid Mobilenumber',
            'email.unique' => 'EmailId Already Exists',        
            'email.required' => 'Enter EmailId',   
            'password.required' => 'Enter Password',       

            
        ];
    }
}
