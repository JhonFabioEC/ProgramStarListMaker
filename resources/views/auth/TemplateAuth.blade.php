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
</head>

<body>
    <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>

    <header>
        <!-- Nav tabs -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary">
            <div class="container-fluid">
                @yield('logo')
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetAlert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/spinner.js') }}"></script>

    @yield('scripts')
</body>

</html>
