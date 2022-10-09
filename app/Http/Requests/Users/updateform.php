<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class updateform extends FormRequest
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
        $get_id = $this->route('admindata');
        echo"<pre>";
        print_r($id);
        exit;
        return [
            'first_name'=>'required',
            'mobile_number'=>'required|unique:users,mobile_number, '.$get_id.'|digits:10',
            'email'=>'required|email|unique:users,email, '.$get_id.'',

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Enter First Name',
            'mobile_number.unique' => 'Mobile Number Already Exists',        
            'mobile_number.required' => 'Enter Mobile Number',    
            'email.unique' => 'EmailId Already Exists',        
            'email.required' => 'Enter EmailId',     

            
        ];
    }
}
