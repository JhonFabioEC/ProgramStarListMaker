@extends('admin.TemplateAdmin')

@section('logo')
    <a class="navbar-brand" href="{{ route('welcome_user') }}">StarListMaker</a>
@endsection

@section('menu')
    <li class="nav-item">
        <a class="nav-link {{ request()->is('user') ? 'active' : '' }}" href="{{ route('welcome_user') }}"
            aria-current="page"><i class="fa-solid fa-house"></i> Inicio <span class="visually-hidden">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" aria-current="page"><i class="fas fa-shopping-cart"></i> Mi lista</a>
    </li>
@endsection
