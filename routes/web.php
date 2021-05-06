<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //User Manage
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('index');
        Route::get('/create', [UserController::class,'create'])->name('create');
        Route::post('/', [UserController::class,'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class,'edit'])->name('edit');
        Route::put('/{user}', [UserController::class,'update'])->name('update');
        Route::delete('/{user}/delete', [UserController::class,'delete'])->name('delete');
    });

    //profile
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

    //student class
    Route::prefix('student/class')->name('student_class.')->group(function () {
        Route::get('/', [StudentClassController::class,'index'])->name('index');
        Route::get('/create', [StudentClassController::class,'create'])->name('create');
        Route::post('/', [StudentClassController::class,'store'])->name('store');
        Route::get('/{student_class}/edit', [StudentClassController::class,'edit'])->name('edit');
        Route::put('/{student_class}', [StudentClassController::class,'update'])->name('update');
        Route::delete('/{student_class}/delete', [StudentClassController::class,'delete'])->name('delete');

    });


    //student year
    Route::prefix('student/year')->name('student_year.')->group(function () {
        Route::get('/', [StudentYearController::class,'index'])->name('index');
        Route::get('/create', [StudentYearController::class,'create'])->name('create');
        Route::post('/', [StudentYearController::class,'store'])->name('store');
        Route::get('/{student_year}/edit', [StudentYearController::class,'edit'])->name('edit');
        Route::put('/{student_year}', [StudentYearController::class,'update'])->name('update');
        Route::delete('/{student_year}/delete', [StudentYearController::class,'delete'])->name('delete');

    });

    //student group
    Route::prefix('student/group')->name('student_group.')->group(function () {
        Route::get('/', [StudentGroupController::class,'index'])->name('index');
        Route::get('/create', [StudentGroupController::class,'create'])->name('create');
        Route::post('/', [StudentGroupController::class,'store'])->name('store');
        Route::get('/{student_group}/edit', [StudentGroupController::class,'edit'])->name('edit');
        Route::put('/{student_group}', [StudentGroupController::class,'update'])->name('update');
        Route::delete('/{student_group}/delete', [StudentGroupController::class,'delete'])->name('delete');
    });


    //student shift
    Route::prefix('student/shift')->name('student_shift.')->group(function () {
        Route::get('/', [StudentShiftController::class,'index'])->name('index');
        Route::get('/create', [StudentShiftController::class,'create'])->name('create');
        Route::post('/', [StudentShiftController::class,'store'])->name('store');
        Route::get('/{student_shift}/edit', [StudentShiftController::class,'edit'])->name('edit');
        Route::put('/{student_shift}', [StudentShiftController::class,'update'])->name('update');
        Route::delete('/{student_shift}/delete', [StudentShiftController::class,'delete'])->name('delete');
    });

    //fee category
    Route::prefix('fee/category')->name('fee_category.')->group(function () {
        Route::get('/', [FeeCategoryController::class,'index'])->name('index');
        Route::get('/create', [FeeCategoryController::class,'create'])->name('create');
        Route::post('/', [FeeCategoryController::class,'store'])->name('store');
        Route::get('/{fee_category}/edit', [FeeCategoryController::class,'edit'])->name('edit');
        Route::put('/{fee_category}', [FeeCategoryController::class,'update'])->name('update');
        Route::delete('/{fee_category}/delete', [FeeCategoryController::class,'delete'])->name('delete');
    });



    //fee category amount
    Route::prefix('fee/category/amount')->name('fee_category_amount.')->group(function () {
        Route::get('/', [FeeAmountController::class,'index'])->name('index');
        Route::get('/create', [FeeAmountController::class,'create'])->name('create');
        Route::post('/', [FeeAmountController::class,'store'])->name('store');
        Route::get('/{fee_category_id}/edit', [FeeAmountController::class,'edit'])->name('edit');
        Route::put('/{fee_category_id}', [FeeAmountController::class,'update'])->name('update');
        Route::get('/{fee_category_id}/detials', [FeeAmountController::class,'detials'])->name('detials');
    });

});
