@extends('home.TemplateHome')

@section('styles')
    <style>
        main {
            margin-top: 130px;
        }
    </style>
@endsection

@section('filter')
    <div class="container mb-3 mt-3">
        <div class="row justify-content-center align-items-center g-3">
            <div class="col-8">
                <form class="d-flex my-2 my-lg-0" action="{{ route('searchArticlesHome') }}" method="POST">
                    @csrf
                    <input class="form-control me-sm-2" type="text" name="search" placeholder="Buscar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>

            <div class="col-2">
                <select class="form-select form-select" name="category_id" id="category_id">
                    <option value="all" selected>Categorias</option>

                    @isset($categories)
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @isset($category_id)
                                    @selected($category_id == $category->id)
                                @endisset
                            >{{ $category->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="col-2">
                <select class="form-select form-select" name="brand_id" id="brand_id">
                    <option value="all" selected>Marcas</option>
                    @isset($brands)
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                @isset($brand_id)
                                    @selected($brand_id == $brand->id)
                                @endisset
                            >{{ $brand->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-wrap justify-content-center mt-3 gap-3">
        @foreach ($products as $product)
            <div class="row justify-content-center align-items-center">
                <div class="col-12 d-flex gap-4 justify-content-center flex-wrap">
                    <div class="card shadow bg-body-tertiary rounded" style="width: 300px; height: 460px;">
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}" style="width: 300px; height: 300px;">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <h6 class="card-text">Marca: {{ $product->brand->name }}</h6>
                            <span class="card-text d-block">Precio: $ {{ $product->price }}</span>
                            <span class="card-text d-block">Cantidad: {{ $product->stock }}</span>
                            <span class="card-text d-block">De:
                                <strong>{{ $product->establishment->name }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var category = document.getElementById('category_id');
        category.addEventListener('change', function() {
            var selectOption = this.options[category.selectedIndex];
            window.location.href = "/category/" + selectOption.value;
        });

        var brand = document.getElementById('brand_id');
        brand.addEventListener('change', function() {
            var selectOption = this.options[brand.selectedIndex];
            window.location.href = "/brand/" + selectOption.value;
        });
    </script>
@endsection
