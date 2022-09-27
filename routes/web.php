<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExampleController;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
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

Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware(['throttle:login']); //limit rate request -> search RouteServiceProvider

Route::get('/', function () {
    return view('login');
});

Route::get('/example', [ExampleController::class, 'index']);
