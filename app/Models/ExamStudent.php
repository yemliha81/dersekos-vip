<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudent extends Model
{
    // soft deletes
    use HasFactory;

    protected $table = 'exam_student_table';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'student_id',
        'answers'
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at'
    ];

}
