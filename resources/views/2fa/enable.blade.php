<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Activar 2FA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full text-center">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Verificación en Dos Pasos</h1>
        <p class="text-gray-600 mb-6">Escanea este código QR con tu app de autenticación (Google Authenticator, Authy, etc.):</p>
        
        <div class="flex justify-center mb-6">
            {!! $qrCode !!}
        </div>

        <form method="POST" action="{{ route('2fa.validate') }}" class="space-y-4">
            @csrf
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Código de Autenticación</label>
                <input
                    type="text"
                    name="code"
                    id="code"
                    maxlength="6"
                    pattern="\d{6}"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="123456"
                >
            </div>

            @if ($errors->has('code'))
                <div class="text-red-500 text-sm">
                    {{ $errors->first('code') }}
                </div>
            @endif

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition"
            >
                Verificar
            </button>
        </form>
    </div>

</body>
</html>
