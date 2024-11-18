<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;


//---------------------- PROFILE ROUTES ----------------------//
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



//---------------------- LISTING ROUTES ----------------------//
//---- start with this Route::inertia('/', 'Home')->name('home'); first and after auth etc, change it to this one----//
Route::get('/', [ListingController::class, 'index'])->name('home');


//------ php artisan route:list will show all these routes by just adding this line here after
//------ running this command -> php artisan make:model ListingController -a ------//
Route::resource('listing', ListingController::class)->except('index');




//---------------------- ADMIN ROUTES ----------------------//
//------ Admin routes wrapped in a middleware group (Admin::class) and no need to repeat AdminController::class for the routes ------//
Route::middleware(['auth', 'verified', Admin::class])
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
        Route::get('/users/{user}', 'show')->name('user.show');
        Route::put('/admin/{user}/role', 'role')->name('admin.role');
        Route::put('/listing/{listing}/approve', 'approve')->name('admin.approve');
});


// imported routes from self created Auth.php file
require __DIR__ . '/auth.php';


