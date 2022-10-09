<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'borrow_books';

    protected $fillable = [
        'book_id',
        'user_id',
        'borrow_date',
        'return_date',
        'total',
        'status',
        'returned_date',
        'book_fine',
    ];

    public function book() {
        return $this->belongsTo('App\Models\Book', 'book_id', 'id')->withDefault();
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withDefault();
    }
}