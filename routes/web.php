<?php

use App\Models\Event;
use Illuminate\Support\Facades\Log;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MisaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MisaDetailController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Resources\EventResource;

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
    return view('main/mainpage');
})->name('main_page');


Route::get('/signUp', function () {
    return view('authentication/sign_up');
})->name('sign_up');

// Page Login yang asli
Route::get('/mainLogin', function () {
    return view('authentication/login');
})->name('start_login');


// Route::middleware('redirect.role')->group(callback: function () {
Route::get('/login', [AuthController::class, 'login'])->name('login');
// });

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth:account'])->group(function () {
    Route::get('/account/dashboard', [AccountController::class, 'dashboard'])->name('account.dashboard');
});

// buat testing
Route::resource('events', EventController::class)->names([
    'index' => 'events.index',
    'create' => 'events.create',
    'store' => 'events.store',
    'show' => 'events.show',
    'edit' => 'events.edit',
    'update' => 'events.update',
    'destroy' => 'events.destroy',
]);



//Jadwal Anggota
Route::get('/jadwal', [MisaController::class, 'index'])->name('jadwal_anggota');

//Dashboard
// Route::get('/dashboard_anggota', [DashboardController::class, 'index'])->name('dashboard_anggota');


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
Route::get('/evaluasi', [MisaDetailController::class, 'show'])->name('evaluasi_anggota');

// Evaluasi Anggota (Pengawas)
Route::get('/evaluasi_pengawas', function () {
    return view('anggota/evaluasi_pengawas');
})->name('evaluasi_pengawas_anggota');

Route::resource('misas', MisaController::class)->names([
    'index' => 'misas.index',
    'create' => 'misas.create',
    'store' => 'misas.store',
    'show' => 'misas.show',
    'edit' => 'misas.edit',
    'update' => 'misas.update',
    'destroy' => 'misas.destroy',
]);

Route::resource('announcements', AnnouncementController::class);

// buat testing
Route::get('/post_pengumuman', function () {
    return view('admin/post_pengumuman');
})->name('pengumuman_admin');

// buat testing
Route::get('/profile_admin', [AdminController::class, 'index'])->name('profile_admin');

// buat testing
Route::get('/profile_anggota', [AccountController::class, 'index'])->name('profile_anggota');

/* --------EDIT PROFILE ANGGOTA-------- */
// redirect ke page edit profile anggota
Route::get('/edit_profile_anggota', [AccountController::class, 'edit'])->name('edit_profile_anggota');

Route::get('/edit_profile_admin', [AdminController::class, 'edit'])->name('edit_profile_admin');

// post data edit profile anggota
Route::put('/update_profile_anggota', [AccountController::class, 'update'])->name('update_profile_anggota');

// post data edit profile admin
Route::put('/update_profile_admin', [AdminController::class, 'update'])->name('update_profile_admin');

// post data edit pp anggota
Route::put('/update_pp_anggota', [AccountController::class, 'updatePP'])->name('update_pp_anggota');

// post data edit pp admin
Route::put('/update_pp_admin', [AdminController::class, 'updatePP'])->name('update_pp_admin');
/* --------END EDIT PROFILE ANGGOTA-------- */

//Lihat list Anggota
Route::get('/list_anggota', function () {
    return view('admin/list_anggota');
})->name('list_anggota');

// update isi evaluasi
Route::put('/update_evaluasi/{id}', [MisaDetailController::class, 'updateEval'])->name('update_evaluasi');

Route::get('/update_evaluasi/{id}/{answer}', [MisaDetailController::class, 'updateConfirmation'])->name('update_konfirmasi');

//Lihat list Anggota
Route::get('/konfirmasi', function () {
    $user = null;
    if (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
    } elseif (Auth::guard('account')->check()) {
        $user = Auth::guard('account')->user();
    }

    // Fetch data for the dashboard
    $userData = Account::query()->where(
        'email',
        $user->email
    )->where('password', $user->password)->firstOrFail();


    return view('anggota/konfirmasi', compact('userData'));
})->name('konfirmasi');

//Input jadwal admin
Route::get('/input_misa', function () {
    return view('admin/input_misa');
})->name('input_misa');

//Input foto admin
Route::get('/input_foto', function () {
    return view('admin/input_foto');
})->name('input_foto');

//KHUSUS PENGURUS
//pengumuman
Route::get('/pengumuman_pengurus', function () {
    return view('admin/khusus_pengurus/pengumuman_pengurus');
})->name('pengumuman_pengurus');
Route::get('/events/search/{detail}', function (string $detail) {
    return EventResource::collection(Event::query()
    ->where('title', 'LIKE', '%' . $detail . '%')
    ->orWhere('date', 'LIKE', '%' . $detail . '%')
    ->get());
});

//dokumen
Route::get('/dokumen_pengurus', function () {
    return view('admin/khusus_pengurus/dokumen_pengurus');
})->name('dokumen_pengurus');

