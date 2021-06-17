@extends('layouts.campus')

@section('content')
    <div class="container-xl">
        <div class="row mt-3">
            <h2 class="" style="font-size: 30px;">Meus Cursos</h2>
            <p>Aproveite para estudar hoje .....</p>
            @foreach($courses->courses as $course)
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('storage/courses/'.$course->image)}}" class="card-img-top mt-2" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{$course->title}}</h5>
                        <a href="#" class="btn btn-primary w-100">Acessar Curso</a>
                    </div>
                </div>
            @endforeach
            @empty($course)
                <div class="alert alert-info">Parece que você não possui nenhum curso, aproveite para comprar um agora mesmo na
                   nossa <a href="">Loja</a></div>
            @endempty
        </div>
    </div>

@endsection
