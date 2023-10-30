<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManualLoginController;
use App\Http\Controllers\ManualRegisterController;
use Illuminate\Support\Facades\Auth;
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
})->middleware(['auth']);

Auth::routes(['verify' => true]);

Route::middleware(['forTest', 'verified'])->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['web', 'auth'])->group(function() {
    Route::post('/upload', [HomeController::class, 'upload'])->name('upload');

});
Route::get('/manual-login', [ManualLoginController::class, 'manual'])->name('manual');
Route::post('/manual-login-save', [ManualLoginController::class, 'manualLogin'])->name('manual.save');


Route::get('/manual-register', [ManualRegisterController::class, 'manualR'])->name('manualR');
Route::post('/manual-register-save', [ManualRegisterController::class, 'manualRegister'])->name('manualRegister');

Route::get('/ajax-get', [AjaxController::class, 'get'])->name('get');
Route::post('/ajax-post', [AjaxController::class, 'post'])->name('post');