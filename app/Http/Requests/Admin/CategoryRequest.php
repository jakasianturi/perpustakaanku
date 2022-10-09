<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'category_name' => [
                'required',
                'unique:categories,category_name,'
            ],    
        ];
        if($this->category) {
            $rules['category_name'] = [
                'required',
                'unique:categories,category_name,'.$this->category,
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_name.required' => 'Nama Kategori tidak boleh kosong.',
            'category_name.unique'   => 'Kategori Buku telah digunakan.'
        ];
    }

}