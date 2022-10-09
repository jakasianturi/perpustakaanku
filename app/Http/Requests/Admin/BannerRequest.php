<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'description'     => 'required',   
            'button_text'     => 'nullable',   
            'button_url'     => 'nullable',   
            'background'   => 'required|image|max:1000',
        ];

        if($this->banner) {
            $rules['background'] = [
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
            'background.required'    => 'Background tidak boleh kosong.',
            'description.required'   => 'Deskripsi tidak boleh kosong.',
            'background.image'         => 'Background haruslah gambar.',
            'background.max'         => 'Ukuran background tidak boleh lebih dari 1Mb.',
        ];
    }
}