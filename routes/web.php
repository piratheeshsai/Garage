<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::post('/user/{id}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');

    Route::post('/user/{id}/activate', [UserController::class, 'activate'])->name('user.activate');
    Route::resource('user', UserController::class);
    Route::resource('Permission', PermissionController::class);


    Route::post('/update-user-role/{id}', [UserRoleController::class, 'updateUserRole'])->name('update.user.role');
    Route::resource('Role', UserRoleController::class);


    Route::resource('customers', CustomerController::class);
});

require __DIR__.'/auth.php';
