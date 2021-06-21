@extends('layouts.components.profile-menu')
@extends('layouts.campus')

@section('content')

@section('menu')

    <h2>Configurar Perfil Público</h2>
    @if(!Auth::user()->profile)
        <p>Você ainda não ativou essa feature, ao habilitar seu perfil para acesso público, os usuários poderam ver
            dados da sua conta , como Cursos que você possui e suas redes sociais</p>
        <a class="btn btn-success" onclick="activePublicProfile()" href="">Ativar Perfil Público</a>

        <script>
            $('.btn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('create-public-profile')}}",
                    method: 'POST',
                    success: function (callback) {
                        toastr.success('Atualizando a Página', 'Perfil Criado com sucesso');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                })
            })
        </script>
    @else
        <div class="md-12">
            <form id="form" method="POST" action="{{route('update-public-profile')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="mb-3">
                    <div class="divide-y d-flex">
                        <div>
                            <label class="row">
                                <span class="col">Perfil Público</span>
                                <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                      <input name="active" class="form-check-input" type="checkbox" {{Auth::user()->profile->active ? 'checked' : ''}} >
                                    </label>
                                  </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagem de Perfil</label>
                    <input type="file" name="image" class="form-control" id="file">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Link Perfil Linkedin</label>
                    <input type="url" name="linkedin_url" value="{{Auth::user()->profile->linkedin_url}}"
                           class="form-control" placeholder="linkedin_url">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">NickName Discord</label>
                    <input type="text" name="discord_nick" value="{{Auth::user()->profile->discord_nick}}"
                           class="form-control" placeholder="Ex: GD#4918">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Link Perfil Github</label>
                    <input type="url" name="github_url" value="{{Auth::user()->profile->github_url}}"
                           class="form-control" placeholder="github_url">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Link Website Pessoal</label>
                    <input type="url" name="website_url" value="{{Auth::user()->profile->website_url}}"
                           class="form-control" placeholder="website_url">
                </div>

                <div class="mb-3">
                    <label class="form-label">Biografia</label>
                    <textarea name="biography">{{Auth::user()->profile->biography}}</textarea>
                </div>

                <button type="submit" id="btn-update-public-profile" class="btn btn-primary">Atualizar Perfil</button>
            </form>
        </div>
        <script>
            $('#btn-update-public-profile').click(function() {
                $(this).attr('disabled', true);
            })
            {{--$(function () {--}}

            {{--    var form;--}}
            {{--    $('#file').change(function (event) {--}}
            {{--        form = new FormData();--}}
            {{--        form.append('fileUpload', event.target.files[0]); // para apenas 1 arquivo--}}
            {{--        //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção--}}
            {{--    });--}}

            {{--    $('#btn-update-public-profile').click(function (e) {--}}
            {{--        e.preventDefault();--}}
            {{--        $.ajax({--}}
            {{--            url: "{{route('update-public-profile')}}",--}}
            {{--            method: 'PUT',--}}
            {{--            data: form,--}}
            {{--            processData: false,--}}
            {{--            contentType: false,--}}
            {{--            type: 'POST',--}}
            {{--            success: function (data) {--}}
            {{--                // utilizar o retorno--}}
            {{--            }--}}
            {{--        });--}}
            {{--    });--}}
            {{--});--}}
        </script>
    @endif
@endsection
@endsection


