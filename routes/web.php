<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\PageMeta;
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

Route::middleware([PageMeta::class, HandleInertiaRequests::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('/kontakt', ContactController::class, ['names' => 'contact'])->only(['index', 'store']);
});
Route::middleware('auth')->group(function () {
    Route::get('update/youtube/latest', function () {
        \App\Helpers\Social::updateLatestYouTubeVideo();
        return redirect(config('nova.path'));
    })->name('social.youtube.latest-video');

    Route::get('update/instagram/latest', function () {
        \App\Helpers\Social::updateLatestInstagramPost();
        return redirect(config('nova.path'));
    })->name('social.instagram.latest-post');
});
Route::post('/link/{link}', [HomeController::class, 'count']);
