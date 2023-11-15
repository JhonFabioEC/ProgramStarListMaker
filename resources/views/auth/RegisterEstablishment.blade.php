@extends('auth.NavbarLogin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-5">
            <form action="{{ route('saveEstablishment') }}" method="POST" class="form shadow-lg rounded p-4">
                @csrf

                <div class="col-sm-12 text-center mb-2">
                    <h1>Registrarse</h1>
                </div>

                {{-- name --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control w-100"
                            value="{{ old('name', $establishment) }}" />
                    </div>

                    @error('name')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- establishment_type_id --}}
                <div class="form-outline mb-3">
                    <label class="col-form-label w-100">Tipo de establecimiento</label>
                    <select id="establishment_type_id" name="establishment_type_id" class="form-control form-select w-100">
                        <option value="">Escoger tipo de establecimiento...</option>

                        @isset($establishment_types)
                            @foreach ($establishment_types as $establishment_type)
                                <option value="{{ $establishment_type->id }}"
                                    @isset($establishment)
                                    @selected(old('establishment_type_id', $establishment) == $establishment_type->id)
                                @endisset>
                                    {{ $establishment_type->name }} </option>
                            @endforeach
                        @endisset
                    </select>

                    @error('establishment_type_id')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- department_id --}}
                <div class="form-outline mb-3">
                    <label class="col-form-label w-100">Departamento</label>
                    <select id="department_id" name="department_id" class="form-control form-select w-100">
                        <option value="">Escoger departamento...</option>

                        @isset($departments)
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    @isset($establishment)
                                    @selected(old('department_id', $establishment->municipality) == $department->id)
                                @endisset>
                                    {{ $department->name }} </option>
                            @endforeach
                        @endisset
                    </select>

                    @error('department_id')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- municipality_id --}}
                <div class="form-outline mb-3">
                    <label class="col-form-label w-100">Municipio</label>
                    <select id="municipality_id" name="municipality_id" class="form-control form-select w-100" disabled'>
                        <option value="none">Escoger municipio...</option>

                        @isset($municipalities)
                            @foreach ($municipalities as $municipality)
                                <option value="{{ $municipality->id }}"
                                    @isset($establishment)
                                    @selected(old('municipality_id', $establishment) == $municipality->id)
                                @endisset>
                                    {{ $municipality->name }} </option>
                            @endforeach
                        @endisset
                    </select>

                    @error('municipality_id')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- zone_type --}}
                <div class="form-outline mb-3">
                    <label class="col-form-label w-100">Tipo de zona</label>
                    <select id="zone_type" name="zone_type" class="form-control form-select w-100">
                        <option value="">Escoger tipo de zona...</option>

                        <option value="Urbana"
                            @isset($establishment)
                                {{ old('zone_type', $establishment) == 'Urbana' ? 'selected' : '' }}
                            @endisset>
                            Urbana</option>

                        <option value="Rural"
                            @isset($establishment)
                                {{ old('zone_type', $establishment) == 'Rural' ? 'selected' : '' }}
                            @endisset>
                            Rural</option>
                    </select>

                    @error('zone_type')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- address --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control w-100"
                            value="{{ old('address', $establishment) }}" />
                    </div>

                    @error('address')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- phone_number --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Número de Teléfono <strong>(10)</strong></label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control w-100"
                            value="{{ old('phone_number', $establishment) }}" />
                    </div>

                    @error('phone_number')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- email_address --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Correo Electrónico</label>
                        <input type="text" name="email_address" id="email_address" class="form-control w-100"
                            value="{{ old('email_address', $user) }}" />
                    </div>

                    @error('email_address')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- username --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Nombre de Usuario</label>
                        <input type="text" name="username" id="username" class="form-control w-100"
                            value="{{ old('username', $user) }}" />
                    </div>

                    @error('username')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- password --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control w-100" />
                    </div>

                    @error('password')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- password_confirmation --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control w-100" />
                    </div>

                    @error('password_confirmation')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button id="btnLogin" class="btn btn-primary btn-block mb-2 w-100" type="Submit">
                    Registrar
                </button>

                <div class="text-center">
                    <p>¿Ya eres miembro? <a href="{{ route('login') }}">Inicia Sesión</a></p>
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
