<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardEventController;
use App\Http\Controllers\DashboardTutorController;
use App\Http\Controllers\DatabaseTestController;
use App\Http\Middleware\ActiveModule;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsLoggedInAdmin;
use App\Http\Middleware\IsLoggedInTutor;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfTutor;
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

Route::get('/', [AppController::class, 'index'])->name('app.index');

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', [AppController::class, 'login'])->name('app.login');
    Route::post('/login', [AppController::class, 'loginUser'])->name('app.loginUser');

    Route::middleware(ActiveModule::class.':registration')->group(function () {
        Route::get('/register', [AppController::class, 'register'])->name('app.register');
        Route::post('/register', [AppController::class, 'registerUser'])->name('app.registerUser');
    });
});

Route::prefix('dashboard')->middleware(Authenticate::class)->group(function () {
    Route::middleware(RedirectIfTutor::class)->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::prefix('event/{event}')->group(function () {
            Route::get('/', [DashboardEventController::class, 'index'])->name('dashboard.event.index');
            Route::get('/register', [DashboardEventController::class, 'register'])->name('dashboard.event.register');
            Route::post('/register', [DashboardEventController::class, 'registerUser'])->name('dashboard.event.registerUser');
            Route::get('/unregister', [DashboardEventController::class, 'unregister'])->name('dashboard.event.unregister');
            Route::post('/unregister', [DashboardEventController::class, 'unregisterUser'])->name('dashboard.event.unregisterUser');
        });
    });

    Route::post('/login-tutor', [DashboardController::class, 'loginTutor'])->name('dashboard.loginTutor');
    Route::prefix('tutor')->middleware(IsLoggedInTutor::class)->group(function () {
        Route::get('/', [DashboardTutorController::class, 'index'])->name('dashboard.tutor.index');
        Route::get('/event/{event}', [DashboardTutorController::class, 'event'])->name('dashboard.tutor.event.index');
        Route::get('/slot/{slot}', [DashboardTutorController::class, 'slot'])->name('dashboard.tutor.slot.index');
        Route::get('/group/{group}', [DashboardTutorController::class, 'group'])->name('dashboard.tutor.group.index');
    });

    Route::prefix('admin')->middleware(IsLoggedInTutor::class, IsLoggedInAdmin::class)->group(function () {
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard.admin.index');

        Route::get('/register', [DashboardAdminController::class, 'register'])->name('dashboard.admin.register');
        Route::post('/register', [DashboardAdminController::class, 'registerUser'])->name('dashboard.admin.registerUser');
        Route::post('/assign', [DashboardAdminController::class, 'assignUser'])->name('dashboard.admin.assignUser');

        Route::get('/event/{event}', [DashboardAdminController::class, 'event'])->name('dashboard.admin.event.index');
        Route::get('/event/{event}/registrations', [DashboardAdminController::class, 'registrations'])->name('dashboard.admin.event.registrations');
        Route::get('/event/{event}/submit', [DashboardAdminController::class, 'eventSubmit'])->name('dashboard.admin.event.submit');
        Route::post('/event/{event}/submit', [DashboardAdminController::class, 'eventExecuteSubmit'])->name('dashboard.admin.event.executeSubmit');
    });

    Route::get('{slug?}', [DashboardController::class, 'cmsPage'])->where('slug', '.*');
});

// api routes with authentication
Route::prefix('api')->middleware(Authenticate::class)->group(function () {
    Route::middleware(IsLoggedInTutor::class)->group(function () {
        Route::get('/events/{event}/registrations-amount', [ApiController::class, 'eventRegistrationsAmount'])->name('api.event.registrationsAmount');
        Route::get('/events/registrations-amount', [ApiController::class, 'eventsRegistrationsAmount'])->name('api.events.registrationsAmount');

        Route::get('/events/{event}/registrations', [ApiController::class, 'eventRegistrationsShow'])->name('api.event.registrations.show');

        Route::get('/registrations/{registration}/toggle-is-present', [ApiController::class, 'registrationsToggleIsPresent'])->name('api.event.registrations.toggleIsPresent');

        Route::middleware(IsLoggedInAdmin::class)->group(function () {
            Route::get('/registrations/{registration}/toggle-fulfils-requirements', [ApiController::class, 'registrationsToggleFulfilsRequirements'])->name('api.event.registrations.toggleFulfilsRequirements');
            Route::delete('/registrations/{registration}', [ApiController::class, 'registrationsDestroy'])->name('api.event.registrations.destroy');

            Route::get('/events/{event}/user-amount', [ApiController::class, 'coursesUserAmountPerEvent'])->name('api.event.coursesUserAmountPerEvent');

            Route::get('/courses/user-amount', [ApiController::class, 'coursesUserAmount'])->name('api.courses.userAmount');
        });
    });

    Route::get('/registrations/{registration}', [ApiController::class, 'registrationsShow'])->name('api.registrations.show');
});

Route::get('{any?}', [AppController::class, 'notFound'])->where('any', '^((?!api).)*');
