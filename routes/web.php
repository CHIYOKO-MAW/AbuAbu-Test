<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ReadingController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AudioStoreController;
use App\Http\Controllers\ReadingStoreController;
use App\Http\Controllers\ToolsStoreController;
use App\Support\AbuAbu;
use App\Support\HomeStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $site = config('abuabu.site');
    $lang = AbuAbu::lang($request->query('lang'));

    return view('welcome', [
        'site' => $site,
        'lang' => $lang,
        'homeView' => HomeStore::viewModel($lang),
        'pageTitle' => config('abuabu.brand.name'),
        'pageDescription' => config('abuabu.brand.description'),
    ]);
})->name('home');

Route::get('/browse', function (Request $request) {
    $lang = AbuAbu::lang($request->query('lang'));

    return redirect()->route('audio.index', [
        'lang' => $lang,
    ]);
});

Route::get('/browse/audio', [AudioStoreController::class, 'index'])->name('audio.index');
Route::get('/browse/audio/artists', [AudioStoreController::class, 'artists'])->name('audio.artists');
Route::get('/browse/audio/artist/{slug}', [AudioStoreController::class, 'artist'])->name('audio.artist');
Route::get('/browse/audio/genre/{slug}', [AudioStoreController::class, 'genre'])->name('audio.genre');
Route::get('/browse/audio/new', [AudioStoreController::class, 'newReleases'])->name('audio.new');
Route::get('/browse/audio/{artist}/{album}', [AudioStoreController::class, 'show'])->name('audio.show');
Route::get('/browse/audio/{artist}/{album}/download', [AudioStoreController::class, 'download'])->name('audio.download');
Route::get('/browse/reading', [ReadingStoreController::class, 'index'])->name('reading.index');
Route::get('/browse/reading/{type}/{slug}', [ReadingStoreController::class, 'show'])->name('reading.show');
Route::get('/browse/reading/{type}/{slug}/download', [ReadingStoreController::class, 'download'])->name('reading.download');
Route::get('/browse/tools', [ToolsStoreController::class, 'index'])->name('tools.index');
Route::get('/browse/tools/help/{slug}', [ToolsStoreController::class, 'help'])->name('tools.help');
Route::get('/browse/tools/{slug}/download', [ToolsStoreController::class, 'download'])->name('tools.download');
Route::get('/browse/tools/{slug}', [ToolsStoreController::class, 'show'])->name('tools.show');

Route::get('/request', function (Request $request) {
    $lang = AbuAbu::lang($request->query('lang'));
    $store = \App\Support\RequestStore::store();

    return view('request.index', [
        'store' => $store,
        'lang' => $lang,
        'pageTitle' => 'Abu-Abu Request',
        'pageDescription' => $store['hero']['copy'] ?? config('abuabu.brand.description'),
    ]);
})->name('request');

Route::post('/request', [\App\Http\Controllers\RequestController::class, 'submit'])->name('request.submit');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
    
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
    
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist');
    Route::get('/api/wishlist', [\App\Http\Controllers\WishlistController::class, 'apiList'])->name('api.wishlist');
    Route::post('/api/wishlist/{album}', [\App\Http\Controllers\WishlistController::class, 'add'])->name('api.wishlist.add');
    Route::delete('/api/wishlist/{album}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('api.wishlist.remove');
});

require __DIR__.'/admin.php';
