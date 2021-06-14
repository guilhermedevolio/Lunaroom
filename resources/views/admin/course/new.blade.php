@extends('layouts.admin')

@section('content')
    <h2 class="mt-3">Cadastrar Novo Curso</h2>
    <form action="{{route('post-course')}}" id="form" method="POST" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="card p-3">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <input type="text" class="form-control" name="description">
            </div>

            <div class="mb-3">
                <label class="form-label">Preço (Créditos da Plataforma)</label>
                <input type="number" class="form-control" name="price">
            </div>

            <div class="mb-3">
                <div class="form-label">Imagem de Capa</div>
                <input type="file" name="image" class="form-control">
            </div>

            <button id="btn-post" type="submit" class="btn btn-primary mt-3 w-100">Cadastrar Curso
            </button>
        </div>
    </form>


@endsection
