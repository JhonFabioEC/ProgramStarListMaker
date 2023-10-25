@extends('admin.TemplateAdmin')

@section('logo')
    <a class="navbar-brand" href="{{ route('welcome_admin') }}">StarListMaker</a>
@endsection

@section('menu')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('welcome_admin') }}"
            aria-current="page"><i class="fa-solid fa-house"></i> Inicio <span class="visually-hidden">(current)</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link {{ request()->is('admin/*') ? 'active' : '' }} dropdown-toggle" href="#" id="dropdownId"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-gear"></i> Administrador</a>
        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownId">
            <a class="dropdown-item {{ request()->is('admin/establishment_types') ? 'active' : '' }}"
                href="{{ route('establishment_types.index') }}"><i class="fa-solid fa-shop"></i> Tipo de establecimientos</a>
            <a class="dropdown-item" href="#"><i class="fas fa-star"></i> Categorias</a>
            <a class="dropdown-item" href="#"><i class="fa-solid fa-tag"></i> Marcas</a>
            <a>
                <hr class="dropdown-divider">
            </a>
            <a class="dropdown-item {{ request()->is('admin/userAccounts') ? 'active' : '' }}"
                href="{{ route('userAccounts.index') }}"><i class="fa-solid fa-users"></i> Cuentas de usuarios</a>
        </div>
    </li>
@endsection
