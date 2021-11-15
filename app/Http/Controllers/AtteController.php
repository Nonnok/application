<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\work;
use App\Models\rest;
use App\Models\Date;

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

    // 退勤打刻
    public function timeout() {
        $user = Auth::user();
        $workTimestamp = work::where('user_id', $user->id)->latest()->first();

        if (!$workTimestamp) {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        }

        $dateStamp = Date::latest()->first();
        $workTimestamp = work::where('user_id', $user->id)->latest()->first();

        $latestDateStamp = work::where('user_id', $user->id)->latest()->first();

        if ($latestDateStamp) {

            $punchIn = new Carbon($workTimestamp->punchIn);

            if ($workTimestamp->punchOut) {

                return redirect()->back()->with('message', '退勤打刻済みです');

            } elseif(!$workTimestamp->punchOut) {

                $restTimestamp = rest::where('work_id', $latestDateStamp->id)->latest()->first();

                if (!$restTimestamp) {

                    $timeOut->update([
                        'punchOut' => Carbon::now(),
                    ]);

                    $workTimestamp = work::where('user_id', $user->id)->latest()->first();
                    $punchOut = new carbon ($workTimestamp->punchOut);
                    $work_time = $punchIn->diffInMinutes($punchOut);
                    $workingHour = round(($work_time / 10) * 0.166, 3);

                    $workTimestamp->update([
                        'work_time' => $workingHour
                    ]);

                    return redirect()->back()->with('message', '退勤打刻が完了しました');

                } elseif (!$restTimestamp->breakOut) {

                    $restTimestamp = rest::where('work_id', $latestDateStamp)->latest()->first();

                    $restTimestamp -> update([
                        'breakOut' => Carbon::now(),
                    ]);

                    $breakIn = new Carbon($restTimestamp->breakIn);
                    $breakOut = new Carbon($restTimestamp->breakOut);
                    $rest_time = $breakIn->diffInMinutes($breakOut);
                    // TODO https://carbon.nesbot.com/docs/#api-difference ここを見て戻り値がNullになるケースを考える
                    
                    $restTimestamp->update([
                        'rest_time' => $rest_time
                    ]);
                    $rest_time_total = rest::where('work_id', $workTimestamp->id)->sum('rest_time');
                    $workTimestamp->update([
                        'total_rest_time' => $rest_time_total,
                    ]);

                    $workTimestamp->update([
                        'punchOut' => Carbon::now(),
                    ]);

                    $workTimestamp = work::where('user_id', $user->id)->latest()->first();

                    $punchOut = new carbon($workTimestamp->punchOut);
                    $work_time = $start_work->diffInMinutes($punchOut);
                    $workingHour = round(($work_time / 10) * 0.166, 3);

                    $workTimestamp->update([
                        'work_time' => $workingHour
                    ]);

                    return redirect()->back()->with('message', '退勤打刻が完了しました');
                } elseif ($restTimestamp) {
                    if ($restTimestamp->breakOut) {

                        $rest_time_total = Rest::where('work_id', $workTimestamp->id)->sum('rest_time');
                        $timeOut->update([
                            'rest_time' => $rest_time_total
                        ]);

                        $timeOut->update([
                            'punchOut' => Carbon::now()
                        ]);

                        $workTimestamp = work::where('user_id', $user->id)->latest()->first();
                        $punchOut = new carbon($workTimestamp->punchOut);
                        $work_time = $punchIn->diffInMinutes($punchOut);

                        $workTimestamp->update([
                            'work_time' => $workingHour
                        ]);

                        return redirect()->back()->with('message', '退勤打刻が完了しました');
                    }
                }
            }
        } elseif (!$latestDateStamp) {
            $latestDate = $dateStamp->date;
            $todayTimestamp = Carbon:: now();
            $timeout = work::where('user_id', $user->id)->latest()->first();

            if ($timeout->punchIn && !$timeout->punchOut && ($latestDate !== $todayTimestamp)) {
                Date::create([
                    'date' => Carbon::today(),
                ]);

                $workDate = Date::latest()->first();

                work::create ([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'punchIn' => Carbon::now(),
                ]);

                $timeout = work::where('user_id', $user->id)->latest()->first();

                return redirect()->back()->with('message', '日を跨いだため翌日の出勤打刻に移行します');
            } else {
                return redirect()->back()->with('message', ('出勤打刻がされていません'));
            }
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
