<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoSettings extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'seo_settings';

    public $timestamps = false;

    protected $fillable = [
        'seo_id',
        'page',
        'lang',
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
