<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;

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
    return view('auth.login');
});

Route::get('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


//User Manage

Route::prefix('users')->name('user.')->group(function () {
    Route::get('/', [UserController::class,'index'])->name('index');
    Route::get('/create', [UserController::class,'create'])->name('create');
    Route::post('/', [UserController::class,'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class,'edit'])->name('edit');
    Route::put('/{user}', [UserController::class,'update'])->name('update');
    Route::delete('/{user}/delete', [UserController::class,'delete'])->name('delete');
});


Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class,'index'])->name('index');
    Route::get('/{user}/edit_pass', [ProfileController::class,'edit_pass'])->name('pass.edit');
    Route::put('/password/{user}', [ProfileController::class,'update_pass'])->name('pass.update');
    // Route::get('/create', [UserController::class,'create'])->name('create');
    // Route::post('/', [UserController::class,'store'])->name('store');
    Route::get('/{user}/edit', [ProfileController::class,'edit'])->name('edit');
    Route::put('/{user}', [ProfileController::class,'update'])->name('update');
    // Route::delete('/{user}/delete', [UserController::class,'delete'])->name('delete');
});
