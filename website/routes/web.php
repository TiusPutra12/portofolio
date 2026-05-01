<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TechStackController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\EducationSubController;
use App\Http\Controllers\Admin\SocialController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [PortfolioController::class, 'index']);

// Admin Login (no middleware)
Route::get('/admin/login', [AdminLoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin Area (protected)
Route::prefix('admin')->middleware('admin.password')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('certificates', CertificateController::class)->names('admin.certificates');
    Route::resource('activities', ActivityController::class)->names('admin.activities');
    Route::resource('projects', ProjectController::class)->names('admin.projects');
    Route::resource('education', EducationController::class)->names('admin.education');
    Route::get('/education/{education}/subs/create', [EducationSubController::class, 'create'])->name('admin.education.subs.create');
    Route::post('/education/{education}/subs', [EducationSubController::class, 'store'])->name('admin.education.subs.store');
    Route::get('/education-subs/{sub}/edit', [EducationSubController::class, 'edit'])->name('admin.education.subs.edit');
    Route::put('/education-subs/{sub}', [EducationSubController::class, 'update'])->name('admin.education.subs.update');
    Route::delete('/education-subs/{sub}', [EducationSubController::class, 'destroy'])->name('admin.education.subs.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/tech-stack', [TechStackController::class, 'edit'])->name('admin.tech_stack.edit');
    Route::put('/tech-stack', [TechStackController::class, 'update'])->name('admin.tech_stack.update');

    Route::get('/socials', [SocialController::class, 'edit'])->name('admin.socials.edit');
    Route::put('/socials', [SocialController::class, 'update'])->name('admin.socials.update');
});
