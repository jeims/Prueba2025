@extends('layouts.app')

@section('titulo')
Registro
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="h4 text-primary mb-4">Registro</h2>

            <form action="{{route('registro')}}" method="POST" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="rol_id" class="form-label fw-bold text-uppercase text-secondary">Rol</label>
                    <select id="rol_id" name="rol_id" class="form-select">

                        @foreach($roles as $roles)
                        <option value="{{ $roles->id }}">{{ $roles->nombre }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold text-uppercase text-secondary">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">
                    @error('nombre')
                    <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">

                    <div class="col-md-6">
                        <label for="primer_apellido" class="form-label fw-bold text-uppercase text-secondary">Apellido Paterno</label>
                        <input type="text" name="primer_apellido" id="primer_apellido" placeholder="Tu apellido paterno" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">
                        @error('primer_apellido')
                        <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="segundo_apellido" class="form-label fw-bold text-uppercase text-secondary">Apellido Materno</label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido" placeholder="Tu apellido materno" class="form-control">
                    </div>
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-uppercase text-secondary">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Tu email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                    @error('email')
                    <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-uppercase text-secondary">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold text-uppercase text-secondary">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repetir contraseña" class="form-control">
                </div>



                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
