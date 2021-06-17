@extends('layouts.admin')

@section('content')
    <h2 class="mt-3">Editar Aula - {{$lesson->title}} </h2>
    <div class="card mt-3 p-3">
        <form id="form-lesson" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome da Aula</label>
                <input id="title" type="text" value="{{$lesson->title}}" name="title" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Descrição da Aula</label>
                <textarea name="description" cols="30" rows="10"  aria-hidden="true">
                    {{$lesson->description}}
                </textarea>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Provedor do Vídeo </label>
                <select id="select-provider" name="video_provider" class="form-select"   aria-label="Default select example">
                    <option selected {{$lesson->provider_video == 0 ? 'selected' : ''}} value="{{\App\Enums\LessonEnum::PROVIDER_YOUTUBE}}">YouTube</option>
                    <option {{$lesson->provider_video == 1 ? 'selected' : ''}} value="{{\App\Enums\LessonEnum::PROVIDER_VIMEO}}">Vimeo</option>
                </select>
            </div>

            <div id="input_youtube" style="{{$lesson->provider_video == \App\Enums\LessonEnum::PROVIDER_YOUTUBE ? '' : 'display: none;'}}" class="mb-3">
                <label class="form-label">Link do Vídeo(YouTube)</label>
                <input id="input_link_youtube" value="{{$lesson->provider_video == \App\Enums\LessonEnum::PROVIDER_YOUTUBE ? $lesson->video_link : ''}}" type="text" class="form-control" >
            </div>

            <div id="input_vimeo" style ="{{$lesson->provider_video == \App\Enums\LessonEnum::PROVIDER_VIMEO ? '' : 'display: none;'}}" class="mb-3">
                <label class="form-label">Link do Vídeo (Vimeo)</label>
                <input id="input_link_vimeo" value="{{$lesson->provider_video == \App\Enums\LessonEnum::PROVIDER_VIMEO ? $lesson->video_link : ''}}" type="text" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Data Liberação Aula</label>
                <input id="init_date" type="date" value="{{$lesson->init_date}}" name="init_date" class="form-control" >
            </div>


            <div class="mb-3">
                <input id="btn-update-lesson" type="submit" value="Atualizar Aula" name="init_date" class="btn btn-info" >
                <button id="btn-loading" style="display: none" class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Atualizando Aula
                </button>
                <a name="init_date" class="btn btn-danger" href="{{route('delete-lesson', $lesson->id)}}">Deletar Aula</a>
            </div>
        </form>
    </div>
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

        $('#btn-update-lesson').click(function (e) {
            e.preventDefault();
            $(this).hide();
            $('#btn-loading').show();

            const data_save = $('#form-lesson').serializeArray();
            const provider = $("#select-provider option:selected").val();

            data_save.push({name: "provider_video", value: provider});

            if (provider === "0") {
                data_save.push({name: "video_link", value: $('#input_link_youtube').val()});
            }

            if (provider === "1") {
                data_save.push({name: "video_link", value: $('#input_link_vimeo').val()});
            }

            $.ajax({
                url: "{{route('put-lesson', $lesson->id)}}",
                method: 'PUT',
                data: data_save,
                success: function (callback) {
                    toastr.success("Atualizando a página ...", "Aula Atualizada com sucesso");
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
                error: function (callback) {
                    $('#btn-update-lesson').show();
                    $('#btn-loading').hide();
                    if (callback.responseJSON.errors) {
                        $.each(callback.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error('Erro ao atualizar aula')
                    }
                }
            });
        })
    </script>
@endsection
