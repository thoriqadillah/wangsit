<?php


use App\Http\Livewire\Event;
use App\Http\Livewire\Academy;
use App\Http\Livewire\EventForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventFormResponseController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\SuccessfulRegistrationController;
use App\Http\Livewire\AdminEvent;
use App\Http\Livewire\EventRegistration;
use App\Http\Livewire\Root;

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
    Route::post('/login', 'login')->name('login')->middleware(['throttle:30,1']); //limit rate request 30/menit
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/event', Event::class);
    Route::get('/academy', Academy::class);
    Route::get('/event/{slug}/daftar', EventRegistration::class);
    Route::get('/event/{slug}/daftar/berhasil', [SuccessfulRegistrationController::class, 'index']);
    Route::get('/event/{slug}/daftar/pengumuman', [AnnouncementController::class, 'index']);
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/event', AdminEvent::class);
    Route::get('/admin/academy', [AcademyController::class, 'adminAcademy']);
    Route::get('/admin/root', Root::class);
    Route::get('/admin/event/{slug}/form', EventForm::class);
    Route::get('/admin/event/tambah', [EventController::class, 'addEventPage']);
    Route::get('/admin/event/{slug}/form/response', [EventFormResponseController::class, 'getResponse']);
    Route::get('/admin/event/{slug}', [EventController::class, 'detailEvent']);
    Route::put('/admin/event/{id}', [EventController::class, 'updateEvent']);
    Route::put('/admin/academy/{id}', [AcademyController::class, 'updateAcademy']);
    Route::post('/admin/event/tambah', [EventController::class, 'addEvent']);
    Route::get('/admin/academy', [AcademyController::class, 'showAcademy']);
    Route::get('/admin/academy/tambah', [AcademyController::class, 'addAcademyPage']);
    Route::get('/admin/academy/{slug}', [AcademyController::class, 'detailAcademy']);
    Route::post('/admin/academy/tambah', [AcademyController::class, 'addAcademy']);
    Route::delete('/admin/academy/{id}/delete', [AcademyController::class, 'deleteAcademy']);
});

// Untuk testing dan debuging doang, jangan dimasukkin ke commit
Route::get('/example', [ExampleController::class, 'index']);
Route::get('/debug', function () {
    // Debug here
});
