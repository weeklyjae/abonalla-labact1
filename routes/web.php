<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TravelCategoryController;
use App\Http\Controllers\Admin\TravelPhotoController;
use App\Http\Controllers\Admin\MediaCategoryController;
use App\Http\Controllers\Admin\MediaItemController;
use App\Http\Middleware\EnsureTokenIsValid;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/coding', [PortfolioController::class, 'coding'])->name('coding');
Route::get('/editing', [PortfolioController::class, 'editing'])->name('editing');
Route::get('/travel', [PortfolioController::class, 'travel'])->name('travel');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/error', function () {
    return view('error');
})->name('error');

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/home', [GalleryController::class, 'index'])->name('home');
        Route::get('/site', [PageController::class, 'site'])->name('site');
        Route::post('/site', function () { return back()->with('success', 'Saved.'); })->name('site.store');
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
        Route::get('/coding', [GalleryController::class, 'coding'])->name('coding');
        Route::get('/coding/create', function () { return view('admin.coding-create'); })->name('coding.create');
        Route::get('/coding/{id}/edit', function () { return view('admin.coding-edit'); })->name('coding.edit');
        // Placeholder endpoints so views can render without backend handlers
        Route::post('/coding', function () { return back(); })->name('coding.store');
        Route::delete('/coding/{filename}', function () { return back(); })->name('coding.destroy');

        Route::get('/media', [GalleryController::class, 'media'])->name('media');
        Route::get('/media/create', function () { return view('admin.media-create'); })->name('media.create');
        Route::get('/media/{id}/edit', function () { return view('admin.media-edit'); })->name('media.edit');
        // Placeholder media ingestion endpoints
        Route::post('/media/youtube', function () { return response()->json(['ok' => true]); })->name('media.youtube');
        Route::post('/media/instagram', function () { return response()->json(['ok' => true]); })->name('media.instagram');
        Route::get('/media-categories', [MediaCategoryController::class, 'index'])->name('media-categories.index');
        Route::get('/media-items', [MediaItemController::class, 'index'])->name('media-items.index');
        Route::get('/travel', [GalleryController::class, 'travel'])->name('travel');
        Route::get('/travel/create', function () { return view('admin.travel-create'); })->name('travel.create');
        Route::get('/travel/{id}/edit', function () { return view('admin.travel-edit'); })->name('travel.edit');
        Route::post('/travel', function () { return back(); })->name('travel.store');
        Route::delete('/travel/{category}', function () { return back(); })->name('travel.destroy');
        Route::get('/travel-categories', [TravelCategoryController::class, 'index'])->name('travel-categories');
        Route::get('/travel-photos', [TravelPhotoController::class, 'index'])->name('travel-photos');

        // Admin: posts (static views)
        Route::get('/posts', function () {
            return view('admin.posts.index');
        })->name('posts.index');
        Route::get('/posts/create', function () {
            return view('admin.posts.create');
        })->name('posts.create');
        Route::get('/posts/{id}/edit', function () {
            return view('admin.posts.edit');
        })->name('posts.edit');
    });

    // User routes 
    Route::middleware(['check.role:user'])->group(function () {
        // User posts list (static)
        Route::get('/posts', function () {
            return view('user.posts.index');
        })->name('user.posts.index');

        Route::get('/user/dashboard', function () {
        return view('dashboard');
        })->name('user.dashboard');

        // Static individual post view (user role)
        Route::get('/posts/{id}', function () {
            return view('user.posts.show');
        })->name('user.posts.show');

        // User: static form to add/submit a post
        Route::get('/posts/create', function () {
            return view('user.posts.create');
        })->name('user.posts.create');
    });
});

require __DIR__.'/auth.php';
