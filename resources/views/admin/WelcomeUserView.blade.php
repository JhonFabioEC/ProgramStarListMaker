@extends('admin.NavbarUser')

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
                <form class="d-flex my-2 my-lg-0" action="{{ route('searchArticlesAdmin') }}" method="POST">
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
                    <div class="card shadow bg-body-tertiary rounded" style="width: 300px; height: 500px;">
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}" style="width: 300px; height: 300px;">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <h6 class="card-text">Marca: {{ $product->brand->name }}</h6>
                            <span class="card-text d-block">Precio: $ {{ $product->price }}</span>
                            <span class="card-text d-block">Cantidad: {{ $product->stock }}</span>
                            <span class="card-text d-block">De: <strong>{{ $product->establishment->name }}</strong></span>

                            <div class="d-flex flex-row mt-2">
                                <div class="spinner d-flex flex-row gap-1 w-100">
                                    <button class="btn btn-secondary" id="btn-decrease"
                                        onclick="decrease( {{ $product->id }}, 1 );">-</button>
                                    <input type="number" name="stock" id="stock{{ $product->id }}"
                                        class="form-control w-50" step="1" min="1" max="{{ $product->stock }}"
                                        placeholder = "1" value = "1" readonly>
                                    <button class="btn btn-secondary" id="btn-increase"
                                        onclick="increase({{ $product->id }}, {{ $product->stock }} );">+</button>

                                    <button class="btn btn-primary w-75" title="Agregar"
                                    onclick="window.location.href = '/user/product/{{ $product->id }}/'+$('#stock{{ $product->id }}').val();">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
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
            window.location.href = "/user/category/" + selectOption.value;
        });

        var brand = document.getElementById('brand_id');
        brand.addEventListener('change', function() {
            var selectOption = this.options[brand.selectedIndex];
            window.location.href = "/user/brand/" + selectOption.value;
        });

        function increase(id, max) {
            var value = parseInt($('#stock' + id).val(), 10);
            if (value < max) {
                $('#stock' + id).val(value + 1);
            }
        }

        function decrease(id, min) {
            var value = parseInt($('#stock' + id).val(), 10);
            if (value > min) {
                $('#stock' + id).val(value - 1);
            }
        }
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
