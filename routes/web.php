<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta dashboard protegida con auth, verified y 2fa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', '2fa'])->name('dashboard');

// Rutas para habilitar y validar 2FA - solo requiere autenticación
Route::middleware('auth')->group(function () {
    

    Route::get('/2fa/enable', [TwoFactorController::class, 'enable2FA'])->middleware('auth');
    Route::post('/2fa/validate', [TwoFactorController::class, 'validate2FA'])->name('2fa.validate')->middleware('auth');

});

// Rutas protegidas con auth y 2fa (perfil)
Route::middleware(['auth', '2fa'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
