<?php

namespace App\Http\Requests\Subcategory;

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
            'cat_name' => 'required', 
            'cat_is_parent_id' => 'required', 
            'cat_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           // 'link' => 'required',
            'cat_status' => 'required|numeric'
        ];
    }
}
