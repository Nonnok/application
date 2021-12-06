<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $table = 'rests';
    protected $fillable = [
        'work_id',
        'breakIn',
        'breakOut',
        'id',
        'rest_time',
    ];
    protected $dates = ['breakIn', 'breakOut'];
}
