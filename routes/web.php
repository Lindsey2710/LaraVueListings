<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//------ middleware['auth'] is applied to all routes here cuz of group-> ----//
Route::middleware(['auth'])->group(function () {
//---- the verified middleware is only for protected routes so user must provide password to access this page ----//
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //----- patch route is to modify info in database like profile ------//
    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');
    //----- put route is to change password ------//
    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//---- start with this route first and after auth etc, change Route::inertia('/', 'Home')->name('home'); to this one----//
Route::get('/', [ListingController::class, 'index'])->name('home');
//------ php artisan route:list will show all these routes by just adding this line here after
//------ running this command -> php artisan make:model ListingController -a ------//
Route::resource('listing', ListingController::class)->except('index');


// imported routes from self created Auth.php file
require __DIR__ . '/auth.php';


