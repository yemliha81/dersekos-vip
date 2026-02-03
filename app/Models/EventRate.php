<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRate extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_rates';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'event_id',
        'teacher_id',
        'rating',
        'comment',
        'status',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at'
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
}

