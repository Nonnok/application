<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\work;
use App\Models\rest;
use App\Models\Date;



class CheckController extends Controller
{
    public function atte()
    {
        $users = Auth::user();
        $date = date('Y-m-d');

        $date = work::select('date')->join('users', 'users.id', 'user_id');
        
        $workdate = work::select('date')->get();
        if (!$workdate) {
            return redirect()->back()->with('message', '勤怠履歴がありません');
        }
        
        $rests = rest::select('work_id',DB::raw('SUM(rest_time) as sum_rest_time'))->groupBy('work_id');
        
        $allDate = work::select('date')
            ->distinct()
            ->simplePaginate(1, ["*"], 'datePage');
        
        foreach($allDate as $date) {
            $date->date;
        }
        
        $works = work::join('users', 'users.id', 'user_id')
            ->leftJoinSub($rests,'rests',function ($join){
                $join->on('works.id','=','rests.work_id');
            })
            ->where('date', $date->date)
            ->orderBy('works.updated_at', 'asc')
            ->paginate(5, ["*"], 'userPage');

        return view('attendance', compact('works', 'allDate'));
    }


    public function userpage()
    {
        $user = Auth::user();
        $date = date('m');
        $stampDate = work::select('date')->get();
        if(!$stampDate) {
            return redirect()->back()->with('message', '勤怠記録がありません');
        }

        $allDate = work::select('date')  
            ->distinct()
            ->simplePaginate(1, ["*"], 'datePage');

        foreach($allDate as $date) {
            $date->date;
        }

        $rests = rest::select('work_id', DB::raw('SUM(rest_time) as sum_rest_time'))->groupBy('work_id');

        $myworks = work::join('users', 'users.id', 'user_id')
            ->leftJoinSub($rests, 'rests', function ($join) {
                $join->on('works.id', '=', 'rests.work_id');
            })
            ->where('user_id', $user->id)
            ->orderBy('works.updated_at', 'asc')
            ->paginate(5);

        return view('userpage', compact('myworks', 'allDate'));
    }
}