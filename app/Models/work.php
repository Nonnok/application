<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work extends Model
{
    use HasFactory;

    protected $table = 'works';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'punchIn', 'punchOut', 'date', 'id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function date()
    {
        return $this->belongsTo(Date::class);
    }

    public function rests()
    {
        return $this->hasMany(rest::class);
    }
}
