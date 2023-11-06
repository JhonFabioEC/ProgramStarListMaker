@extends('auth.NavbarLogin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-5">
            <form action="{{ route('start') }}" method="POST" class="form shadow-lg rounded p-4">
                @csrf

                <div class="col-sm-12 text-center mb-2">
                    <h1>Iniciar Sesión</h1>
                </div>

                <!-- email_address -->
                <div class="form-outline mb-2">
                    <div class="form-group">
                        <label for="email_address" class="col-form-label">Usuario</label>
                        <input type="text" name="email_address" id="email_address" placeholder="Ej: pepe@gmail.com" class="form-control">
                    </div>
                    @error('email_address')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- password -->
                <div class="form-outline mb-2">
                    <div class="form-group">
                        <label for="password" class="col-form-label">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="●●●●●●●●" class="form-control">
                    </div>
                    @error('password')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <div class="d-flex justify-content-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="remenber" value="true" id="remenber">
                            <label class="form-check-label" for="remenber">Recordarme</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="#">¿Olvidó su contraseña?</a>
                    </div>
                </div>

                <button id="btnLogin" class="btn btn-primary btn-block mb-2 w-100" type="Submit">
                    Iniciar sesión
                </button>

                <div class="text-center">
                    <p>¿No eres miembro? <a href="{{ route('selectUser') }}">Registrate</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('error') }}',
                'error'
            )
        </script>
    @endif
@endsection
