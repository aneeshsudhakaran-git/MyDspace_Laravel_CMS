<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\SitePageController;


Route::get('/home', [SitePageController::class, 'index'])->name('home');
Route::get('/', [SitePageController::class, 'index']);

Route::get('/page/{page_id}', [SitePageController::class, 'showpage'])->name('page.showpage');
Route::post('/contact/save', [SitePageController::class, 'saveContact'])->name('contact.save');



/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/


// Admin routes start here
Route::get('/admin', function () {
    return view('admin/auth/login');
});

Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    // Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
