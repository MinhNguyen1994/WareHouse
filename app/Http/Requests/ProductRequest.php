<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'name'              => 'required|min:3|string',
            'description'       => 'required',
            'code'              => 'required|string|max:4|min:2'
            'quanlity'          => 'required',
            'unit'              => 'required',
            'productGroup'      => 'required',
            'name_unit'         => 'required|min:3',
            'code_unit'         => 'required|string|max:4|min:2',
            'description_unit'  => 'required'
        ];
    }
}
