<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    // soft deletes
    use HasFactory, SoftDeletes;

    protected $table = 'campaign_table';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'campaign_title',
        'campaign_description',
        'campaign_start',
        'campaign_end',
        'campaign_image',
        'campaign_price',
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

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

}
