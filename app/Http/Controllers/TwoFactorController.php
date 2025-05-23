<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Google2FA;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class TwoFactorController extends Controller
{
    public function enable2FA()
{
    $user = Auth::user();

    // Genera clave si no existe
    if (!$user->google2fa_secret) {
        $user->google2fa_secret = app('pragmarx.google2fa')->generateSecretKey();
        $user->save();
    }

    // Genera la URL para el código QR
    $qrCodeUrl = app('pragmarx.google2fa')->getQRCodeUrl(
        config('app.name'),
        $user->email,
        $user->google2fa_secret
    );

    // Genera el SVG del QR
    $qrCode = \QrCode::format('svg')->size(200)->generate($qrCodeUrl);

    // Pasa la variable a la vista
    return view('2fa.enable', compact('qrCode'));
}

    public function validate2FA(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = Auth::user();

        $valid = app('pragmarx.google2fa')->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            session(['2fa_passed' => true]);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Código inválido']);
    }
}