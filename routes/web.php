<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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




Route::get('login' , [AuthController::class , 'index'])->name('login');
Route::post('post-login' , [AuthController::class , 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'registration'])->name('register');
Route::post('/register', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard' , [AuthController::class , 'dashboard'])->name('dashboard');
logoutlogoutRoute::get('logout' , [AuthController::class , 'logout'])->name('logout');

