<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StaticText extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'static_text';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'lang',
        'title',
        'page_name',
        'text_id',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];

}
