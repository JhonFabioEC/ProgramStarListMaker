@extends('admin.NavbarAdmin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-10">
            <div class="form shadow-lg rounded p-4">
                <div class="row">
                    <div class="col-sm-12 text-center mb-2">
                        <h1 class="fs-1 m-0">Mi perfil</h1>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    {{-- image --}}
                    <div class="col-lg-12 mb-3 d-flex justify-content-center">
                        <img name="image" id="preview-image-before-upload"
                            src="{{ asset('storage/users/persons/' . $user->image) }}"
                            alt="Previsualizar imagen" class="image-preview">
                    </div>
                </div>

                <div class="row">
                    {{-- first_name --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Nombres</label>
                            <p class="form-control w-100">{{ $person->first_name }}</p>
                        </div>
                    </div>

                    {{-- last_name --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Apellidos</label>
                            <p class="form-control w-100">{{ $person->last_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- birth_date --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Fecha de Nacimiento</label>
                            <p class="form-control w-100">{{ $person->birth_date }}</p>
                        </div>
                    </div>

                    {{-- sex --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Sexo</label>
                            <p class="form-control w-100">{{ $person->sex }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- document_type --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Tipo de documento</label>
                            <p class="form-control w-100">{{ $person->documentType->name }}</p>
                        </div>
                    </div>

                    {{-- document_number --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Número de documento</label>
                            <p class="form-control w-100">{{ $person->document_number }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- department --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Departamento</label>
                            <p class="form-control w-100">{{ $person->municipality->department->name }}</p>
                        </div>
                    </div>

                    {{-- municipality --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Municipio</label>
                            <p class="form-control w-100">{{ $person->municipality->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- zone_type --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Tipo de zona</label>
                            <p class="form-control w-100">{{ $person->zone_type }}</p>
                        </div>
                    </div>

                    {{-- address --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Dirección</label>
                            <p class="form-control w-100 overflow-x-auto">{{ $person->address }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- phone_number --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Número de Teléfono</label>
                            <p class="form-control w-100">{{ $person->phone_number }}</p>
                        </div>
                    </div>

                    {{-- email_address --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Correo Electrónico</label>
                            <p class="form-control w-100">{{ $user->email_address }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- username --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Nombre de Usuario</label>
                            <p class="form-control w-100">{{ $user->username }}</p>
                        </div>
                    </div>

                    {{-- password --}}
                    <div class="col-sm-6 form-outline mb-3">
                        <div class="form-group">
                            <label class="col-form-label w-100">Contraseña</label>
                            <p class="form-control w-100">●●●●●●●●</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 m-0 mt-2 ms-auto">
                        <div class="form-outline">
                            <div class="form-group text-right">
                                <div class="btns-group">
                                    <button type="button"
                                        onclick="location.href='{{ route('admin_edit_profile') }}';"
                                        class="btn btn-warning text-white">
                                        <i class='fa fa-edit'></i> Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
