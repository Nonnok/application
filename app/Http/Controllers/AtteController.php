<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\work;
use App\Models\rest;

class AtteController extends Controller
{
    public function index() {
        return view('stamp');
    }

    public function timein() {
        $user = Auth::user();
        $today = Carbon::today();
        $oldtimein = work::where('user_id', $user->id)->latest()->first();

        $oldDay = '';


        if($oldtimein) {
            $oldTimePunchIn = new Carbon($oldtimein->punchIn);
            $oldDay = $oldTimePunchIn->startOfDay();
        }

        if(($oldDay == $today) && (empty($oldtimein->punchOut))) {
            return redirect()->back()->with('message', '出勤打刻済みです');
        }

        if(($oldDay == $today)) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        }

        $time = work::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'punchIn' => Carbon::now(),
            'date' => Carbon::today(),
        ]);

        return redirect('/')->back()->with('message', '勤怠を開始します');
    }

    public function timeout() {
        $user = Auth::user();
        $timeOut = work::where('user_id', $user->id)->latest()->first();

        $now = new Carbon();
        $punchIn = new Carbon($timeOut->punchIn);
        $breakIn = new Carbon($timeOut->breakIn);
        $breakOut = new Carbon($timeOut->breakOut);

        $workTime = $punchIn->diffInMinutes($now);
        $breakTime = $breakIn->diffInMinutes($breakOut);
        $workingMinute = $workTime - $breakTime;

        $workingHour = ceil($workingMinute / 15) * 0.25;

        if($timeOut) {
            if(empty($timeOut->punchOut)) {
                if($timeOut->breakIn && $timeOut->breakOut) {
                    return redirect() -> back()->with('message', '休憩終了が打刻されていません');
                } else {
                    $timeOut->update([
                        'punchOut' => Carbon::now(),
                        'workTime' => $workingHour,
                    ]);
                    return redirect()->back()->with('message', 'お疲れ様でした');
                }
            } else {
                $today = new Carbon();
                $day = $today->day;
                $oldPunchOut = new Carbon();
                $oldPunchOutDay = $oldPunchOut->day;
                if ($day == $oldPunchOutDay) {
                    return redirect()->back()->with('message', '退勤打刻済みです');
                } else {
                    return redirect()->back()->with('message', '出勤打刻をしてください');
                }
            } 
        }else {
             return redirect()->back()->with('message', '出勤打刻がされていません');
        }
    }

    // 休憩開始
    public function breakin() {
        $user = Auth::user();
        $oldtimein = work::where('user_id', $user->id)->latest()->first();

        if (!$oldtimein) {
            return redirect()->back()->with('message', '出勤打刻されていません');
        }

        $restTimestamp = rest::where('work_id', $oldtimein->id)->latest()->first();

        if (($oldtimein->punchIn && !$oldtimein->punchOut) && !$restTimestamp) {
            $restTimestamp = rest::create([
                'work_id' => $oldtimein->id,
                'breakIn' => Carbon::now(),
            ]);

            return redirect()->back()->with('message', '休憩を開始します');
        } elseif (($oldtimein->punchIn && !$oldtimein->punchOut) && ($restTimestamp->breakIn && !$restTimestamp->breakOut)) {
            return redirect()->back()->with('message', '休憩中です');
        } elseif (($oldtimein->punchIn && !$oldtimein->punchOut) && $restTimestamp) {
            $restTimestamp = rest::create([
                'work_id' => $oldtimein->id,
                'breakIn' => Carbon::now(),
            ]);
            return redirect()->back()->with('message', '休憩を開始します');
        } elseif($oldtimein->punchOut) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        }
    }


    // 休憩終了
    public function breakout() {
        $user = Auth::user();
        $oldtimein = work::where('user_id', $user->id)->latest()->first();

        if (!$oldtimein) {
            return redirect()->back()->with('message', '出勤打刻されていません');
        }

        $restTimestamp = rest::where('work_id', $oldtimein->id)->latest()->first();

        if(!$restTimestamp) {

            return redirect()->back()->with('message', '休憩開始されていません');

        } elseif($restTimestamp->breakIn && !$restTimestamp->breakOut) {

            $breakIn = new Carbon($restTimestamp->breakIn);

            $restTimestamp->update([
                'breakOut' => Carbon::now(),
            ]);

            $restTimestamp = rest::where('work_id', $oldtimein->id)->latest()->first();
            $breakOut = new Carbon($restTimestamp->breakOut);
            $rest_time = $breakIn->diffInMinutes($breakOut);

            $restTimestamp -> update([
                'rest_time' => $rest_time,
            ]);

            return redirect()->back()->with('message', '休憩を終了します');

        } elseif (!$restTimestamp->breakIn && ($oldtimein->punchIn && !$oldtimein->punchOut)) {

            return redirect()->back()->with('message', '休憩開始されてません');

        } elseif ($oldtimein->punchOut) {

            return redirect()->back()->with('message', '退勤打刻済みです');
            
        } else {
            return redirect()->back();
        }
    }
}
