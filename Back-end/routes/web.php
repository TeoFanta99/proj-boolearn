<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index'])->name('welcome');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/user/edit/{id}', [MainController::class, 'edit'])
    ->name('user.edit');
    Route::put('/user/create/{id}', [MainController::class, 'store'])
    ->name('user.store');    
    Route::put('/user/update/{id}', [MainController::class, 'update'])
    ->name('user.update'); 
    Route::delete('/user/del/{id}', [MainController::class, 'destroy'])
    ->name('user.del');  
    Route::get('/user/create', [MainController::class, 'create'])
    ->name('user.create');
});
Route::get('/user/{id}', [MainController::class, 'show'])->name('user.show');

require __DIR__ . '/auth.php';
