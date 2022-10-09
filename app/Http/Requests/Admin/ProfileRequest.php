<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|unique:users,email,'.$this->user,
            'address'   => 'nullable|max:250',
            'phone'     => 'nullable|max:20',
            'gender'    => 'nullable',
            'password'  => 'nullable|min:8|confirmed',   
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
            'name.required'         => 'Nama Lengkap tidak boleh kosong.',
            'email.required'        => 'Alamat Email tidak boleh kosong.',
            'email.unique'          => 'Alamat Email sudah digunakan.',
            'password.required'     => 'Password tidak boleh kosong.',
            'password.min'          => 'Panjang password harus lebih dari 8 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak sesuai.',
        ];
    }
}