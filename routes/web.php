<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return Inertia::render('Mypage');
})->middleware(['auth', 'verified'])->name('mypage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// japaneseとforeign分け
// Route::middleware('auth')->group(function () {
//     Route::get('japanese/profile', [ProfileController::class, 'japaneseedit'])->name('japanese/profile.edit');
//     Route::patch('japanese/profile', [ProfileController::class, 'japaneseupdate'])->name('japanese/profile.update');
//     Route::delete('japanese/profile', [ProfileController::class, 'japanesedestroy'])->name('japanese/profile.destroy');
//     Route::get('foreign/profile', [ProfileController::class, 'foreignedit'])->name('foreign/profile.edit');
//     Route::patch('foreign/profile', [ProfileController::class, 'foreignupdate'])->name('foreign/profile.update');
//     Route::delete('foreign/profile', [ProfileController::class, 'foreigndestroy'])->name('foreign/profile.destroy');
// });

require __DIR__.'/auth.php';