<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lesson;

class Lesson extends Model
{
    protected $table = 'lesson';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'grade_id',
        'lesson_id',
        'lang',
        'name',
        'description',
        'seo_url',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'sort',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];
    public function contents()
    {
        return $this->hasMany(Content::class, 'lesson_id', 'lesson_id');
    }

}
