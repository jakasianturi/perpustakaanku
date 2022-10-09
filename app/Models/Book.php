<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'books';

    protected $fillable = [
        'book_id',
        'slug',
        'category_id',
        'bookshelf_id',
        'title',
        'author',
        'publisher',
        'publication',
        'isbn',
        'stock',
        'description',
        'cover',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'title',
            ],
        ];
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id')->withDefault();
    }
    public function bookshelf() {
        return $this->belongsTo('App\Models\Bookshelf', 'bookshelf_id', 'id')->withDefault();
    }
    public function borrow() {
        return $this->hasMany('App\Models\Borrow', 'book_id', 'id');
    }
}