<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FallbackController;
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
        \App\Helpers\Socials::updateLatestYouTubeVideo();
        return redirect(config('nova.path'));
    })->name('social.youtube.latest-video');

    Route::get('update/instagram/latest', function () {
        \App\Helpers\Socials::updateLatestInstagramPost();
        return redirect(config('nova.path'));
    })->name('social.instagram.latest-post');

    Route::get('update/tiktok/latest', function () {
        \App\Helpers\Socials::updateLatestTikTok();
        return redirect(config('nova.path'));
    })->name('social.tiktok.latest-post');
});
Route::post('/link/{link}', [HomeController::class, 'count']);
Route::get('{slug?}', [FallbackController::class, 'slug'])->name('slug')->where('slug', '^((?!ignition|nova|admin|api).)*$');
