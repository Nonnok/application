<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Date;
use App\Models\User;
use App\Models\work;
use App\Models\rest;



class CheckController extends Controller
{
    public function index()
    {
        $workTable = Date::get()->first();

        if(!$workTable) {
            return redirect('attendance')->with('message', '勤怠履歴がありません');
        }
        
        $users = work::join('users', 'users.id', 'user_id')
                    ->get();

        $allDate = Date::select('date')
                    ->simplePaginate(1, ["*"], 'datePage');

        foreach($allDate as $date) {
            $date->date;
        }

        $users = work::join('users', 'users.id', 'works.user_id')
                    ->where('date', $date->date)
                    ->paginate(5, ["*"], 'userPage');


        return view('attendance', compact('allDate', 'users'));
    }
}