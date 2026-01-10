<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NarasumberController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KontenSiaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Guest Routes (belum login)
Route::middleware('guest')->group(function () {
    //Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
    Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyIdentifier'])->name('forgot-password.verify');
    Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-password.reset');
});

// Authenticated Routes (sudah login)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    //Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::delete('/photo', [ProfileController::class, 'deletePhoto'])->name('photo.delete');
    });

    //Pengguna
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        Route::delete('/{user}/photo', [UserController::class, 'deletePhoto'])->name('photo.delete');
    });

    // Narasumber
    Route::prefix('narasumber')->name('narasumber.')->group(function () {
        Route::get('/', [NarasumberController::class, 'index'])->name('index');
        Route::get('/create', [NarasumberController::class, 'create'])->name('create');
        Route::post('/', [NarasumberController::class, 'store'])->name('store');
        Route::get('/{narasumber}', [NarasumberController::class, 'show'])->name('show');
        Route::get('/{narasumber}/edit', [NarasumberController::class, 'edit'])->name('edit');
        Route::put('/{narasumber}', [NarasumberController::class, 'update'])->name('update');
        Route::delete('/{narasumber}', [NarasumberController::class, 'destroy'])->name('destroy');
        Route::delete('/{narasumber}/photo', [NarasumberController::class, 'deletePhoto'])->name('photo.delete');
        Route::get('/export', [NarasumberController::class, 'export'])->name('export');
    });

    // Kategori 
    Route::resource('kategori', KategoriController::class);
    Route::post('kategori/{kategori}/toggle-status', [KategoriController::class, 'toggleStatus'])
        ->name('kategori.toggle-status');

    // Program Routes
    Route::resource('program', ProgramController::class);
    Route::post('program/{program}/change-status', [ProgramController::class, 'changeStatus'])
        ->name('program.change-status');

    // Konten Siaran Routes
    Route::resource('konten-siaran', KontenSiaranController::class);
    
    // Additional routes untuk konten siaran
    Route::prefix('konten-siaran')->name('konten-siaran.')->group(function () {
        // Manage narasumber dalam konten
        Route::get('{kontenSiaran}/narasumber', [KontenSiaranController::class, 'manageNarasumber'])->name('manage-narasumber');
        Route::post('{kontenSiaran}/narasumber', [KontenSiaranController::class, 'storeNarasumber'])->name('store-narasumber');
        Route::delete('{kontenSiaran}/narasumber/{narasumber}', [KontenSiaranController::class, 'removeNarasumber'])->name('remove-narasumber');
        
        // Workflow status
        Route::post('{kontenSiaran}/ajukan', [KontenSiaranController::class, 'ajukan'])->name('ajukan');
        Route::post('{kontenSiaran}/setujui', [KontenSiaranController::class, 'setujui'])->name('setujui');
        Route::post('{kontenSiaran}/tolak', [KontenSiaranController::class, 'tolak'])->name('tolak');
        Route::post('{kontenSiaran}/siapkan-tayang', [KontenSiaranController::class, 'siapkanTayang'])->name('siapkan-tayang');
        Route::post('{kontenSiaran}/mulai-tayang', [KontenSiaranController::class, 'mulaiTayang'])->name('mulai-tayang');
        Route::post('{kontenSiaran}/selesai-tayang', [KontenSiaranController::class, 'selesaiTayang'])->name('selesai-tayang');
        Route::post('{kontenSiaran}/batalkan', [KontenSiaranController::class, 'batalkan'])->name('batalkan');
        Route::post('{kontenSiaran}/arsipkan', [KontenSiaranController::class, 'arsipkan'])->name('arsipkan');
    });
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
});

// Redirect root ke login atau dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});