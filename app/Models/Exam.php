<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ExamQuestion;

class Exam extends Model
{
    // soft deletes
    use HasFactory, SoftDeletes;

    protected $table = 'exam_table';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'subtitle',
        'answers',
        'sort',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'exam_id', 'id');
    }

}
