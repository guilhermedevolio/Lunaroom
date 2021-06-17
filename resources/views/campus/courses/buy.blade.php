@extends('layouts.campus')

@section('content')
    <div class="row d-flex  rounded-3 p-3" id="card-gigant"
         style="background: #1e1e1c; color: white">
        <div class="center d-flex align-items-center justify-content-around flex-wrap"
             style="max-width: 1600px !important; margin: 0 auto !important;">
            <div id="left" style="display: flex; flex-direction: column;  width: 30%; ">
                <h2 style="font-size: 40px;">{{$course->title}}</h2>
                <p>{!! $course->description !!}</p>
                <p class="font-weight-bold mb-4">Preço: {!! $course->price !!} Lunapoints</p>
                <a class="btn btn-success w-25">Comprar </a>
            </div>
            <div class="right" style="width: 10%;">
                <img src="{{asset('storage/courses/'.$course->image)}}" style="max-width: 300px" alt="">
            </div>
        </div>
    </div>
    <div class="container-md mt-3 mb-5">
        <h2>Conheça as aulas do curso :</h2>
        <div class="card shadow">
            @foreach($course->modules as $module)

                <div class="accordion" id="accordionFlush{{$module->id}}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne{{$module->id}}" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                {{$module->name}} - {{count($module->lessons)}} Aulas
                            </button>
                        </h2>
                        <div id="flush-collapseOne{{$module->id}}" class="accordion-collapse collapse"
                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush{{$module->id}}">
                            <div class="accordion-body d-flex flex-column">
                                @foreach($module->lessons as $lesson)
                                    <a class="mt-2">{{$lesson->title}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
    </div>
    <style>
        @media screen and (max-width: 768px) {
            #left {
                width: 100% !important;
            }

            .right {
                width: 100% !important;
            }
        }
    </style>
@endsection
