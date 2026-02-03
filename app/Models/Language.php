<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    // Table name
    protected $table = 'language';

    // Primary key (default: id, so no need to set)
    protected $primaryKey = 'id';

    // Auto-incrementing ID (default: true, so no need to set)
    public $incrementing = true;

    // If table doesn't have updated_at and created_at
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = [
        'lang_code',
        'flag_image',
        'title',
        'domain',
        'path',
        'about_url',
        'product_url',
        'blog_url',
        'contact_url',
        'uploads_folder',
        'images_folder',
        'blog_images_folder',
        'ga_code',
        'bitrix_form_code',
        'bitrix_widget_code',
        'sort'
    ];
}
