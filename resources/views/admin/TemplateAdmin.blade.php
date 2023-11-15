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
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/Responsive-2.4.1/css/responsive.dataTables.min.css') }}">
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
                @yield('logo')
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        @yield('menu')
                    </ul>

                    <ul class="navbar-nav mt-0 mt-lg-0">
                        <li class="nav-item dropdown">
                            @yield('icono')
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                aria-labelledby="dropdownId">
                                @yield('profile')

                                <hr class="dropdown-divider"></hr>

                                <div class="dropdown-item">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/Responsive-2.4.1/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/spinner.js') }}"></script>

    @yield('scripts')
</body>

</html>
