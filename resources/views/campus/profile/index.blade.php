@extends('layouts.components.profile-menu')
@extends('layouts.campus')

@section('content')

    @section('menu')
        <h2>Editar Meus Dados Pessoais</h2>
        <br>
        <form action="">
            <div class="mb-3">
                <label for="" class="form-label">Seu Nome</label>
                <input class="form-control" type="text" placeholder="Seu Nome" value="{{Auth::user()->name}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Seu Username</label>
                <input class="form-control" type="text" placeholder="Seu Nome" value="{{Auth::user()->name}}">
            </div>
            <div class="mb-3">
                <input class="btn btn-success" type="submit" placeholder="Seu Nome" value="Atualizar Dados">
            </div>
        </form>
    @endsection

@endsection


