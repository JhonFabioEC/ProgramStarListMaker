@extends('admin.NavbarAdmin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-3">
        <div class="card w-100">
            <div class="card-header d-flex flex-row justify-content-center align-items-center p-3 w-100">
                <h3 class="m-0 me-auto h-100" id="title">@php echo strtoupper('Cuentas de Usuarios'); @endphp</h3>
            </div>

            <div class="card-body p-3 w-100">
                <div class="table-responsive p-1 w-100">
                    <table class="table table-striped table-hover table-bordered table-condensed display nowrap"
                        id="table_user_acount" style="width: 100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Imagen</th>
                                <th data-priority="1">Nombre de usuario</th>
                                <th>Correo electronico</th>
                                <th>Tipo de rol</th>
                                <th>Estado de cuenta</th>
                                <th>Fecha de creación</th>
                                <th>Fecha de modificación</th>
                                <th data-priority="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($users)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/users/' . ($user->roleType->name == 'Establecimiento' ? 'establishments/' : 'persons/') . $user->image) }}"
                                                alt="{{ $user->username }}" class="img-fluid img-thumbnail" width="100"
                                                height="100">
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email_address }}</td>
                                        <td class="text-center">
                                            <span
                                                style="color: #000000; background: {{ $user->roleType->color }}; padding: 0 7px; border-radius: 8px;">
                                                {{ $user->roleType->name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                style="color: #000000; background: {{ $user->account_status == true ? '#b0d89a' : '#f8bca4' }}; padding: 0 7px; border-radius: 8px;">
                                                {{ $user->account_status == true ? 'Activado' : 'Desactivado' }}</span>
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="btnEdit"
                                                        role="switch" {{ $user->account_status == true ? 'checked' : '' }}
                                                        title="Editar"
                                                        onclick="window.location.href = '/admin/management/user_accounts/account_status/{{ $user->id }}';">
                                                </div>
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
            $("#table_user_acount").DataTable({
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
