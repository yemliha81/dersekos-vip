<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'grade',
        'start',
        'end',
        'meet_url',
        'is_free',
        'price',
        'min_person',
        'max_person',
        'teacher_id',
        'attendees'
    ];

    protected $dates = [
        'created_at',
        'deleted_at',
    ];

    //teacher relation, an event belongs to a teacher, event_table has teacher_id as foreign key, teacher_table has id as primary key
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    

}


