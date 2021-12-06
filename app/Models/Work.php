<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $table = 'works';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'punchIn',
        'punchOut',
        'date',
        'id',
        'work_time',
        'month'
    ];

    protected $dates = ['punchIn', 'punchOut', 'date'];
}
