@extends('admin.NavbarAdmin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Editar categoria</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @method('PUT')
                        @include('admin.category.FormCategories')

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-warning text-white">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
