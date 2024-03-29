@extends('layouts.admin')

@section('content')
    <h2 class="mt-3">Gerenciar - {{$module->name}}</h2>
    <div class="card p-3">
        <form action="" id="form-put-module">
            <div class="mb-3">
                <label class="form-label">Nome do Módulo</label>
                <input type="text" value="{{$module->name}}" name="name" class="form-control" placeholder="Nome do Módulo">
                <button id="btn-update-module" class="btn btn-info mt-3">Atualizar</button>
                <button id="btn-delete-module" class="btn btn-danger mt-3">Deletar Módulo</button>
            </div>
        </form>
    </div>

    {{--  Delete Module Script  --}}
    <script>
        $('#btn-delete-module').click(function (e) {
            e.preventDefault();
            const assert = confirm('Certeza que deseja excluir o módulo ?');

            if (assert) {
                toastr.success('Redirecionando ...', 'Módulo Deletado com sucesso')
                setTimeout(() => {
                    location.href = "{{route('delete-module', $module->id)}}"
                }, 1000)
            }
        });
    </script>
    {{--  Update Module Script  --}}
    <script>
        $('#btn-update-module').click(function(e) {
            e.preventDefault();
            const payload = $('#form-put-module').serialize();

            $.ajax({
                url: "{{route('put-module', $module->id)}}",
                method: 'PUT',
                data: payload,
                success: (callback) => {
                    toastr.success("Atualizando a Página", "Módulo Atualizado com sucesso");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: (callback) => {
                    if (callback.responseJSON.errors) {
                        $.each(callback.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error('Erro ao atualizar módulo')
                    }
                }
            });
        })
    </script>

    {{-- Lessons  --}}
    <div class="d-flex justify-content-between mt-4 mb-3">
        <h2 class="mt-3">Gerenciar Aulas</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Cadastrar Nova Aula
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Aula</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form id="form-lesson">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nome da Aula</label>
                                <input id="title" type="text" name="title" class="form-control"></input>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Descrição da Aula</label>
                                <textarea  type="text" name="description" class="form-control"  aria-describedby="emailHelp"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Provedor do Vídeo</label>
                                <select id="select-provider" name="video_provider" class="form-select"   aria-label="Default select example">
                                    <option value="999">Selecione uma opção</option>
                                    <option value="{{\App\Enums\LessonEnum::PROVIDER_YOUTUBE}}">YouTube</option>
                                    <option value="{{\App\Enums\LessonEnum::PROVIDER_VIMEO}}">Vimeo</option>
                                </select>
                            </div>

                            <div id="input_youtube" style="display: none;" class="mb-3">
                                <label class="form-label">Link do Vídeo(YouTube)</label>
                                <input id="input_link_youtube" type="text" class="form-control" >
                            </div>

                            <div id="input_vimeo" style="display: none;" class="mb-3">
                                <label class="form-label">Link do Vídeo (Vimeo)</label>
                                <input id="input_link_vimeo" type="text" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data Liberação Aula</label>
                                <input id="init_date" type="date" name="init_date" class="form-control" >
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="btn-post-lesson" class="btn btn-primary">Cadastrar</button>
                        <button id="btn-loading" style="display: none" class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cadastrando Aula
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Post Lesson Script  --}}
    <script>
        //Change Input to current provider
        $('#select-provider').on('change', (e) => {
            const value = $("#select-provider option:selected").val();

            //Handle Youtube
            if (value === "0") {
                $('#input_vimeo').hide();
                $('#input_youtube').show();
            }

            if (value === "1") {
                $('#input_vimeo').show();
                $('#input_youtube').hide();
            }
        })

        $('#btn-post-lesson').click(function (e) {
            e.preventDefault();
            $(this).hide();
            $('#btn-loading').show();
            const data_save = $('#form-lesson').serializeArray();
            const provider = $("#select-provider option:selected").val();

            data_save.push({name: "module_id", value: {{$module->id}}});
            data_save.push({name: "provider_video", value: provider});

            if (provider === "0") {
                data_save.push({name: "video_link", value: $('#input_link_youtube').val()});
            }

            if (provider === "1") {
                data_save.push({name: "video_link", value: $('#input_link_vimeo').val()});
            }

            $.ajax({
                url: "{{route('post-lesson')}}",
                method: 'POST',
                data: data_save,
                success: function (callback) {
                    toastr.success("Atualizando a página ...", "Aula Cadastrada com sucesso");
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
                error: function (callback) {
                    $('#btn-post-lesson').show();
                    $('#btn-loading').hide();
                    if (callback.responseJSON.errors) {
                        $.each(callback.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error('Email ou senha inválidos')
                    }
                }
            });
        })
    </script>

    <div class="card mt-3 shadow  p-3">
        <table id="table" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Provedor do Vídeo</th>
                <th scope="col">Link Vídeo</th>
                <th scope="col">Data Criação</th>
                <th scope="col">Editar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($module->lessons as $lesson)
            <tr>
                <th scope="row">{{$lesson->title}}</th>
                <td>{{$lesson->provider_video == \App\Enums\LessonEnum::PROVIDER_YOUTUBE ? 'Youtube' : 'Vimeo'}}</td>
                <td><a target="_blank" href="{{$lesson->video_link}}">{{$lesson->video_link}}</a></td>
                <td>{{$lesson->created_at}}</td>
                <td><a  href="{{route('get-lesson', $lesson->id)}}">Editar</a></td>
            </tr>
            @endforeach

            </tbody>
        </table>
        <script>
            $('#table').DataTable();
        </script>
    </div>
@endsection
