<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('todos', TodoController::class)
    ->except('show');

Route::prefix('todos')
    ->controller(TodoController::class)
    ->name('todos.')
    ->group(function () {
        Route::get('/dashboard', 'dashBoard')
            ->name('dashboard');
        Route::get('/{todo}/owner_index', 'ownerIndex')
            ->name('owner_index');
        Route::get('/dust-box', 'dustBox')
            ->name('dust-box');
        Route::post('{todo}/destroy', 'dustBoxClear')
            ->name('dust-box-clear');
        Route::get('{todo}/restore', 'restore')
            ->name('restore');
    });

Route::prefix('files')
    ->controller(FileController::class)
    ->name('files.')
    ->group(function () {
        Route::get('{file}/destroy', 'destroy')
            ->name('destroy');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
