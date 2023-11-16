<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarListMaker</title>
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetAlert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('styles')
</head>

<body>
    <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>

    <header>
        <!-- Nav tabs -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">StarListMaker</a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}"
                                aria-current="page"><i class="fa-solid fa-house"></i> Inicio <span
                                    class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                                href="{{ route('login') }}"><i class="fa-solid fa-circle-user"></i> Iniciar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('filter')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="mt-3 mb-3 d-flex justify-content-center align-items-center">
            <strong>
                Jose Guillermo Hurtado & Jhon Fabio España
                copyrigth &copy; 2023
                <a href="http://wwwudenar.edu.co">Universidad de Nariño</a>
                Todos los derechos reservados
            </strong>
        </div>
    </footer>

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetAlert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/spinner.js') }}"></script>

    @yield('scripts')
</body>

</html>
