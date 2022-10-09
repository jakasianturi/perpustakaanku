<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name' => 'nullable|max:100',
            'site_footer' => 'nullable',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'ga_code' => 'nullable',
            'social_facebook' => 'nullable',
            'social_twitter' => 'nullable',
            'social_instagram' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'operational_time' => 'nullable',
            'google_map' => 'nullable',
            'address' => 'nullable|max:250',
            'about_title' => 'nullable|max:50',
            'about_thumbnail' => 'nullable|image|max:1000',
            'about_content' => 'nullable',
            'meta_description' => 'nullable|max:160',
            'meta_keyword' => 'nullable|max:250', 
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
            'site_name.max'     => 'Panjang karakter tidak boleh lebih dari 100.',
            'logo.image'          => 'File harus gambar.',
            'logo.max'          => 'Ukuran logo tidak boleh lebih dari 512Kb.',
            'logo.dimensions'   => 'Syarat dimensi logo: lebar tidak boleh lebih dari 400px, tinggi tidak boleh lebih dari 120px, lebar tidak boleh kurang dari 100px, tinggi tidak boleh kurang dari 30px.',
            'favicon.image'          => 'File harus gambar.',
            'favicon.max'       => 'Ukuran favicon tidak boleh lebih dari 512Kb.',
            'favicon.dimensions'   => 'Syarat dimensi favicon: lebar tidak boleh lebih dari 512px, tinggi tidak boleh lebih dari 512px, lebar tidak boleh kurang dari 20px, tinggi tidak boleh kurang dari 20px.',
            'about_title.max'     => 'Panjang karakter tidak boleh lebih dari 50.',
            'about_thumbnail.image'          => 'File harus gambar.',
            'about_thumbnail.max'       => 'Ukuran background tidak boleh lebih dari 1Mb.',
            'meta_description.max' => 'Panjang karakter tidak boleh lebih dari 120.',
            'meta_keyword.max'  => 'Panjang karakter tidak boleh lebih dari 150.',
        ];
    }
}