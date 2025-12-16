<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::view('/', 'welcome')->name('home');
Route::get('/coding', [PortfolioController::class, 'coding'])->name('coding');
Route::get('/editing', [PortfolioController::class, 'editing'])->name('editing');
Route::get('/travel', [PortfolioController::class, 'travel'])->name('travel');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
Route::post('/upload-image', [ContactController::class, 'uploadImage'])->name('upload.image');
Route::view('/error', 'error')->name('error');

Route::middleware(['auth', 'check.role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/gallery-overview', [AdminDashboardController::class, 'index'])->name('gallery-overview');

        Route::controller(ContactMessageController::class)
            ->prefix('contact-messages')
            ->name('contact-messages.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::patch('/{contactMessage}', 'update')->name('update');
                Route::delete('/{contactMessage}', 'destroy')->name('destroy');
                Route::post('/{id}/restore', 'restore')->name('restore');
                Route::delete('/{id}/force', 'forceDelete')->name('force-delete');
            });

        Route::controller(PageController::class)->group(function () {
            Route::get('/site-settings', 'site')->name('site-settings');
            Route::post('/site-settings', 'storeSite')->name('site-settings.store');
        });

        // Placeholder modules
        Route::view('/posts', 'admin.posts.index')->name('posts.index');
        Route::view('/posts/create', 'admin.posts.create')->name('posts.create');
        Route::view('/posts/{id}/edit', 'admin.posts.edit')->name('posts.edit');

        Route::any('/coding-projects', fn () => abort(404))->name('coding-projects');
        Route::any('/media-library', fn () => abort(404))->name('media-library');
    });

Route::middleware(['auth', 'check.role:user'])->group(function () {
    Route::view('/user/dashboard', 'dashboard')->name('user.dashboard');

    Route::prefix('posts')->name('user.posts.')->group(function () {
        Route::view('/', 'user.posts.index')->name('index');
        Route::view('/create', 'user.posts.create')->name('create');
        Route::view('/{id}', 'user.posts.show')->name('show');
    });
});

require __DIR__ . '/auth.php';
