<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\GraduateAchievementController;
use App\Http\Controllers\Admin\ConsultationRequestController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\Admin\CalendarEventController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SocialNetworkController;

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
    Route::redirect('/', config('project.admin_prefix') . '/news');

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
        Route::get('/export', [ConsultationRequestController::class, 'export'])->name('admin.consultation-requests.export');
    });
    Route::group(['prefix' => 'questionnaires'], function () {
        Route::get('/', [QuestionnaireController::class, 'index'])->name('admin.questionnaires.index');
        Route::get('/list', [QuestionnaireController::class, 'list'])->name('admin.questionnaires.list');
        Route::get('/create', [QuestionnaireController::class, 'create'])->name('admin.questionnaires.create');
        Route::post('/store', [QuestionnaireController::class, 'store'])->name('admin.questionnaires.store');
        Route::get('/{id}/edit', [QuestionnaireController::class, 'edit'])->name('admin.questionnaires.edit');
        Route::post('/{id}/update', [QuestionnaireController::class, 'update'])->name('admin.questionnaires.update');
        Route::get('/{id}/delete', [QuestionnaireController::class, 'delete'])->name('admin.questionnaires.delete');
        Route::get('/export', [QuestionnaireController::class, 'export'])->name('admin.questionnaires.export');
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
    Route::group(['prefix' => 'teachers'], function () {
        Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
        Route::get('/list', [TeacherController::class, 'list'])->name('admin.teachers.list');
        Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
        Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
        Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
        Route::post('/{id}/update', [TeacherController::class, 'update'])->name('admin.teachers.update');
        Route::get('/{id}/delete', [TeacherController::class, 'delete'])->name('admin.teachers.delete');
    });
    Route::group(['prefix' => 'partners'], function () {
        Route::get('/', [PartnerController::class, 'index'])->name('admin.partners.index');
        Route::get('/list', [PartnerController::class, 'list'])->name('admin.partners.list');
        Route::get('/create', [PartnerController::class, 'create'])->name('admin.partners.create');
        Route::post('/store', [PartnerController::class, 'store'])->name('admin.partners.store');
        Route::get('/{id}/edit', [PartnerController::class, 'edit'])->name('admin.partners.edit');
        Route::post('/{id}/update', [PartnerController::class, 'update'])->name('admin.partners.update');
        Route::get('/{id}/delete', [PartnerController::class, 'delete'])->name('admin.partners.delete');
    });
    Route::group(['prefix' => 'banners', 'controller' => BannerController::class], function () {
        Route::get('/', 'index')->name('admin.banners.index');
        Route::get('/list', 'list')->name('admin.banners.list');
        Route::get('/create', 'create')->name('admin.banners.create');
        Route::post('/store', 'store')->name('admin.banners.store');
        Route::get('/{id}/edit', 'edit')->name('admin.banners.edit');
        Route::post('/{id}/update', 'update')->name('admin.banners.update');
        Route::get('/{id}/delete', 'delete')->name('admin.banners.delete');
    });
    Route::group(['prefix' => 'social-networks', 'controller' => SocialNetworkController::class], function () {
        Route::get('/', 'index')->name('admin.social-networks.index');
        Route::get('/list', 'list')->name('admin.social-networks.list');
        Route::get('/create', 'create')->name('admin.social-networks.create');
        Route::post('/store', 'store')->name('admin.social-networks.store');
        Route::get('/{id}/edit', 'edit')->name('admin.social-networks.edit');
        Route::post('/{id}/update', 'update')->name('admin.social-networks.update');
        Route::get('/{id}/delete', 'delete')->name('admin.social-networks.delete');
    });
    Route::group(['prefix' => 'pages', 'controller' => \App\Http\Controllers\Admin\PageController::class], function () {
        Route::get('/', 'index')->name('admin.pages.index');
        Route::get('/list', 'list')->name('admin.pages.list');
        Route::get('/create', 'create')->name('admin.pages.create');
        Route::post('/store', 'store')->name('admin.pages.store');
        Route::get('/{page}', 'show')->name('admin.pages.show');
        Route::get('/{id}/edit', 'edit')->name('admin.pages.edit');
        Route::post('/{id}/update', 'update')->name('admin.pages.update');
        Route::get('/{id}/delete', 'delete')->name('admin.pages.delete');
    });
    Route::group(['prefix' => 'example-files', 'controller' => \App\Http\Controllers\Admin\ExampleFileController::class], function () {
        Route::get('/', 'index')->name('admin.example_files.index');
        Route::get('/list', 'list')->name('admin.example_files.list');
        Route::get('/create', 'create')->name('admin.example_files.create');
        Route::post('/store', 'store')->name('admin.example_files.store');
        Route::get('/{id}/edit', 'edit')->name('admin.example_files.edit');
        Route::post('/{id}/update', 'update')->name('admin.example_files.update');
        Route::get('/{id}/delete', 'delete')->name('admin.example_files.delete');
    });
});
