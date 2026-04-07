<?php

use App\Http\Controllers\AudioStoreController;
use App\Http\Controllers\ReadingStoreController;
use App\Http\Controllers\ToolsStoreController;
use App\Support\AbuAbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $site = config('abuabu.site');
    $lang = AbuAbu::lang($request->query('lang'));

    return view('welcome', [
        'site' => $site,
        'lang' => $lang,
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
    $store = config('request', []);

    return view('request.index', [
        'store' => $store,
        'lang' => $lang,
        'pageTitle' => 'Abu-Abu Request',
        'pageDescription' => $store['hero']['copy'] ?? config('abuabu.brand.description'),
    ]);
})->name('request');
