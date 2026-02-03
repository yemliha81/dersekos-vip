<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogSlider extends Model
{

    protected $table = 'blog_slider';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'slider_id',
        'blog_id',
        'lang',
        'media_file',
        'alt',
        'sort',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];

}
