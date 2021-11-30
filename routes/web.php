<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AtteController;
use App\Http\Controllers\CheckController;


// 打刻ページ
Route::get('/', [AtteController::class, 'index'])->name('index');

// タイムスタンプ
// 勤務打刻
Route::post('/timein', [AtteController::class, 'timein']);
Route::post('/timeout', [AtteController::class, 'timeout']);
// 休憩打刻
Route::post('/breakin', [AtteController::class, 'breakin']);
Route::post('/breakout', [AtteController::class, 'breakout']);

// 会員登録ページ
Route::get('/register', [UserController::class, 'create'])
  ->middleware('guest')
  ->name('register');
Route::post('/register', [UserController::class, 'store'])
  ->middleware('guest');

// ログインページ
Route::get('/login', [LoginController::class, 'login'])
  ->middleware('guest')
  ->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])
  ->middleware('guest');

// ログアウト
Route::get('/logout', [LoginController::class, 'logout'])
  ->middleware('auth')
  ->name('logout');

// 日付別勤怠ページ
Route::get('/attendance', [CheckController::class, 'atte'])->name('attendance');
Route::post('/attendance', [CheckController::class, 'atte'])->name('attendance');

// ユーザーページ
Route::get('/userpage', [CheckController::class, 'userpage'])->name('userpage');
Route::post('/userpage', [CheckController::class, 'userpage'])->name('userpage');