<?php

namespace App\Http\Requests\Products;

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
            'product_name'=>'required',
            'product_short_description'=>'required',
            'product_long_description'=>'required',
            //'product_stock'=>'required',
            'product_price'=>'required',
            'product_tax'=>'required',
			'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_sales_price'=>'required',
            'product_status'=>'required',
            'measurement_id'=>'required',
            'seller_id'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Enter Products Name',       
            'product_short_description.required' => 'Enter Product Short Description',    
            'product_long_description.required' => 'Enter Product Long Description', 
            //'product_stock.digits' => 'Enter Product Stock', 
            'product_price.required' => 'Enter Product Price', 
            'product_tax.required' => 'Enter Product Tax', 
            'product_sales_price.required' => 'Enter Product Sales Price', 
            'product_status.required' => 'Choose Product Status', 
            'measurement_id.required' => 'Choose Measurement', 
            'seller_id.required' => 'Choose Seller Id', 

            
        ];
    }
}
