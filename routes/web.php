<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\RecaptchaController;
use App\Http\Controllers\SocialMediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

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

//FRONT
Route::middleware('front.data.share')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('index');
    Route::get('/resume', [FrontController::class, 'resume'])->name('resume');
    Route::get('/portfolio', [FrontController::class, 'portfolio'])->name('portfolio');
    Route::get('/portfolio/{id}', [FrontController::class, 'portfolioDetail'])->name('portfolio.detail')->whereNumber('id');
    Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
    Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
});



Route::get('recaptcha/validate', [RecaptchaController::class], 'validateV3');



//BACKEND
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::prefix('/education')->group(function () {
        Route::get('/list', [EducationController::class, 'list'])->name('admin.education.list');
        Route::post('/change-status', [EducationController::class, 'changeStatus'])->name('admin.education.changeStatus');
        Route::post('/delete', [EducationController::class, 'delete'])->name('admin.education.delete');
        Route::get('/add', [EducationController::class, 'addShow'])->name('admin.education.add');
        Route::post('/add', [EducationController::class, 'add']);
    });

    Route::prefix('/experience')->group(function () {
        Route::get('/list', [ExperienceController::class, 'list'])->name('admin.experience.list');
        Route::get('/add', [ExperienceController::class, 'addShow'])->name('admin.experience.add');
        Route::post('/add', [ExperienceController::class, 'add']);
        Route::post('/change-status', [ExperienceController::class, 'changeStatus'])->name('admin.experience.changeStatus');
        Route::post('/change-active', [ExperienceController::class, 'changeActive'])->name('admin.experience.activeStatus');
        Route::post('/delete', [ExperienceController::class, 'delete'])->name('admin.experience.delete');
    });

    Route::get('personal-information', [PersonalInformationController::class, 'index'])->name('personalInformation.index');
    Route::post('personal-information', [PersonalInformationController::class, 'update']);

    Route::prefix('social-media')->group(function () {
        Route::get('/list', [SocialMediaController::class, 'list'])->name('admin.socialMedia.list');
        Route::get('/add', [SocialMediaController::class, 'addShow'])->name('admin.socialMedia.add');
        Route::post('/add', [SocialMediaController::class, 'add']);
        Route::post('/change-status', [SocialMediaController::class, 'changeStatus'])->name('admin.socialMedia.changeStatus');
        Route::post('/delete', [SocialMediaController::class, 'delete'])->name('admin.socialMedia.delete');
    });

    Route::resource('portfolio', PortfolioController::class);
    Route::post('portfolio/change-status', [PortfolioController::class, 'changeStatus'])->name('portfolio.changeStatus');
    Route::get('portfolio/images/{id}', [PortfolioController::class, 'showImages'])->name('portfolio.showImages')->whereNumber('id');
    Route::post('portfolio/images/{id}', [PortfolioController::class, 'newImage'])->name('portfolio.newImage')->whereNumber('id');
    Route::delete('portfolio/images/{id}', [PortfolioController::class, 'deleteImage'])->name('portfolio.deleteImage')->whereNumber('id');
    Route::put('portfolio/images/{id}', [PortfolioController::class, 'featureImage'])->name('portfolio.featureImage')->whereNumber('id');
    Route::post('portfolio/images/{id}/change-status', [PortfolioController::class, 'changeStatusImage'])->name('portfolio.changeStatusImage')->whereNumber('id');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
