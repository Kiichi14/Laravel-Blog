@extends('master')
@include('components.article')

@section('contenue')

@yield('articles')

@guest
    <p>Veuillez vous connecter pour avoir accées au Article</p>
@endguest

@endsection