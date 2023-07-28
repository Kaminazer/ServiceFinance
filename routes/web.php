<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Route::get('/profile',[ProfileController::class, 'show'])->middleware(['auth', 'verified'])->name('profile.show');
Route::patch('/settings',[SettingsController::class, 'setSettings'])->middleware(['auth', 'verified'])->name('settings.setSettings');
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/settings',[SettingsController::class, 'show'])->middleware(['auth', 'verified'])->name('settings');
Route::resource('accounts', AccountsController::class);
Route::resource('transactions', TransactionController::class);
require __DIR__.'/auth.php';
