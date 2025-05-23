@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="text-center fw-bold display-5 text-success mb-4">
                ➕ Crear Nuevo Usuario
            </h2>

            <form action="{{ route('users.store') }}" method="POST" class="px-4">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Nombre</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    @error('name') 
                        <div class="text-danger mt-1">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Correo</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    @error('email') 
                        <div class="text-danger mt-1">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') 
                        <div class="text-danger mt-1">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">
                        💾 Guardar
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4">
                        ❌ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
