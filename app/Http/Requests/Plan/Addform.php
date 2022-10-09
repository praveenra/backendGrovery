<?php

namespace App\Http\Requests\Plan;

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
            'plan_name' => 'required',
            'plan_duration' => 'required', 
            'plan_offer' => 'required', 
            'plan_amount' => 'required', 
           // 'ab_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           // 'link' => 'required',
            'plan_status' => 'required|numeric'
        ];
    }
}
