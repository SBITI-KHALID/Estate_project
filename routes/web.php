<?php

use App\Http\Controllers\OffreController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view("/Login","Login")->name("login");

Route::post('/LoginF', [AuthController::class, 'login'])->name('loginF');

Route::view("/Signup","Signup")->name("Signup");

Route::get('/', [OffreController::class, 'index']);

Route::post('/NewUser', [AuthController::class, 'NewUser'])->name('NewUser');

Route::middleware(['auth'])->group(function(){
    
    Route::get('/{view?}', [OffreController::class, 'index']);
    
    Route::resource('/Offres',OffreController::class); // List des Offres
    
    Route::post('/upload-images', [ImageController::class, 'store'])->name('images.store');
    
    Route::resource('/User',UserController::class);
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

