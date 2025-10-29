@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Crear Cuenta</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection