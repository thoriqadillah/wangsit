<?php


use App\Http\Livewire\Event;
use App\Http\Livewire\Academy;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Academy;
use App\Http\Livewire\Event;
use App\Http\Livewire\EventFormMaker;
use App\Http\Livewire\EventRegistration;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/logout', 'logout');
    Route::post('/login', 'login')
        ->name('login')
        ->middleware(['throttle:login']); //limit rate request -> search RouteServiceProvider
});

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', function () {
    return view('addEvent');
});

Route::get('/event', Event::class);
Route::get('/academy', Academy::class);
// Route::get('/admin/event/{event_id}/tambah-form', EventForm::class);
Route::get('/event/{slug}/form', EventFormMaker::class);
Route::get('/event/{slug}/daftar', EventRegistration::class);
Route::get('/event/{slug}/daftar/berhasil', EventRegistration::class);

Route::get('/event/{slug}', [EventController::class, 'showDetail']);
//untuk debuging tidak masalah route grouping dikomen dulu
Route::middleware('auth')->group(function () {
    // Route::get('/event', [EventController::class, 'index']);
});

//untuk debuging tidak masalah route grouping dikomen dulu
Route::middleware('admin')->group(function () {
    Route::put('/admin/event/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/admin/event/{id}', [EventController::class, 'deleteEvent']);
    Route::post('/admin/event', [EventController::class, 'addEvent']);
    Route::get('/admin/event/{status}', [EventController::class, 'showFilterbyDate']);
});

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/event', Event::class);
    Route::get('/academy', Academy::class);
});


//untuk testing dan debuging doang. Otak atik aja controllernya buat testing atau apapun, tapi jangan dimasukkin ke commit
Route::get('/debug', [ExampleController::class, 'debug']);
Route::get('/example', [ExampleController::class, 'index']);


Route::get('/academy', [AcademyController::class, 'showAcademy']);
Route::post('/admin/academy', [AcademyController::class, 'addAcademy']);
Route::delete('/admin/academy/{id}', [AcademyController::class, 'deleteAcademy']);
Route::put('/admin/academy/{id}', [AcademyController::class, 'updateAcademy']);
