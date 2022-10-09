<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookshelf extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookshelves';

    protected $fillable = [
        'bookshelf_name',
    ];

    public function book() {
        return $this->hasMany('App\Models\Book', 'bookshelf_id', 'id');
    }
}