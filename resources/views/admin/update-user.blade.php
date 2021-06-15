@extends('layouts.admin')

@section('content')
    <div class="card p-3 mt-5">
        <div class="row">
            <form id="form-update" action="{{route('put-user', $user->id)}}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        <h2>Editar Usuário {{$user->name}}</h2>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="{{$user->username}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$user->email}}">
                    </div>

                    @if($user->id != Auth::user()->id)
                        <label class="form-label">Cargo no Sistema</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" {{!$user->admin ? 'checked' : ''}} name="admin"
                                       value="{{\App\Enums\UserEnum::ROLE_USER}}"
                                       class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        Usuário
                                    </div>
                                </div>
                            </label>
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" {{$user->admin ? 'checked' : ''}} name="admin"
                                       value="{{\App\Enums\UserEnum::ROLE_ADMIN}}" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        Administrador
                                    </div>
                                </div>
                            </label>
                            @else
                                <div class="alert alert-warning">
                                    <p>Você não pode alterar suas próprias permissões</p>
                                </div>
                            @endif
                            <button id="btn-update" type="submit" class="btn btn-primary mt-3 w-100">Atualizar Dados
                            </button>
                            <button id="btn-delete" class="btn btn-danger mt-3 w-100">Excluir Usuário</button>
                        </div>

                </div>
            </form>
        </div>
        <script>
            $('#btn-delete').on('click', (event) => {
                event.preventDefault();
                var confirm = window.confirm('Certeza que deseja excluir o usuário? Isso vai excluir todas as integrações com a conta dele');
                if (confirm) {
                    $.ajax({
                        url: "{{route('delete-user', $user->id)}}",
                        method: 'DELETE',
                        success: function () {
                            toastr.success('Redirecionando..', 'Usuário deletado com sucesso');
                            setTimeout(function () {
                                location.href = "{{route('get-user', $user->id)}}"
                            }, 2000);
                        },
                        error: function (callback) {
                            toastr.error(callback.responseJSON.msg);
                        }
                    })
                }

            })

            $('#btn-update').on('click', (event) => {
                event.preventDefault();
                var form = $('#form-update').serialize();
                $.ajax({
                    url: "{{route('put-user', $user->id)}}",
                    method: 'PUT',
                    data: form,
                    success: function (callback) {
                        toastr.success('Usuário atualizado com sucesso');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (callback) {
                        if (callback.responseJSON.errors) {
                            $.each(callback.responseJSON.errors, function (key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error('Erro ao atualizar usuário');
                        }
                    }
                })

            })
        </script>

        <div class="card p-3 mt-5 mb-5">
            <div class="mb-3">
                <h2>Editar Carteira {{$user->name}}</h2>
                <form id="form-wallet" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Créditos</label>
                        <input type="text" name="credits" class="form-control" value="{{$user->wallet->credits}}">
                    </div>
                    <button id="btn-update-wallet" type="submit" class="btn btn-primary mt-3 w-100">Atualizar Carteira
                    </button>
                </form>

            </div>
        </div>

        <script>
            $('#btn-update-wallet').on('click', (event) => {
                event.preventDefault();
                var form = $('#form-wallet').serialize();
                $.ajax({
                    url: "{{route('put-wallet', $user->wallet->id)}}",
                    method: 'PUT',
                    data: form,
                    success: function (callback) {
                        toastr.success('Carteira atualizada com sucesso');
                    },
                    error: function (callback) {
                        if (callback.responseJSON.errors) {
                            $.each(callback.responseJSON.errors, function (key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error('Erro ao atualizar carteira');
                        }
                    }
                })

            })
        </script>

@endsection
