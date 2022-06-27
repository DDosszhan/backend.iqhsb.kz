<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocalizationController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\GraduateAchievementController;
use App\Http\Controllers\Api\QuestionnaireController;
use App\Http\Controllers\Api\ConsultationRequestController;
use App\Http\Controllers\Api\CalendarEventController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\PartnerController;

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

Route::get('/news', [NewsController::class, 'index'])->name('api.news.index');
Route::get('/faqs', [FaqController::class, 'index'])->name('api.faqs.index');
Route::get('/graduate-achievements', [GraduateAchievementController::class, 'index'])->name('api.graduate-achievements.index');
Route::post('/questionnaires', [QuestionnaireController::class, 'store'])->name('api.questionnaires.store');
Route::post('/consultation-requests', [ConsultationRequestController::class, 'store'])->name('api.consultation-requests.store');
Route::get('/calendar-events', [CalendarEventController::class, 'index'])->name('api.calendar-events.index');
Route::get('/teachers', [TeacherController::class, 'index'])->name('api.teachers.index');
Route::get('/partners', [PartnerController::class, 'index'])->name('api.partners.index');

Route::group(['prefix' => 'localization'], function () {
    Route::get('/i18n/{locale}', [LocalizationController::class, 'i18n']);
    Route::get('/i18n_additional_data', [LocalizationController::class, 'i18nAdditionalData']);
});
