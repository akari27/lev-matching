<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForeignProfileController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ForeignMypageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*|--------------------------------------------------------------------------
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

// Route::get('/mypage', function () {
//     return Inertia::render('Mypage');
// })->middleware(['auth', 'verified'])->name('mypage');

Route::get('/mypage', [MypageController::class, 'show'])->middleware(['auth', 'verified'])->name('mypage');
Route::get('/foreign/mypage', [ForeignMypageController::class, 'show'])->middleware(['auth', 'verified'])->name('mypage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/foreign/profile', [ForeignProfileController::class, 'edit'])->name('foreignprofile.edit');
    Route::post('/foreign/profile', [ForeignProfileController::class, 'update'])->name('foreignprofile.update');
    Route::delete('/foreign/profile', [ForeignProfileController::class, 'destroy'])->name('foreignprofile.destroy');
});

require __DIR__.'/auth.php';
