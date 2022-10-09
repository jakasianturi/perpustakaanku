<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title'      => 'required',
            'thumbnail'   => 'required|image|max:1000',
            'content'     => 'required',   
            'user_id'     => 'required',   
        ];

        if($this->news) {
            $rules['thumbnail'] = [
                'nullable',
                'image',
                'max:1000',
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
            'title.required'         => 'Judul tidak boleh kosong.',
            'thumbnail.required'     => 'Thumbnail tidak boleh kosong.',
            'thumbnail.image'        => 'Thumbnail haruslah gambar.',
            'thumbnail.max'          => 'Ukuran thumbnail tidak boleh lebih dari 1Mb.',
            'content.required'       => 'Konten tidak boleh kosong.',
            'user_id.required'       => 'Penulis tidak boleh kosong.',
        ];
    }
}