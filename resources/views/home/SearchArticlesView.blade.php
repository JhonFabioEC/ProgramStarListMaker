@extends('home.TemplateHome')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center align-items-center g-3">
            <div class="col-8">
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2" type="text" placeholder="Buscar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>

            <div class="col-2">
                <select class="form-select form-select" name="categories" id="categories">
                    <option value="0" selected>Categorias</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-2">
                <select class="form-select form-select" name="brands" id="brands">
                    <option selected>Marcas</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-center mt-3 gap-3">
        @foreach ($products as $product)
            <div class="row justify-content-center align-items-center">
                <div class="col-12 d-flex gap-4 justify-content-center flex-wrap">
                    <div class="card shadow bg-body-tertiary rounded" style="width: 300px; height: 460px;">
                        <img src="{{ asset('storage/products/'.$product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}" style="width: 300px; height: 300px;">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <h6 class="card-text">Marca: {{ $product->brand->name }}</h6>
                            <span class="card-text d-block">Precio: $ {{ $product->price }}</span>
                            <span class="card-text d-block">Cantidad: {{ $product->stock }}</span>
                            <span class="card-text d-block">De:  <strong>{{ $product->establishment->name }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
