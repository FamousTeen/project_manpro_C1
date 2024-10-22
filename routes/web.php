<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

// Page Login yang asli
Route::get('/', function () {
    return view('main/mainpage');
})->name('main_page');


Route::get('/signUp', function () {
    return view('authentication/sign_up');
})->name('sign_up');

Route::get('/mainLogin', function () {
    return view('authentication/login');
})->name('start_login');

// ke fungsi "login" AuthController
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// buat testing
Route::get('/acara', function () {
    return view('anggota/alur_acara/acara');
})->name('acara_anggota');

//Jadwal Anggota
Route::get('/jadwal', function () {
    return view('anggota/jadwal');
})->name('jadwal_anggota');

Route::resource('accounts', AccountController::class)->except(['store'])->names([
    'index' => 'accounts.index',
    'create' => 'accounts.create',
    'show' => 'accounts.show',
    'edit' => 'accounts.edit',
    'update' => 'accounts.update',
    'destroy' => 'accounts.destroy',
]);

Route::post('/store-account', [AccountController::class, 'store'])->name('store_account');


// buat testing
Route::get('/evaluasi', function () {
    return view('anggota/evaluasi');
})->name('evaluasi_anggota');

// Evaluasi Anggota (Pengawas)
Route::get('/evaluasi_pengawas', function () {
    return view('anggota/evaluasi_pengawas');
})->name('evaluasi_pengawas_anggota');

// buat testing
Route::get('/post_pengumuman', function () {
    return view('admin/post_pengumuman');
})->name('pengumuman_admin');
