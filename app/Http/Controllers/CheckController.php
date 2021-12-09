<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;

class CheckController extends Controller
{
    public function atte()
    {
        $users = Auth::user();
        $date = date('Y-m-d');

        $date = Work::select('date')->join('users', 'users.id', 'user_id');
        
        $workdate = Work::select('date')->get();
        if (!$workdate) {
            return redirect()->back()->with('message', '勤怠履歴がありません');
        }
        
        $rests = Rest::select('work_id',DB::raw('SUM(rest_time) as sum_rest_time'))->groupBy('work_id');
        
        $allDate = Work::select('date')
            ->distinct()
            ->simplePaginate(1, ["*"], 'datePage');
        
        foreach($allDate as $date) {
            $date->date;
        }
        
        $works = Work::join('users', 'users.id', 'user_id')
            ->leftJoinSub($rests,'rests',function ($join){
                $join->on('works.id','=','rests.work_id');
            })
            ->where('date', $date->date)
            ->orderBy('works.updated_at', 'asc')
            ->paginate(5, ["*"], 'userPage');

        return view('attendance', compact('works', 'allDate'));
    }


    public function userpage(Request $request)
    {
        $user = Auth::user();
        $stampDate = Work::select('date')->get();
        if(!$stampDate) {
            return redirect()->back()->with('message', '勤怠記録がありません');
        }

        $allDate = Work::select('date')
            ->distinct()
            ->simplePaginate(30, ["*"], 'datePage');
        
        foreach($allDate as $Date) {
            $Date -> date;
        }

        $rests = Rest::select('work_id', DB::raw('SUM(rest_time) as sum_rest_time'))->groupBy('work_id');

        $myworks = Work::join('users', 'users.id', 'user_id')
            ->leftJoinSub($rests, 'rests', function ($join) {
                $join->on('works.id', '=', 'rests.work_id');
            })
            ->where('user_id', $user->id)
            ->whereMonth('date', $Date->date)
            ->distinct()
            ->orderBy('works.updated_at', 'asc')
            ->paginate(5);
        return view('userpage', compact('myworks', 'allDate'));
    }

    public function userlist() {
        $user = Auth::user();
        $rests = Rest::select('work_id', DB::raw('SUM(rest_time) as sum_rest_time'));

        $users = Auth::user()
            ->paginate(5, ["*"], 'userList');
        return view('userlist', compact('users'));
    }
}