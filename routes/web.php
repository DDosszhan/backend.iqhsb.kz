<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\GraduateAchievementController;
use App\Http\Controllers\Admin\ConsultationRequestController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\Admin\CalendarEventController;

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

Route::group(['prefix' => config('project.admin_prefix'), 'middleware' => ['web', 'adminMiddleware']], function () {
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/', [FaqController::class, 'index'])->name('admin.faqs.index');
        Route::get('/list', [FaqController::class, 'list'])->name('admin.faqs.list');
        Route::get('/create', [FaqController::class, 'create'])->name('admin.faqs.create');
        Route::post('/store', [FaqController::class, 'store'])->name('admin.faqs.store');
        Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('admin.faqs.edit');
        Route::post('/{id}/update', [FaqController::class, 'update'])->name('admin.faqs.update');
        Route::get('/{id}/delete', [FaqController::class, 'delete'])->name('admin.faqs.delete');
        Route::get('/{id}/up', [FaqController::class, 'positionUp'])->name('admin.faqs.up');
        Route::get('/{id}/down', [FaqController::class, 'positionDown'])->name('admin.faqs.down');
    });
    Route::group(['prefix' => 'universities'], function () {
        Route::get('/', [UniversityController::class, 'index'])->name('admin.universities.index');
        Route::get('/list', [UniversityController::class, 'list'])->name('admin.universities.list');
        Route::get('/create', [UniversityController::class, 'create'])->name('admin.universities.create');
        Route::post('/store', [UniversityController::class, 'store'])->name('admin.universities.store');
        Route::get('/{id}/edit', [UniversityController::class, 'edit'])->name('admin.universities.edit');
        Route::post('/{id}/update', [UniversityController::class, 'update'])->name('admin.universities.update');
        Route::get('/{id}/delete', [UniversityController::class, 'delete'])->name('admin.universities.delete');
    });
    Route::group(['prefix' => 'graduate-achievements'], function () {
        Route::get('/', [GraduateAchievementController::class, 'index'])->name('admin.graduate-achievements.index');
        Route::get('/list', [GraduateAchievementController::class, 'list'])->name('admin.graduate-achievements.list');
        Route::get('/create', [GraduateAchievementController::class, 'create'])->name('admin.graduate-achievements.create');
        Route::post('/store', [GraduateAchievementController::class, 'store'])->name('admin.graduate-achievements.store');
        Route::get('/{id}/edit', [GraduateAchievementController::class, 'edit'])->name('admin.graduate-achievements.edit');
        Route::post('/{id}/update', [GraduateAchievementController::class, 'update'])->name('admin.graduate-achievements.update');
        Route::get('/{id}/delete', [GraduateAchievementController::class, 'delete'])->name('admin.graduate-achievements.delete');
    });
    Route::group(['prefix' => 'consultation-requests'], function () {
        Route::get('/', [ConsultationRequestController::class, 'index'])->name('admin.consultation-requests.index');
        Route::get('/list', [ConsultationRequestController::class, 'list'])->name('admin.consultation-requests.list');
        Route::get('/create', [ConsultationRequestController::class, 'create'])->name('admin.consultation-requests.create');
        Route::post('/store', [ConsultationRequestController::class, 'store'])->name('admin.consultation-requests.store');
        Route::get('/{id}/edit', [ConsultationRequestController::class, 'edit'])->name('admin.consultation-requests.edit');
        Route::post('/{id}/update', [ConsultationRequestController::class, 'update'])->name('admin.consultation-requests.update');
        Route::get('/{id}/delete', [ConsultationRequestController::class, 'delete'])->name('admin.consultation-requests.delete');
    });
    Route::group(['prefix' => 'questionnaires'], function () {
        Route::get('/', [QuestionnaireController::class, 'index'])->name('admin.questionnaires.index');
        Route::get('/list', [QuestionnaireController::class, 'list'])->name('admin.questionnaires.list');
        Route::get('/create', [QuestionnaireController::class, 'create'])->name('admin.questionnaires.create');
        Route::post('/store', [QuestionnaireController::class, 'store'])->name('admin.questionnaires.store');
        Route::get('/{id}/edit', [QuestionnaireController::class, 'edit'])->name('admin.questionnaires.edit');
        Route::post('/{id}/update', [QuestionnaireController::class, 'update'])->name('admin.questionnaires.update');
        Route::get('/{id}/delete', [QuestionnaireController::class, 'delete'])->name('admin.questionnaires.delete');
    });
    Route::group(['prefix' => 'calendar-events'], function () {
        Route::get('/', [CalendarEventController::class, 'index'])->name('admin.calendar-events.index');
        Route::get('/list', [CalendarEventController::class, 'list'])->name('admin.calendar-events.list');
        Route::get('/create', [CalendarEventController::class, 'create'])->name('admin.calendar-events.create');
        Route::post('/store', [CalendarEventController::class, 'store'])->name('admin.calendar-events.store');
        Route::get('/{id}/edit', [CalendarEventController::class, 'edit'])->name('admin.calendar-events.edit');
        Route::post('/{id}/update', [CalendarEventController::class, 'update'])->name('admin.calendar-events.update');
        Route::get('/{id}/delete', [CalendarEventController::class, 'delete'])->name('admin.calendar-events.delete');
    });
});
