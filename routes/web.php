<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

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

/*Route méthodes GET*/
Route::get('/', [ArticlesController::class, 'index'])->name('index');
Route::get('/last', [ArticlesController::class, 'index'])->name('last');
Route::get('/today', [ArticlesController::class, 'index'])->name('today');
Route::get('/mesarticles/last', [ArticlesController::class, 'index'])->name('mylast');
Route::resource('/mesarticles', ArticlesController::class);

/*Route d'enregistremnt et de login de l'utilisateur*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
