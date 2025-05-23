@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="text-center fw-bold display-5 text-primary mb-4">
                ✏️ Editar Usuario
            </h2>

            <form action="{{ route('users.update', $user) }}" method="POST" class="px-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Nombre</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
                    @error('name') 
                        <div class="text-danger mt-1">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Correo</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
                    @error('email') 
                        <div class="text-danger mt-1">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary px-4">
                        💾 Actualizar
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
