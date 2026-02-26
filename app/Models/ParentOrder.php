<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentOrder extends Model
{
    protected $table = 'parent_order_table';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'session_id',
        'student_id',
        'parent_id',
        'cart_data',
        'payment_data',
        'total_price',
        'is_paid',
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
    ];

}
