@extends('layouts.campus')
@section('content')
    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3">
                <h2 class="" style="font-size: 30px;">Resumo da Compra</h2>
                <p>Invista no seu conhecimento.</p>

            </div>
            <div class="paginate mt-3">
                {{$courses->links()}}
            </div>
        </div>
    </div>
@endsection
