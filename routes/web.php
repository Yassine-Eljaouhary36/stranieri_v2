<?php

use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/', [MeetingController::class, 'index'])->name('index');
Route::get('/appointment-details', [MeetingController::class, 'showDetails'])->middleware('meeting_requirements')->name('show-Details');
Route::post('/appointment-details', [MeetingController::class, 'payMeeting'])->name('pay-meeting');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
