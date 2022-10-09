<?php

namespace App\Http\Requests\MainCategory;

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
            'mc_name'=>'required',
           // 'mc_seller_id'=>'required',
            'mc_commision'=>'required',
            'mc_status'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'mc_name.required' => 'Enter Maincategory Name',       
            //'mc_seller_id.required' => 'Choose Maincategory Seller',    
            'mc_commision.required' => 'Enter Maincategory Commission', 
            'mc_status.digits' => 'Choose Maincategory Status',
            
        ];
    }
}
