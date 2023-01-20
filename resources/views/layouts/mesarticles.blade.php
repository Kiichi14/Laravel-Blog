@extends('master')
@include('components.myarticle')

@section('contenue')

@auth
    @yield('myarticle')
@endauth

@endsection