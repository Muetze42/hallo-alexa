<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('/kontakt', ContactController::class, ['names' => 'contact'])->only(['index', 'store']);

if (config('app.env') === 'local' && request()->getClientIp() === request()->ip()) {
    Route::resource('/test', \App\Http\Controllers\DevelopmentController::class);
}
