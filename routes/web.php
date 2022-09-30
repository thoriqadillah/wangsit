<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExampleController;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;


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

Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware(['throttle:login']); //limit rate request -> search RouteServiceProvider

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('home', function () {
//     return view('home');
// });

// Route::get('event', function () {
//     return view('event');
// });

// Route::get('academy', function () {
//     return view('academy');
// });

Route::get('/example', [ExampleController::class, 'index']);
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::post('/add-event', [EventController::class, 'addEvent']);
// Route::get('/update-event/{id}', [EventController::class, 'updateEventPage']);
Route::put('/update-event/{id}', [EventController::class, 'updateEvent']);
Route::delete('/delete-event/{id}', [EventController::class, 'deleteEvent']);
// Route::post('/daftar-event', [EventController::class, 'index']);

Route::get('/daftar-event', [UserController::class, 'daftar']);
Route::get('/ParticipantList', [EventController::class, 'showParticipants']);
