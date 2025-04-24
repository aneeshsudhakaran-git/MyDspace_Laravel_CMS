<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController as AdminConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController as AdminEmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController as AdminEmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController as AdminNewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController as AdminPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController as AdminPasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController as AdminRegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController as AdminVerifyEmailController;


use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SiteConfigurationController;

use App\Http\Controllers\Admin\MediaManagerController;
use App\Http\Controllers\Admin\SiteEnquiryController;


use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
 
    // Admin routes start here
    Route::get('admin/register', [AdminRegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('admin/register', [AdminRegisteredUserController::class, 'store']);
    Route::get('admin/login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('admin/login', [AdminAuthenticatedSessionController::class, 'store']);
    Route::get('admin/forgot-password', [AdminPasswordResetLinkController::class, 'create'])->name('admin.password.request');
    Route::post('admin/forgot-password', [AdminPasswordResetLinkController::class, 'store'])->name('admin.password.email');
    Route::get('admin/reset-password/{token}', [AdminNewPasswordController::class, 'create'])->name('admin.password.reset');
    Route::post('admin/reset-password', [AdminNewPasswordController::class, 'store'])->name('admin.password.store');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Admin routes start here
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/verify-email', AdminEmailVerificationPromptController::class)->name('admin.verification.notice');
    Route::get('admin/verify-email/{id}/{hash}', AdminVerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('admin.verification.verify');
    Route::post('admin/email/verification-notification', [AdminEmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('admin.verification.send');
    Route::get('admin/confirm-password', [AdminConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
    Route::post('admin/confirm-password', [AdminConfirmablePasswordController::class, 'store']);
    Route::put('admin/password', [AdminPasswordController::class, 'update'])->name('admin.password.update');
    Route::post('admin/logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
    
    // menu
    Route::get('admin/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::get('admin/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::post('admin/menu/create', [MenuController::class, 'store']);
    Route::get('admin/menu/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::post('admin/menu/edit/{id}', [MenuController::class, 'update']);
    Route::get('admin/menu/delete/{id}', [MenuController::class, 'destroy'])->name('admin.menu.delete');
    Route::post('admin/menu/updateorder', [MenuController::class, 'updateOrder'])->name('admin.menu.updateorder');


    // category
    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/create', [CategoryController::class, 'store']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');
    Route::post('admin/category/updateorder', [CategoryController::class, 'updateOrder'])->name('admin.category.updateorder');


    // content
    Route::get('admin/content', [ContentController::class, 'index'])->name('admin.content');
    Route::get('admin/content/create', [ContentController::class, 'create'])->name('admin.content.create');
    Route::post('admin/content/create', [ContentController::class, 'store'])->name('admin.content.store');
    Route::get('admin/content/edit/{id}', [ContentController::class, 'edit'])->name('admin.content.edit');
    Route::post('admin/content/edit/{id}', [ContentController::class, 'update'])->name('admin.content.update');
    Route::get('admin/content/delete/{id}', [ContentController::class, 'destroy'])->name('admin.content.delete');
    Route::post('admin/content/updateorder', [ContentController::class, 'updateOrder'])->name('admin.content.updateorder');

    // site configuration
    Route::get('admin/siteconfiguration', [SiteConfigurationController::class, 'index'])->name('admin.siteconfiguration');
    Route::get('admin/siteconfiguration/edit/{id}', [SiteConfigurationController::class, 'edit'])->name('admin.siteconfiguration.edit');
    Route::post('admin/siteconfiguration/edit/{id}', [SiteConfigurationController::class, 'update'])->name('admin.siteconfiguration.update');

    // Media Upload & Fetching
    Route::post('admin/media/upload', [MediaManagerController::class, 'upload'])->name('admin.media.upload');
    Route::get('admin/media/medialist', [MediaManagerController::class, 'medialist'])->name('admin.media.medialist');
    Route::post('admin/media/updatetag', [MediaManagerController::class, 'updateTag'])->name('admin.media.updatetag');
    Route::delete('admin/media/{id}', [MediaManagerController::class, 'destroy'])->name('admin.media.destroy');

    //site_enquiry
    Route::get('admin/site_enquiry', [SiteEnquiryController::class, 'index'])->name('admin.site_enquiry');
    Route::get('admin/site_enquiry/delete/{id}', [SiteEnquiryController::class, 'destroy'])->name('admin.site_enquiry.delete');
    Route::get('admin/site_enquiry/edit/{id}', [SiteEnquiryController::class, 'edit'])->name('admin.site_enquiry.edit');

});

