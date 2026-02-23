<?php 

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentParent extends Authenticatable
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $table = 'parent_table';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'tc_no',
        'email',
        'phone',
        'address',
        'city',
        'town',
        'zipcode'
    ];

    // If you want to automatically cast created_at as datetime
    protected $dates = [
        'created_at',
        'deleted_at',
    ];
}