<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'page';

    public $timestamps = false;

    protected $fillable = [
        'page_id',
        'lang',
        'title',
        'seo_url',
        'description',
        'image',
        'alt',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];
    
}
