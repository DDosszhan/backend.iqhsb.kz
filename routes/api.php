<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\GraduateAchievementController;
use App\Http\Controllers\Api\QuestionnaireController;
use App\Http\Controllers\Api\ConsultationRequestController;

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
