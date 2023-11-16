@extends('admin.NavbarUser')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-10">
            <form action="{{ route('updatePersonUser') }}" method="POST" enctype="multipart/form-data"
                class="form shadow-lg rounded p-4">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-sm-12 text-center mb-2">
                        <h1 class="fs-1 m-0">Editar perfil</h1>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    {{-- image --}}
                    <div class="col-lg-12 mb-3 d-flex justify-content-center">
                        <img name="image" id="preview-image-before-upload"
                            src="@isset($user)
                            {{ asset('storage/users/persons/' . $user->image) }}
                        @else
                            {{ asset('img/upload-image.png') }}
                        @endisset"
                            alt="Previsualizar imagen" class="image-preview">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="customFile" class="col-form-label">Imagen</label>
                        <div class="custom-file">
                            <input type="file" class="form-control custom-file-input" name="image" id="customFile"
                                placeholder="Selecciona una imagen" value="{{ old('image', $user) }}">
                            <label class="custom-file-label" for="customFile">Seleccionar</label>
                        </div>
                        @error('image')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- first_name --}}
                    <div class="col-sm-6 form-outline mb-3">
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
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Apellidos</label>
                            <input type="text" name="last_name" id="last_name" class="form-control w-100"
                                value="{{ old('last_name', $person) }}" />
                        </div>

                        @error('last_name')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- birth_date --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Fecha de nacimiento</label>
                            <p class="form-control w-100 bg-body-secondary">{{ $person->birth_date }}</p>
                        </div>
                    </div>

                    {{-- sex --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Sexo</label>
                            <p class="form-control w-100 bg-body-secondary">{{ $person->sex }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- document_type --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Tipo de documento</label>
                            <p class="form-control w-100 bg-body-secondary">{{ $person->documentType->name }}</p>
                        </div>
                    </div>

                    {{-- document_number --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Número de documento</label>
                            <p class="form-control w-100 bg-body-secondary">{{ $person->document_number }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- department_id --}}
                    <div class="col-sm-6 form-outline mb-3">
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
                    <div class="col-sm-6 form-outline mb-3">
                        <label class="col-form-label w-100">Municipio</label>
                        <select id="municipality_id" name="municipality_id" class="form-control form-select w-100">
                            <option value="">Escoger municipio...</option>

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
                </div>

                <div class="row">
                    {{-- zone_type --}}
                    <div class="col-sm-6 form-outline mb-3">
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
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control w-100"
                                value="{{ old('address', $person) }}" />
                        </div>

                        @error('address')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- phone_number --}}
                    <div class="col-sm-6 form-outline mb-3">
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
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Correo electrónico</label>
                            <input type="text" name="email_address" id="email_address" class="form-control w-100"
                                value="{{ old('email_address', $user) }}" />
                        </div>

                        @error('email_address')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- username --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Nombre de usuario</label>
                            <p class="form-control w-100 bg-body-secondary">{{ $user->username }}</p>
                        </div>
                    </div>

                    {{-- password --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control w-100"
                                placeholder="●●●●●●●●" />
                        </div>

                        @error('password')
                            <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 m-0 mt-2 ms-auto">
                        <div class="form-outline">
                            <div class="form-group text-right">
                                <div class="btns-group">
                                    <button type="button" onclick="location.href='{{ route('user_profile') }}';"
                                        class="btn btn-secondary text-white">
                                        <i class='fa fa-arrow-left'></i> Atras</button>

                                    <button type="button"
                                        onclick="window.location.href = '/user/profile/delete/{{ $user->id }}';"
                                        class="btn btn-danger"><i class='fa fa-trash'></i>
                                        Dar de baja</button>

                                    <button type="submit" class="btn btn-warning text-white">
                                        <i class='fa fa-edit'></i> Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
        });
        $(document).ready(function(e) {
            $('#customFile').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>

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
