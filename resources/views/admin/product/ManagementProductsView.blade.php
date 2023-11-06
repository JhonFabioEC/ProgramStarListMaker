@extends('admin.NavbarEstablishmnet')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="card w-100">
            <div class="card-header d-flex flex-row justify-content-center align-items-center p-3 w-100">
                <h3 class="m-0 me-auto h-100" id="title">@php echo strtoupper('Productos'); @endphp</h3>

                <a href="{{ route('products.create') }}" class="ms-2 btn btn-primary" title="Nuevo">
                    <i class="fas fa-plus-circle nav-icon"></i>
                </a>
            </div>

            <div class="card-body p-3 w-100">
                <div class="table-responsive p-1 w-100">
                    <table class="table table-striped table-hover table-bordered table-condensed display nowrap"
                        id="table_product" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Imagen</th>
                                <th data-priority="1">Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Codigo de barras</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th>Seccion</th>
                                <th>Descripcion</th>
                                <th data-priority="3">Estado</th>
                                <th>Fecha de creación</th>
                                <th>Fecha de modificación</th>
                                <th data-priority="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($products)
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ asset('storage/products/' . $product->image) }}"
                                                alt="{{ $product->name }}" class="img-fluid img-thumbnail" width="150"
                                                height="150"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->barcode }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td>{{ $product->section }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td class="text-center">
                                            <span
                                                style="color: #000000; background: {{ $product->state == true ? '#b0d89a' : '#f8bca4' }}; padding: 0 7px; border-radius: 8px;">
                                                {{ $product->state == true ? 'Activado' : 'Desactivado' }}</span>
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-warning text-white" title="Editar">
                                                    <i class="fas fa-edit nav-icon"></i>
                                                </a>

                                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger" title="Eliminar">
                                                        <i class="fas fa-minus-circle nav-icon"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $("#table_product").DataTable({
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select class="custom-select custom-select-sm form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>` +
                        " registros por página",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay datos disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "processing": "Procesando..."
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "columnDefs": [{
                        "responsivePriority": 1,
                        "targets": 0
                    },
                    {
                        "responsivePriority": 2,
                        "targets": -1
                    },
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                    },
                    {
                        "targets": [0, 5],
                        "orderable": false,
                        "searchable": false,
                    },
                ],
                "stateSave": true,
                "stateDuration": -1,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
