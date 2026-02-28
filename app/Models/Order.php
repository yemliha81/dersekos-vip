<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'order_table';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'student_id',
        'description',
        'content_type',
        'content_id',
        'price',
        'start_date',
        'end_date',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        
    ];

}
