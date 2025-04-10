@extends('layouts.app')

@section('titulo')
Inicia Sesion
@endsection

@section('contenido')
<div class="container-md p-4 bg-white shadow-sm rounded">
    <h2 class="h2 mb-4 text-primary">Inicia Sesión</h2>

    <form action="{{route('login')}}" method="POST" novalidate>
        @csrf

        @if (session('mensaje'))
        <p class="alert alert-danger my-2 rounded text-center">{{session('mensaje')}}</p>
        @endif

        <div class="mb-4">
            <label for="email" class="form-label fw-bold text-uppercase text-secondary">E-mail</label>
            <input type="email" placeholder="Tu email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{old('email')}}">
            @error('email')
            <div class="alert alert-danger my-2 rounded text-center">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label fw-bold text-uppercase text-secondary">Contraseña</label>
            <input type="password" placeholder="Tu contraseña" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <div class="alert alert-danger my-2 rounded text-center">{{$message}}</div>
            @enderror
        </div>


        <div class="d-grid">
            <button type="submit" class="btn btn-primary py-2 px-4 rounded">
                Iniciar Sesión
            </button>
        </div>
    </form>
</div>
@endsection