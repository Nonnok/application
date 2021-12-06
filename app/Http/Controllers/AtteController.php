<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;

class AtteController extends Controller
{
    public function index() {
        return view('stamp');
    }

    public function timein() 
    {
        $user = Auth::user();

        $oldTimestamp = work::where('user_id', $user->id)->latest()->first();
        if($oldTimestamp) {
            $oldpunchIn = new carbon($oldTimestamp->date);
            $oldpunchInDay = $oldpunchIn->startOfDay();
        } else {
            work::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'punchIn' => Carbon::now(),
                'date' => Carbon::now()->toDateString(),
            ]);

            return redirect()->back()->with('message', '勤怠開始します');
        }

        $newTimestamp = Carbon::today();
        if (($oldpunchInDay == $newTimestamp) && (empty($oldTimestamp->punchOut))) {
            return redirect()->back()->with('message', '出勤打刻済みです');
        }
        if ($oldTimestamp) {
            $oldpunchOut = new carbon ($oldTimestamp->date);
            $oldDay = $oldpunchOut->startOfDay();
        }

        if (($oldDay == $newTimestamp)) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        }

        work::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'punchIn' => Carbon::now(),
            'date' => Carbon::now()->toDateString(),
        ]);

        return redirect()->back()->with('message', '勤怠開始します');
    }

    // 退勤打刻
    public function timeout() 
    {

        $user = Auth::user();
        $timestamp = work::where('user_id', $user->id)->latest()->first();

        if (!$timestamp) {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        }

        if (!$timestamp->punchOut) {
            $restStamp = rest::where('work_id', $timestamp->id)->latest()->first();
            if (!empty($restStamp->breakIn) && empty($restStamp->breakOut)) {
                return redirect()->back()->with('message', '休憩中です');
            }
            $timestamp->update([
                'user_name' => $user->name,
                'user_id' => $user->id,
                'punchOut' => Carbon::now(),
            ]);
            return redirect()->back()->with('message', '退勤打刻が完了しました');
        }
        if ($timestamp->punchOut) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        } else {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        }
        $today = new carbon();
        $day = $today->day;
        $oldpunchOut = new carbon($timestamp->date);
        $oldpunchOutDay = $oldpunchOut->day;
        if($day == $oldpunchOut) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        } else {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        }
    }


    // 休憩開始
    public function breakin() {
        $user = Auth::user();
        $timestamp = work::where('user_id', $user->id)->latest()->first();
        if (!$timestamp) {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        } else {
            $today = new carbon();
            $day = $today->day;
            $oldpunchOut = new carbon ($timestamp->date);
            $oldpunchOutDay = $oldpunchOut->day;
        }
        if ($day !== $oldpunchOutDay) {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        }

        $restStamp = rest::where('work_id', $timestamp->id)->latest()->first();
        if($timestamp->punchOut) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        }

        if ($timestamp->punchIn && !$timestamp->punchOut && !$restStamp) {
            rest::create ([
                'work_id' => $timestamp->id,
                'breakIn' => Carbon::now(),
            ]);
            return redirect()->back()->with('message', '休憩を開始します');
        } elseif ($restStamp->breakIn && !$restStamp->breakOut) {
            return redirect()->back()->with('message', '休憩中です');
        } else {
            rest::create([
                'work_id' => $timestamp->id,
                'breakIn' => Carbon::now(),
            ]);
            return redirect()->back()->with('message', '休憩を開始します');
        }
    }


    // 休憩終了
    public function breakout() 
    {
        $user = Auth::user();
        $timestamp = work::where('user_id', $user->id)->latest()->first();
        if ($timestamp) {
            $restStamp = rest::where('work_id', $timestamp->id)->latest()->first();
            $today = new Carbon();
            $day = $today->day;
            $oldpunchOut = new carbon ($timestamp->date);
            $oldpunchOutDay = $oldpunchOut->day;
        }

        if (!$timestamp) {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        } elseif (!$restStamp) {
            if ($day == $oldpunchOutDay && empty($restStamp->breakIn)) {
                return redirect()->back()->with('message', '休憩が開始されていません');
            } else {
                return redirect()->back()->with('message', '出勤打刻がされていません');
            }
        }

        if ($timestamp->punchIn && $restStamp->breakIn && !$restStamp->breakOut) {
            $restStamp->update ([
                'breakOut' => Carbon::now(),
            ]);

            $restStamp = rest::where('work_id', $timestamp->id)->latest()->first();
            $breakIn = new carbon ($restStamp->breakIn);
            $breakOut = new carbon ($restStamp->breakOut);
            $restTime = $breakIn->diffInSeconds($breakOut);
            $restStamp->update ([
                'rest_time' => $restTime,
            ]);

            return redirect()->back()->with('message', '休憩を終了しました');
        } elseif ($restStamp->breakIn && $restStamp->breakOut && !$timestamp->punchOut) {
            return redirect()->back()->with('message', '休憩が開始されていません');
        } else {
            return redirect()->back()->with('message', '退勤打刻済みです');
        }
    }
}
