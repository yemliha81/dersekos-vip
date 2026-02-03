<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    // soft deletes
    use HasFactory, SoftDeletes;

    protected $table = 'exam_questions_table';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'question_image',
        'answer',
        'branch',
        'extra_data',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];

}
