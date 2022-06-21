<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UniversityController;

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
});
