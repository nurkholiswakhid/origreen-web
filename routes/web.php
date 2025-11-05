<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MapSettingController;
use App\Http\Controllers\Admin\FaqController;

// Static pages
Route::view('/tentang', 'pages.tentang')->name('tentang');
Route::view('/wahana', 'pages.wahana')->name('wahana');
Route::view('/berita', 'pages.berita')->name('berita');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ImageController;

// Public Routes
Route::get('/', [WelcomeController::class, 'index']);

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Image Upload Route
    Route::post('/upload-image', [ImageController::class, 'upload'])->name('admin.upload-image');

    // Banner Routes
    Route::get('/banner/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::put('/banner/update', [BannerController::class, 'update'])->name('admin.banner.update');

    // News Routes
    Route::resource('news', NewsController::class, ['as' => 'admin']);

    // About Routes
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about', [AboutController::class, 'update'])->name('admin.about.update');

    // Facility Routes
    Route::get('/facilities', [FacilityController::class, 'index'])->name('admin.facilities.index');
    Route::get('/facilities/create', [FacilityController::class, 'create'])->name('admin.facilities.create');
    Route::post('/facilities', [FacilityController::class, 'store'])->name('admin.facilities.store');
    Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('admin.facilities.edit');
    Route::put('/facilities/{facility}', [FacilityController::class, 'update'])->name('admin.facilities.update');
    Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy'])->name('admin.facilities.destroy');
    Route::put('/facilities/{facility}/toggle', [FacilityController::class, 'toggle'])->name('admin.facilities.toggle');
    Route::post('/facilities/reorder', [FacilityController::class, 'reorder'])->name('admin.facilities.reorder');

    // Testimonial Routes
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('admin.testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
    Route::put('/testimonials/{testimonial}/toggle', [TestimonialController::class, 'toggle'])->name('admin.testimonials.toggle');

    // Map Settings Routes
    Route::get('/map-settings/edit', [MapSettingController::class, 'edit'])->name('admin.map-settings.edit');
    Route::put('/map-settings', [MapSettingController::class, 'update'])->name('admin.map-settings.update');

    // FAQ Routes
    Route::get('/faqs', [FaqController::class, 'index'])->name('admin.faqs.index');
    Route::get('/faqs/create', [FaqController::class, 'create'])->name('admin.faqs.create');
    Route::post('/faqs', [FaqController::class, 'store'])->name('admin.faqs.store');
    Route::get('/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('admin.faqs.update');
    Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('admin.faqs.destroy');
    Route::put('/faqs/{faq}/toggle', [FaqController::class, 'toggle'])->name('admin.faqs.toggle');
    Route::post('/faqs/reorder', [FaqController::class, 'reorder'])->name('admin.faqs.reorder');
});
// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
