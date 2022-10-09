<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'book_id'       => 'required|unique:books,book_id',
            'category_id'   => 'required',
            'bookshelf_id'  => 'required',
            'title'         => 'required',
            'author'        => 'required',
            'publisher'     => 'required',
            'publication'   => 'required',
            'isbn'          => 'required',
            'stock'         => 'required',
            'description'   => 'required',
            'cover'         => 'nullable|image|max:1000',    
        ];
        if($this->book) {
            $rules['book_id'] = [
                'required',
                'unique:books,book_id,'.$this->book,
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
            'book_id.required'      => 'ID Buku tidak boleh kosong.',
            'book_id.unique'        => 'ID Buku telah digunakan.',
            'category_id.required'  => 'Kategori tidak boleh kosong.',
            'bookshelf_id.required' => 'Rak Buku tidak boleh kosong.',
            'title.required'        => " Judul tidak boleh kosong.",
            'author.required'       => "Penulis tidak boleh kosong.",
            'publisher.required'    => "Penerbit tidak boleh kosong.",
            'publication.required'  => "Tahun Terbit tidak boleh kosong.",
            'isbn.required'         => "ISBN tidak boleh kosong.",
            'stock.required'        => "Stok tidak boleh kosong.",
            'description.required'  => "Deskripsi tidak boleh kosong.",
            'cover.image'           => "File harus gambar.",
            'cover.max'             => 'Ukuran sampul tidak boleh lebih dari 1Mb.',
        ];
    }
}