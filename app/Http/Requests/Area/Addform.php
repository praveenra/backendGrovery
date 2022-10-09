<?php

namespace App\Http\Requests\Area;

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
            'area_name' => 'required',
            'area_cityid' => 'required', 
           // 'ab_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           // 'link' => 'required',
            'area_status' => 'required|numeric'
        ];
    }
}
