<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lesson;

class Grade extends Model
{
    protected $table = 'grade';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'grade_id',
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
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'grade_id', 'grade_id');
    }

}
