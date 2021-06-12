@extends('layouts.admin')

@section('content')
    <!-- Page title -->
    <div class="page-header d-print-none pb-3">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Gerenciar Usuários
                </h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive p-3">
            <table id="table" class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th class="w-1"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td class="text-muted">
                           {{$user->username}}
                        </td>
                        <td class="text-muted"><a href="#" class="text-reset">{{$user->email}}</a></td>
                        <td class="text-muted">
                            {{$user->admin ? 'Administrador' : 'Usuário'}}
                        </td>
                        <td>
                            <a href="{{route('get-user', $user->id)}}">Editar</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $('#table').DataTable();
    </script>

@endsection
