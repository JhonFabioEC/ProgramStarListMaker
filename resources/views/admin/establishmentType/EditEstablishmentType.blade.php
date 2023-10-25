@extends('admin.NavbarAdmin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Tipo de Establecimiento</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('establishment_types.update', $establishmentType) }}" method="POST">
                        @method('PUT')
                        @include('admin.establishmentType.FormEstablishmentType')

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-warning text-white">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
