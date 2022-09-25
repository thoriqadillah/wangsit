<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExampleController;

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

Route::get('/example', [ExampleController::class, 'index']);
Route::get('/event', [EventController::class, 'index']);
// Route::post('/daftar-event', [EventController::class, 'index']);

Route::get('/daftar-event', [UserController::class, 'daftar']);
Route::get('/ParticipantList', [EventController::class, 'showParticipants']);
