<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - @yield('titulo')</title>

   <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>

<body>

    <header class="p-5 border-bottom bg-white shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="display-5 fw-bold">@yield('titulo')</h1>

            @auth
                <nav class="d-flex gap-2 align-items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="fw-bold text-uppercase text-secondary small">Cerrar Sesión</button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="d-flex gap-2 align-items-center">
                    <a class="fw-bold text-uppercase text-secondary small" href="{{ route('login')}}">Login</a>
                    <a href="{{ route('registro')}}" class="fw-bold text-uppercase text-secondary small">Crear cuenta</a>
                </nav>
            @endguest
        </div>
    </header>

    <main class="container mx-auto mt-5">
        @yield('contenido')
    </main>

    <footer class="mt-5 text-center p-5 text-secondary fw-bold text-uppercase">
        JeimsMonroy - Todos los derechos reservados {{now()->year}}
    </footer>

</body>

</html>
