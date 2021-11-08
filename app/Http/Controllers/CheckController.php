<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Date;
use App\Models\work;

use function GuzzleHttp\Promise\all;

class CheckController extends Controller
{
    public function index()
    {
        $workTable = Date::get()->first();

        if(!$workTable) {
            return redirect()->back()->with('message', '勤怠履歴がありません');
        }

        // $users = work::join('works.date')
        // ->join('users', 'users.id', 'user_id')
        // ->get();

        $allDate = Date::select('date')->simplePaginate(1, ["*"], 'datePage');

        foreach ($allDate as $date) {
            $date->date;
        }

        $users = Work::join('users', 'user.id', 'works.user_id')
        ->where('attendance_date', $date->date)
        ->paginate(5, ["*"], 'userPage');

        return view('check', compact('allDate', 'users'));
    }
}
