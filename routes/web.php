<?php

use App\Http\Controllers\PianoController;
use App\Http\Controllers\EnqueteController;
use App\Http\Controllers\ZenhanController;
use App\Http\Controllers\KouhanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
//サイト一時閉鎖時はこの部分のコメントアウトを解除し、下の部分を全てコメントアウト
Route::get('/', [PianoController::class, 'close']);
*/

//トップページ～回答練習ページまで(EnqueteController)
Route::get('/', [EnqueteController::class, 'top']);

Route::get('start', [EnqueteController::class, 'start']);

Route::match(['get', 'post'], 'confirm', [EnqueteController::class, 'confirm']);

Route::match(['get', 'post'], 'instruct', [EnqueteController::class, 'instruct']);

Route::match(['get', 'post'], 'prac01', [EnqueteController::class, 'prac01']);
Route::match(['get', 'post'], 'prac02', [EnqueteController::class, 'prac02']);
Route::match(['get', 'post'], 'prac03', [EnqueteController::class, 'prac03']);

Route::match(['get', 'post'], 'standby', [EnqueteController::class, 'standby']);

//回答前半～中間ページまで(ZenhanController)
Route::match(['get', 'post'], 'ques01', [ZenhanController::class, 'ques01']);

Route::match(['get', 'post'], 'half', [ZenhanController::class, 'half']);

//回答後半～終了ページまで(KouhanController)
Route::match(['get', 'post'], 'ques02', [KouhanController::class, 'ques02']);

Route::match(['get', 'post'], 'finish', [KouhanController::class, 'finish']);

//テスト用ページ(PianoController)
//Route::get('dbtest01', [PianoController::class, 'dbtest01']);
//Route::get('dbtest02', [PianoController::class, 'dbtest02']);
//Route::get('dbtest03', [PianoController::class, 'dbtest03']);

//Route::match(['get', 'post'], 'mail_test', [PianoController::class, 'mail_test']);
//Route::match(['get', 'post'], 'mail_sent', [PianoController::class, 'mail_sent']);
//Route::match(['get', 'post'], 'auto_mail', [PianoController::class, 'auto_mail']);

//Route::match(['get', 'post'], 'send_db', [KouhanController::class, 'send_db']);
