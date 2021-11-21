<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\work;
use App\Models\rest;



class CheckController extends Controller
{
    public function atte()
    {
        $users = Auth::user();
        
        $workdate = work::select('date')->get();
        if (!$workdate) {
            return redirect()->back()->with('message', '勤怠履歴がありません');
        }
        
        $rests=rest::select('work_id',DB::raw('SUM(rest_time) as sum_rest_time'))->groupBy('work_id');
        
        $works = work::join('users', 'users.id', 'user_id')
        ->get();
        
        $allDate = work::select('date')->simplePaginate(1, ["*"], 'datePage');
        
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
}