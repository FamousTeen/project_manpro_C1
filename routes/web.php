<?php

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
    return view('authentication/login');
});


Route::get('/signUp', function () {
    return view('authentication/sign_up');
})->name('sign_up');

Route::get('/main', function () {
    return view('main/mainpage');
});
// buat testing
Route::get('/dashboard', function () {
    return view('anggota/dashboard');
})->name('dashboard_anggota');

// buat testing
Route::get('/acara', function () {
    return view('anggota/acara');
})->name('acara_anggota');