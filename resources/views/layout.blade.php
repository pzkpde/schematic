@extends('bonjour::layout')

@section('bonjour::navigation')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('schematic::index') }}">Schematic</a>
      </li>
@endsection

@section('bonjour::content')
    @yield('schematic::content')
@endsection