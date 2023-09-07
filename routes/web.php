<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[FlightController::class,'flight'])->name('flight');
Route::post('/flight_search',[FlightController::class,'flight_search'])->name('flight_search');