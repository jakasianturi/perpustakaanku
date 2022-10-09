<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookshelfRequest extends FormRequest
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
            'bookshelf_name' => [
                'required',
                'unique:bookshelves,bookshelf_name,'
            ],    
        ];
        if($this->bookshelf) {
            $rules['bookshelf_name'] = [
                'required',
                'unique:bookshelves,bookshelf_name,'.$this->bookshelf,
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
            'bookshelf_name.required' => 'Nama Rak Buku tidak boleh kosong.',
            'bookshelf_name.unique'   => 'Rak Buku telah digunakan.'
        ];
    }
}