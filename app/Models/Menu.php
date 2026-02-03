<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    // Specify the table name (optional if model name matches table)
    protected $table = 'menu';

    // Specify the primary key (optional if 'id')
    protected $primaryKey = 'id';

    public $timestamps = false;

    // Specify fillable columns
    protected $fillable = [
        'parent_menu_id',
        'menu_id',
        'lang',
        'title',
        'seo_url',
        'image',
        'alt',
        'menu_type',
        'page_type',
        'url_block',
        'sort',
        'isActive',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];

    // If your enum menu_type has specific values, you can define them as constants
    const TYPE_HEADER = 'header';
    const TYPE_FOOTER = 'footer';
    const TYPE_SIDEBAR = 'sidebar';

    // Optional: You can add a helper to check active status
    public function isActive(): bool
    {
        return $this->isActive == 1;
    }

    // Relationships (if any) can be defined here
    // e.g., parent menu relationship
    public function children() { 
        return $this->hasMany(Menu::class, 'parent_menu_id', 'menu_id')->orderBy('sort')->where('lang', app()->getLocale());
    } // children()
}
