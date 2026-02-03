<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FooterInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'footer_info';

    protected $fillable = [
        'lang',
        'address',
        'phone',
        'email',
        'map_url',
        'facebook_url',
        'youtube_url',
        'linkedin_url',
        'x_url',
        'instagram_url',
        'footer_text',
        'footer_logo',
        'alt',
    ];

    protected $dates = ['created_at', 'deleted_at'];

    public $timestamps = false; // we are only using created_at, no updated_at
}
