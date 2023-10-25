@extends('admin.NavbarAdmin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Tipo de Establecimiento</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('establishment_types.store') }}" method="POST">
                        @include('admin.establishmentType.FormEstablishmentType')

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
