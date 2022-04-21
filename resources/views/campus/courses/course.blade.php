@extends('layouts.campus')

@section('content')
    <div class="course d-flex">
        <div class="left" style="height: 100vh; border-right: 1px solid #ccc; width: 20%">
            <div class="head-menu p-2 d-flex justify-content-center align-items-center bg-dark text-white "
                 style="border-bottom: 1px solid #ccc">
                <h2 style="margin-top: 8px; cursor: pointer" onclick="globalVision()"> <i class="fa fa-home" ></i> Visão Geral do Curso</h2>
            </div>
            <div class="head-menu p-2 d-flex justify-content-center align-items-center bg-dark text-white "
                 style="border-bottom: 1px solid #ccc">
                <h2 style="margin-top: 8px">Conteúdo do Curso</h2>
            </div>
            <div class="menu-content">
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
                                <div style="padding: 0 !important;" class="accordion-body d-flex flex-column"
                                     style="background: white; color: black; font-size: 20px;">
                                    @foreach($module->lessons as $lesson)
                                        <a class="mt-2" style="cursor: pointer; border-bottom: 1px solid #ccc; padding: 8px;"
                                           id="btn-get-lesson" lesson-id="{{$lesson->id}}"> <i class="fas fa-play-circle"></i>  {{$lesson->title}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="right" style="width: 80%;">
            <div id="loading" style="margin-top: 40px;" hidden>
                <div class="loading d-flex h-100 justify-content-center align-items-center flex-column">
                    <div class="spinner-border" role="status" style="width: 40px; height: 40px;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h2>Carregando .....</h2>
                </div>
            </div>
            <div id="course-info" class="p-3">
                <h1 id="title-course-info">Bem-vindo(a) ao curso {{$course->title}}</h1>
                <p> {!! $course->description !!}</p>
                <div class="card">
                    <ul class="nav nav-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-home-9" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                                Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-profile-9" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                Alunos Cursando</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-profile-10" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                Trabalhos</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-home-9">
                                <div>
                                    <h2>O curso atualmente tem: {{count($course->modules)}} módulo</h2>
                                    <h2>Data de Lançamento: {{$course->created_at->format('d/m/Y')}}</h2>
                                    <h2>Alunos Inscritos: {{count($course->students)}}</h2>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-profile-9">
                                @foreach($course->students as $student)
                                    <div class="row">

                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="card">
                                            <div class="card-status-start bg-primary"></div>
                                            <div class="card-body">
                                                <h3 class="card-title">{{$student->user->name }}</h3>
                                                <p class="text-muted">{{$student->user->username }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane" id="tabs-profile-10">
                                <div>Hora de colocar a mão na massa, suas tarefas a serem realizadas estão abaixo:</div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="error-message p-3" style="display: none;">
                <div class="alert alert-info" id="error"></div>
            </div>
            <div class="content-lesson" style="display: none;">

                <input type="hidden" id="youtubeURL" value="https://www.youtube.com/watch?v=fLpCyU_SHRo">
                <div id="iframe">

                </div>
                <div class="lesson-info">
                    <h2 style="margin-left: 5px;" id="lesson-title"></h2>
                    <div class="card">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab">Comentários</a>
                            </li>
                            <li class="nav-item ms-auto">
                                <a href="#tabs-settings-7" class="nav-link" title="Settings" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="tabs-home-7">
                                    <div class="card text-dark mb-3" style="background: #fbfbf8;border: 1px solid #dcdacb;">
                                        <div class="card-header" style="font-size: 18px; font-weight: bold">Sobre essa aula</div>
                                        <div class="card-body">
                                            <p id="lesson-description"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-profile-7">
                                    <div>Ah mano , mais pa frente nois bola isso aq</div>
                                </div>
                                <div class="tab-pane" id="tabs-settings-7">
                                    <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .lesson-info {
            padding: 5px;
        }
        @media screen and (max-width: 768px) {
            .course{
                flex-direction: column;
            }
            .left{
                width: 100% !important;
                height: 250px !important;
                overflow-y: scroll !important;
            }
            .right{
                width: 100% !important;
            }
        }
    </style>
    <script src="{{asset('dist/youtube.js')}}"></script>
    <script>
        function globalVision() {
            $('.content-lesson').hide();
            $('#course-info').show();
            $('.error-message').hide();
        }
        $(document).on("click", "#btn-get-lesson", function (e) {

            e.preventDefault();
            var lesson_id = $(this).attr('lesson-id');

            $('#loading').attr('hidden', false);
            $('.content-lesson').hide();
            $('#course-info').hide();
            $.ajax({
                url: "http://127.0.0.1:8000/lesson/" + lesson_id,
                success: function (callback) {
                    $('#lesson-title').text(callback.title);
                    $('#youtubeURL').val(callback.video_link);
                    $('#lesson-description').html(callback.description)

                    var data = {
                        youtubeURL: GetValueId("youtubeURL"),
                        youtubeRESULT: "iframe"
                    };

                    CreateYoutube(data);

                    $('.error-message').hide();
                    setTimeout(() => {
                        $('#course-info').hide();
                        $('#loading').attr('hidden', true);
                        $('.content-lesson').show();
                    }, 1000);

                },
                error: function (callback) {
                    $('#course-info').hide();
                    $('.error-message').show();
                    $('#error').text(callback.responseJSON.message);
                    $('#loading').attr('hidden', true);
                }
            })
        })
    </script>

@endsection
