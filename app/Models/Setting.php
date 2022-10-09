<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = [
        'site_name',
        'site_footer',
        'logo',
        'favicon',
        'ga_code',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'email',
        'phone',
        'operational_time',
        'google_map',
        'address',
        'about_title',
        'about_thumbnail',
        'about_content',
        'meta_description',
        'meta_keyword',
    ];
}