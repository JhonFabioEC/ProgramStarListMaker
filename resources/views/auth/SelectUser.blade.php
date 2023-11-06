@extends('auth.NavbarLogin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-5">
            <form action="#" method="POST" id="form_register" class="form shadow-lg rounded p-4">
                <h1 class="text-center">Registrarse</h1>

                <div class="form-step form-step-active">
                    <h3 class="text-center mb-4">¿Como?</h3>

                    <div class="form-outline mb-3">
                        <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnUser" autocomplete="off"
                                checked>
                            <label class="btn btn-primary d-flex justify-content-center align-items-center" for="btnUser"
                                style="width:148px; height: 148px;">
                                <div class="d-flex flex-column">
                                    <i class="fas fa-user fs-2"></i>
                                    <span>Usuario</span>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnEstablishment"
                                autocomplete="off">
                            <label class="btn btn-primary d-flex justify-content-center align-items-center"
                                for="btnEstablishment" style="width:148px; height: 148px;">
                                <div class="d-flex flex-column">
                                    <i class="fa-solid fa-shop fs-2"></i>
                                    <span>Establecimiento</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('registerPerson') }}" type="reset"
                            class="btn btn-primary w-100 btn-block" id="btnNext">Siguiente</a>
                    </div>
                </div>

                <!-- Boton para ir al login -->
                <div class="text-center mt-4">
                    <p>¿Ya eres miembro? <a href="{{ route('login') }}">Inicia Sesión</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="btnradio"]').change(function() {
                var name = $(this).attr('id') === 'btnUser' ? 'registerPerson' : 'registerEstablishment';
                var url = '{{ route("registerPerson") }}'; // Una ruta estática que se cambia dinámicamente

                if (name === 'registerEstablishment') {
                    url = '{{ route("registerEstablishment") }}';
                }

                $('a#btnNext').attr('href', url);
            });
        });
    </script>
@endsection
