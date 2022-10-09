<?php

namespace App\Http\Requests\Offer;

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
        return [
            'name' => 'required',
            'amount' => 'required', 
            'offer_condition' => 'required', 
            'code' => 'required', 
           // 'ab_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           // 'link' => 'required',
            'status' => 'required|numeric'
        ];
    }
}
