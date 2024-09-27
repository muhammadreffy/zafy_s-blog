<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontConfig\FrontController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');

// =========================AUTHENTICATICATE===================
Route::name('auth.')->prefix('auth')->middleware('auth_check')->group(function () {
    Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration-store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login-authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('dashboard_auth')->group(function () {
    Route::get('/my-profile/@{user:username}', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/settings/my-profile/@{user:username}', [ProfileController::class, 'settings'])->name('settings');
    Route::put('/update/my-profile/@{user:username}', [ProfileController::class, 'update_profile'])->name('update_profile');
});

// =========================AUTHENTICATICATE END===================

Route::name('dashboard.')->prefix('dashboard')->middleware('dashboard_auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::name('category.')->prefix('categories')->middleware('role:owner')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/add-category', [CategoryController::class, 'create'])->name('create');
        Route::post('/add-category', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit-category/{category:slug}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/edit-category/{category:slug}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete-category/{category:slug}/delete', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::name('writers.')->prefix('writers')->group(function () {
        Route::get('/', [WriterController::class, 'index'])->name('index');
        Route::post('/apply', [WriterController::class, 'apply_writer'])->name('apply');
        Route::put('/update/{writer}', [WriterController::class, 'update_status'])->name('update-status');

    });

    Route::name('posts.')->prefix('posts')->middleware('role:owner|writer')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create-new-post', [PostController::class, 'create'])->name('create');
        Route::post('/add-new-post', [PostController::class, 'store'])->name('store');
        Route::get('/detail-post/{post:slug}/detail', [PostController::class, 'show'])->name('show');
        Route::get('/edit-post/{post:slug}/edit', [PostController::class, 'edit'])
            ->middleware('ensure_post_owner')->name('edit');
        Route::put('/update-post/{post:slug}/update', [PostController::class, 'update'])->name('update');
        Route::delete('/delete-post/{post:slug}/delete', [PostController::class, 'destroy'])->name('destroy');
    });
});

Route::name('post.')->prefix('post')->middleware('dashboard_auth')->group(function () {
    Route::get('/detail/{post:slug}', [FrontController::class, 'detail_post'])->name('detail');
});

Route::get('/profile/{user:username}', [FrontController::class, 'user_profile'])->name('profile.user');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('category');
