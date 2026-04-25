<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ReadingController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('abumin')->name('admin.')->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Protected routes
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Artists
        Route::resource('/artists', ArtistController::class)->except(['show']);

        // Albums
        Route::resource('/albums', AlbumController::class);
        Route::post('/albums/{album}/tracks', [AlbumController::class, 'tracks'])->name('albums.tracks');
        Route::get('/albums/{album}/cover', [AlbumController::class, 'cover'])->name('albums.cover');
        Route::post('/albums/{album}/cover', [AlbumController::class, 'uploadCover'])->name('albums.uploadCover');
        Route::delete('/albums/{album}/cover', [AlbumController::class, 'deleteCover'])->name('albums.deleteCover');

        // Reading
        Route::resource('/reading', ReadingController::class);
        Route::get('/reading/{item}/cover', [ReadingController::class, 'cover'])->name('reading.cover');
        Route::post('/reading/{item}/cover', [ReadingController::class, 'uploadCover'])->name('reading.uploadCover');
        Route::delete('/reading/{item}/cover', [ReadingController::class, 'deleteCover'])->name('reading.deleteCover');

        // Tools
        Route::resource('/tools', ToolController::class);
        Route::post('/tools/{tool}/help', [ToolController::class, 'storeHelp'])->name('tools.storeHelp');
        Route::delete('/tools/{tool}/help/{helpArticle}', [ToolController::class, 'destroyHelp'])->name('tools.destroyHelp');
        Route::get('/tools/{tool}/cover', [ToolController::class, 'cover'])->name('tools.cover');
        Route::post('/tools/{tool}/cover', [ToolController::class, 'uploadCover'])->name('tools.uploadCover');
        Route::delete('/tools/{tool}/cover', [ToolController::class, 'deleteCover'])->name('tools.deleteCover');

        // Requests
        Route::resource('/requests', RequestController::class)->only(['index', 'show', 'update']);
    });
});