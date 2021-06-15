@extends('layouts.admin')

@section('content')
    <h2 class="mt-3">Gerenciar - {{$module->name}}</h2>
    <div class="card p-3">
        <form action="">
            <div class="mb-3">
                <label class="form-label">Nome do Módulo</label>
                <input type="text" value="{{$module->name}}" name="name" id="module_name" class="form-control"
                       placeholder="Nome do Módulo">
                <button class="btn btn-info mt-3">Atualizar</button>
            </div>
        </form>
    </div>

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
                                <input id="title" type="text" name="title" class="form-control"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Descrição da Aula</label>
                                <textarea id="description" type="text" name="description" class="form-control"
                                          id="exampleInputEmail1"
                                          aria-describedby="emailHelp"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Provedor do Vídeo</label>
                                <select id="select-provider" name="video_provider" class="form-select"
                                        aria-label="Default select example">
                                    <option value="999">Selecione uma opção</option>
                                    <option value="{{\App\Enums\LessonEnum::PROVIDER_YOUTUBE}}">YouTube</option>
                                    <option value="{{\App\Enums\LessonEnum::PROVIDER_VIMEO}}">Vimeo</option>
                                </select>
                            </div>
                            <div id="input_youtube" style="display: none;" class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Link do Vídeo
                                    (YouTube)</label>
                                <input id="input_link_youtube" type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"></input>
                            </div>
                            <div id="input_vimeo" style="display: none;" class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Link do Vídeo (Vimeo)</label>
                                <input id="input_link_vimeo" type="text" class="form-control"
                                       aria-describedby="emailHelp"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Data Liberação Aula</label>
                                <input id="init_date" type="date" name="init_date" class="form-control"
                                       aria-describedby="emailHelp"></input>


                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="btn-post-lesson" class="btn btn-primary">Cadastrar</button>
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
    <div class="card p-3">

    </div>
@endsection
