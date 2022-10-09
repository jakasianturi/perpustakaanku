<?php

namespace App\Http\Requests\Admin;

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
            'user_id'       => 'required',
            'borrow_date'   => 'required',
            'return_date'   => 'required',
            'total'         => 'required|integer',
            'status'        => 'required',   
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
            'user_id.required'          => 'Nama Peminjam tidak boleh kosong.',
            'borrow_date.required'      => 'Tanggal Peminjaman tidak boleh kosong.',
            'return_date.required'      => 'Tanggal Pengembalian tidak boleh kosong.',
            'total.required'            => 'Jumlah Buku tidak boleh kosong.',
            'total.integer'             => 'Jumlah Buku harus menggunakan angka..',
            'status.required'           => 'Status Peminjaman tidak boleh kosong.',
        ];
    }
}