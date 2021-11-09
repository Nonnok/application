<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rest extends Model
{
    use HasFactory;

    protected $table = 'rests';

    protected $fillable = ['work_id', 'breakIn', 'breakOut', 'id'];

    public function work() {
        return $this->belongsTo(work::class);
    }
}
