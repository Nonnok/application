<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work extends Model
{
    use HasFactory;

    protected $table = 'works';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'punchIn', 'punchOut', 'date', 'id', 'worktime'];

    protected $dates = ['punchIn', 'punchOut', 'date'];

    public function worktime() {

        $user = Auth::user();
        $timeOut = work::where('user_id', $user->id)->latest()->first();
        $punchIn = new Carbon($timeOut->punchIn);
        $punchOut = new Carbon($timeOut->punchOut);
        $breakIn = new Carbon($timeOut->breakIn);
        $breakOut = new Carbon($timeOut->breakOut);

        $workTime = $punchIn->diffInMinutes($now);
        $breakTime = $breakIn->diffInMinutes($breakOut);
        $workingMinute = $workTime - $breakTime;

        $workingHour = ceil($workingMinute / 15) * 0.25;
    }

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
