@extends('layouts.campus')


@section('content')
    <h1 class="mt-3">Seja Bem Vindo(a) {{Auth::user()->name}}</h1>
    <h2>O que deseja fazer hoje ?</h2>

@endsection
