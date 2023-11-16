@extends('admin.TemplateAdmin')

@section('logo')
    <a class="navbar-brand" href="{{ route('welcome_establishment') }}">StarListMaker</a>
@endsection

@section('icono')
    <a class="nav-link {{ request()->is('establishment/profile*') ? 'active' : '' }} dropdown-toggle"
        href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <img class="icono" src="{{ asset('storage/users/establishments/' . Auth::user()->image) }}" alt="{{ Auth::user()->usename }}">
        {{ Auth::user()->username }}</a>
@endsection

@section('menu')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('establishment') ? 'active' : '' }}" href="{{ route('welcome_establishment') }}"
            aria-current="page"><i class="fa-solid fa-house"></i> Inicio <span class="visually-hidden">(current)</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link  {{ request()->is('establishment/management/*') ? 'active' : '' }} dropdown-toggle" href="#" id="dropdownId"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-gear"></i> Configuración</a>
        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownId">
            <a class="dropdown-item {{ request()->is('establishment/management/products') ? 'active' : '' }}"
                href="{{ route('products.index') }}"><i class="fas fa-box"></i> Productos</a>
        </div>
    </li>
@endsection

@section('profile')
    <a class="dropdown-item {{ request()->is('establishment/profile*') ? 'active' : '' }}"
        href="{{ route('establishment_profile') }}"><i class="fa-solid fa-user-gear"></i> Ver perfil</a>
@endsection
