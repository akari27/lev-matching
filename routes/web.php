<?php

use App\Http\Controllers\Japanese\ProfileController;
use App\Http\Controllers\Japanese\MypageController;
use App\Http\Controllers\Japanese\SearchController;
use App\Http\Controllers\Japanese\UserListController;
use App\Http\Controllers\Japanese\ApplicationController;

use App\Http\Controllers\Foreign\ForeignProfileController;
use App\Http\Controllers\Foreign\ForeignMypageController;
use App\Http\Controllers\Foreign\ForeignSearchController;
use App\Http\Controllers\Foreign\ForeignUserListController;
use App\Http\Controllers\Foreign\ForeignApplicationController;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mypage', [MypageController::class, 'show'])->name('mypage');
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::post('/search', [SearchController::class, 'search'])->name('search.search');
    Route::post('/search/apply', [SearchController::class, 'apply'])->name('search.apply');
    Route::get('/list', [UserListController::class, 'index'])->name('list.index');
    Route::post('/list', [UserListController::class, 'apply'])->name('list.apply');
    Route::get('/application', [ApplicationController::class, 'index'])->name('application.index');
    // Route::post('/application', [ApplicationController::class, 'permission'])->name('application.permission');
    // Route::post('/application', [ApplicationController::class, 'reject'])->name('application.reject');
    Route::post('/application/permission', [ApplicationController::class, 'permission'])->name('application.permission');
    Route::post('/application/reject', [ApplicationController::class, 'permission'])->name('application.permission');

    Route::get('/foreign/profile', [ForeignProfileController::class, 'edit'])->name('foreign.profile.edit');
    Route::post('/foreign/profile', [ForeignProfileController::class, 'update'])->name('foreign.profile.update');
    Route::delete('/foreign/profile', [ForeignProfileController::class, 'destroy'])->name('foreign.profile.destroy');
    Route::get('/foreign/mypage', [ForeignMypageController::class, 'show'])->name('foreign.mypage');
    Route::get('/foreign/search', [ForeignSearchController::class, 'index'])->name('foreign.search.index');
    Route::post('/foreign/search', [ForeignSearchController::class, 'search'])->name('foreign.search.search');
    Route::post('/foreign/search/apply', [ForeignSearchController::class, 'apply'])->name('foreign.search.apply');
    Route::get('/foreign/list', [ForeignUserListController::class, 'index'])->name('foreign.list.index');
    Route::post('/foreign/list', [ForeignUserListController::class, 'apply'])->name('foreign.list.apply');
    Route::get('/foreign/application', [ForeignApplicationController::class, 'index'])->name('foreign.application.index');
    Route::post('/foreign/application/permission', [ForeignApplicationController::class, 'permission'])->name('foreign.application.permission');
    Route::post('/foreign/application/reject', [ForeignApplicationController::class, 'reject'])->name('foreign.application.reject');
});

require __DIR__.'/auth.php';
