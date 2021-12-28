<?php

use App\Http\Controllers\Api\YouTube\PushNotificationsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('push-notifications/youtube', [PushNotificationsController::class, 'get'])->name('youtube.get');
Route::post('push-notifications/youtube', [PushNotificationsController::class, 'post'])->name('youtube.post');
