@extends('auth.NavbarLogin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-5">
            <form action="{{ route('savePerson') }}" method="POST" class="form shadow-lg rounded p-4">
                @csrf

                <div class="col-sm-12 text-center mb-2">
                    <h1>Registrarse</h1>
                </div>

                {{-- first_name --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Nombres</label>
                        <input type="text" name="first_name" id="first_name" class="form-control w-100"
                            value="{{ old('first_name', $person) }}" />
                    </div>

                    @error('first_name')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- last_name --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Apellidos</label>
                        <input type="text" name="last_name" id="last_name" class="form-control w-100"
                            value="{{ old('last_name', $person) }}" />
                    </div>

                    @error('last_name')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- birth_date --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Fecha de nacimiento</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control w-100"
                            min="{{ now()->subYears(100)->toDateString('Y-m-d') }}" max="{{ now()->toDateString('Y-m-d') }}"
                            value="{{ old('birth_date', $person) }}" />
                    </div>

                    @error('birth_date')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- sex --}}
                <div class="form-outline mb-3">
                    <label class="form-label">Sexo</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="M"
                                @checked(old('sex', $person) == 'M') checked>
                            <label class="form-check-label" for="male">Masculino</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="F"
                                @checked(old('sex', $person) == 'F')>
                            <label class="form-check-label" for="female">Femenino</label>
                        </div>
                    </div>

                    @error('sex')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- document_type_id --}}
                <div class="form-outline mb-3">
                    <label class="col-form-label w-100">Tipo de documento</label>
                    <select id="document_type_id" name="document_type_id" class="form-control form-select w-100">
                        <option value="">Escoger tipo de documento...</option>

                        @isset($document_types)
                            @foreach ($document_types as $document_type)
                                <option value="{{ $document_type->id }}"
                                    @isset($person)
                                    @selected(old('document_type_id', $person) == $document_type->id)
                                @endisset>
                                    {{ $document_type->name }} </option>
                            @endforeach
                        @endisset
                    </select>

                    @error('document_type_id')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- document_number --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Número de documento <strong>(6 - 10)</strong></label>
                        <input type="text" name="document_number" id="document_number" class="form-control w-100"
                            value="{{ old('document_number', $person) }}" />
                    </div>

                    @error('document_number')
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
                                    @isset($person)
                                    @selected(old('department_id', $person->municipality) == $department->id)
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
                    <select id="municipality_id" name="municipality_id" class="form-control form-select w-100">
                        <option value="none">Escoger municipio...</option>

                        @isset($municipalities)
                            @foreach ($municipalities as $municipality)
                                <option value="{{ $municipality->id }}"
                                    @isset($person)
                                    @selected(old('municipality_id', $person) == $municipality->id)
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
                            @isset($person)
                                {{ old('zone_type', $person) == 'Urbana' ? 'selected' : '' }}
                            @endisset>
                            Urbana</option>

                        <option value="Rural"
                            @isset($person)
                                {{ old('zone_type', $person) == 'Rural' ? 'selected' : '' }}
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
                            value="{{ old('address', $person) }}" />
                    </div>

                    @error('address')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- phone_number --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Número de teléfono <strong>(10)</strong></label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control w-100"
                            value="{{ old('phone_number', $person) }}" />
                    </div>

                    @error('phone_number')
                        <div class="text-small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- email_address --}}
                <div class="form-outline mb-3">
                    <div class="form-group">
                        <label class="col-form-label w-100">Correo electrónico</label>
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
                        <label class="col-form-label w-100">Nombre de usuario</label>
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
                        <label class="col-form-label w-100">Confirmar contraseña</label>
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
