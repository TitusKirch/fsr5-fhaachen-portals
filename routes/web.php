<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorGroupController;
use App\Http\Controllers\AdminGroupController;
use App\Http\Controllers\DatabaseTestController;
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

Route::get('/', [AppController::class, 'index']);
Route::post('/', [AppController::class, 'store']);
Route::get('/group/', [AppController::class, 'group'])->name('group');

Route::get('/tutor/', [TutorController::class, 'index']);
Route::get('/tutor/station', [TutorController::class, 'station']);

Route::get('/tutor/group/', [TutorGroupController::class, 'index']);
Route::get('/tutor/group/create/', [TutorGroupController::class, 'create']);
Route::get('/tutor/group/finish/', [TutorGroupController::class, 'finish']);

Route::get('/admin/create', [AdminGroupController::class, 'adminCreate']);
Route::get('/admin/detail', [AdminGroupController::class, 'detail']);
Route::get('/admin/newData', [AdminGroupController::class, 'newData']);
Route::get('/admin/overview', [AdminGroupController::class, 'overview']);

//Routes to test factories. REMOVE BEFORE DEPLOYMENT
Route::get('/testfactorystudent', function () {
    $student = \App\Models\Student::factory()->make();
    return $student;
});
Route::get('/testfactorytutor', function () {
    $tutor = \App\Models\Tutor::factory()->make();
    return $tutor;
});
Route::get('/testfactorygroup', function () {
    $group = \App\Models\Group::factory()->make();
    return $group;
});
Route::get('/testfactorystation', function () {
    $station = \App\Models\Station::factory()->make();
    return $station;
});
Route::get('/testfactorytimeslot', function () {
    $timeslot = \App\Models\Timeslot::factory()->make();
    return $timeslot;
});

//Routes to test database. REMOVE BEFORE DEPLOYMENT
Route::get('/cleartable/all', [DatabaseTestController::class, 'clearAllTables']);
Route::get('/cleartable/{tableName}', [DatabaseTestController::class, 'clearTable']);
Route::get('/randomfill/{tableName}/{amount}', [DatabaseTestController::class, 'randomFillTable']);
Route::get('/simulatedfill/{et}/{inf}/{mcd}/{wi}', [DatabaseTestController::class, 'simulatedFillStudents']);

Route::get('/randassigntimeslots/{timeslotsAmount}', [DatabaseTestController::class, 'randomAssignTimeslots']);
// Only works with exactly 3 timeslots and only on ET Students
Route::get('/simassigntimeslots/{amount1}/{amount2}/{amount3}', [DatabaseTestController::class, 'simulatedAssignTimeslots']);

Route::get('/students/{attr}/{val?}/{val2?}', [DatabaseTestController::class, 'getStudentsBy']);
Route::get('/tutors/{attr}/{val?}', [DatabaseTestController::class, 'getTutorsBy']);

Route::get('/resetassign', [AdminGroupController::class, 'resetGroupAssignment']);
Route::get('/assign/{groupSize}/groupphase', [AdminGroupController::class, 'randAssignmentGroupPhase']);
Route::get('/assign/{groupSize}/fhtour/{course}', [AdminGroupController::class, 'randAssignmentFhTour']);
