@extends('layouts.admin')

@section('content')
    <!-- Page title -->
    <div class="page-header d-print-none pb-3">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Gerenciar Usuários
                </h2>
                <p>Todos os usuário cadastrados no sistema, cadastre novos usuários e gerencie suas permissões </p>
            </div>
        </div>
    </div>
    <h2>Usuários Cadastrados</h2>
    <div class="mb-3">
        <label class="form-label">Pesquise um usuário</label>
        <div class="input-icon mb-3">
            <input type="text" value="" id="input-search-user" class="form-control"
                   placeholder="Nome, Email, Username…">
        </div>
    </div>
    <div class="alert alert-danger alert-0" style="display: none">Nenhum usuário encontrado com os dados informados</div>
    <div class="col-12">
        <div class="card mb-3">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-users">
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td class="text-muted">
                                {{$user->email}}
                            </td>
                            <td class="text-muted"><a  class="text-reset">{{$user->username}}</a></td>
                            <td>
                                <a href="{{route('get-user', $user->id)}}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <span class="mt-5" style="margin-top: 20px;">
            Mostrando os ultimos</span> <span id="count-register">{{count($users)}}</span> usuários cadastrados
        </span>


    </div>

    <script>

        $(function () {
            $('#input-search-user').keyup(debounce(function () {
                const val = $('#input-search-user').val();
                if(val.length < 2) {return}
                loading();
                $.ajax({
                    url: "{{route('search-user')}}" + '/?input=' + val,
                    type: 'GET',
                    success: function (r) {
                        if(r.qtd < 1) {
                            $('.alert-0').show();
                        } else {
                            $('.alert-0').hide();
                        }
                        $('#tbody-users').empty();
                        $('#count-register').html(r.qtd);
                        r.users.forEach((el) => {
                            $('#tbody-users').prepend(`
                                <tr>
                                    <td>${el.name}</td>
                                    <td class="text-muted">
                                        ${el.email}
                                    </td>
                                    <td class="text-muted"><a  class="text-reset">${el.username}</a></td>
                                    <td>
                                        <a href="user/${el.id}">Editar</a>
                                    </td>
                                </tr>
                            `);
                        });
                        unloading();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }, 500));
        })

    </script>



@endsection
