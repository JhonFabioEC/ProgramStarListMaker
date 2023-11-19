@extends('admin.NavbarUser')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="card w-100">
            <div class="card-header d-flex flex-row justify-content-center align-items-center p-3 w-100">
                <h3 class="m-0 me-auto h-100" id="title">@php echo strtoupper('Ordenes'); @endphp</h3>
            </div>

            <div class="card-body p-3 w-100">
                <div class="table-responsive p-1 w-100">
                    <table class="table table-striped table-hover table-bordered table-condensed display nowrap"
                        id="table_item_order" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Imagen</th>
                                <th data-priority="1">Nombre</th>
                                <th>Precio unitario</th>
                                <th>Cantidad</th>
                                <th>Valor total</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th data-priority="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($item_orders)
                                @foreach ($item_orders as $item_order)
                                    <tr>
                                        <td>{{ $item_order->id }}</td>
                                        <td><img src="{{ asset('storage/itemOrders/' . $item_order->image) }}"
                                                alt="{{ $item_order->name }}" class="img-fluid img-thumbnail" width="150"
                                                height="150"></td>
                                        <td>{{ $item_order->name }}</td>
                                        <td>{{ $item_order->price }}</td>
                                        <td>{{ $item_order->quantity }}</td>
                                        <td>{{ $item_order->price * $item_order->quantity }}</td>
                                        <td>{{ $item_order->category }}</td>
                                        <td>{{ $item_order->brand }}</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                                <button class="btn btn-danger"
                                                    onclick="window.location.href = '/user/orders/delete/{{ $item_order->id }}';"title="Quitar">
                                                    <i class="fas fa-minus-circle nav-icon"></i>
                                                </button>
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
            $("#table_item_order").DataTable({
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
