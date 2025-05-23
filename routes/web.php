<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Google2FAController;

// Redirigir la raíz a /users
Route::get('/', function () {
    return redirect('/users');
});

// Ruta dashboard protegida con auth, verified y 2fa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', '2fa'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/2fa/enable', [TwoFactorController::class, 'enable2FA'])->name('2fa.form');
    Route::post('/2fa/validate', [TwoFactorController::class, 'validate2FA'])->name('2fa.validate');
});

// Rutas protegidas con auth y 2fa (perfil)
Route::middleware(['auth', '2fa'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
