<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRequest extends FormRequest
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
            'book_id'       => 'required',
            'borrow_date'   => 'nullable',
            'total'         => 'required', 
        ];

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
            'book_id.required'          => 'Nama Buku tidak boleh kosong.',
            'total.required'            => 'Jumlah Buku tidak boleh kosong.',
        ];
    }
}