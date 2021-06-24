@extends('layouts.campus')


@section('content')
    <style>
        .mt-2 {
            margin-top: 0 !important;
        }
    </style>
    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3">
                <h2 class="" style="font-size: 30px;">Loja</h2>
                <p>Invista no seu conhecimento.</p>
                    @foreach($courses as $course)
                        <div class="card shadow" style="width: 18rem; margin-right: 20px; padding: 0; margin: 0 !important">
                        <img id="image" src="{{asset('storage/courses/'.$course->image)}}" class="card-img-top mt-2" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$course->title}}</h5>
                            <a href="{{route('get-course', $course->id)}}" class="btn btn-primary w-100">Ver Curso</a>
                        </div>
                    </div>
                @endforeach
                @empty($course)
                    <div class="alert alert-info">Ops! Parece que não tem nenhum curso na loja =) </div>
                @endempty
            </div>
            <div class="paginate mt-3">
                {{$courses->links()}}
            </div>
        </div>
    </div>
    <style>
        #image{
            width: 100%;
            object-fit: cover;
            height: 250px;
        }
        @media screen and (max-width: 768px) {
            .card{
                margin: 0 !important;
                width: 100% !important;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
