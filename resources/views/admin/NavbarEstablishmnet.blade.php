@extends('admin.TemplateAdmin')

@section('logo')
    <a class="navbar-brand" href="{{ route('welcome_establishment') }}">StarListMaker</a>
@endsection

@section('menu')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('establishment') ? 'active' : '' }}" href="{{ route('welcome_establishment') }}"
            aria-current="page"><i class="fa-solid fa-house"></i> Inicio <span class="visually-hidden">(current)</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"><i class="fa-solid fa-gear"></i> Configuración</a>
        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownId">
            <a class="dropdown-item" href="#"><i class="fas fa-box"></i> Productos</a>
        </div>
    </li>
@endsection