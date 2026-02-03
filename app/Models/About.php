<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    // Specify the table name (optional if model name matches table)

    protected $table = 'about_page';

    protected $fillable = [
        'lang',
        'upper_title',
        'title',
        'title_1',
        'description',
        'image',
        'banner_image',
        'alt',
        'bg_video',
        'mission_title',
        'mission_text',
        'mission_image',
        'vision_title',
        'vision_text',
        'vision_image',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    public $timestamps = false;

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
    ];
}
