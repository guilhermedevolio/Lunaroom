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
        <ul class="nav nav-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-home-9" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                    Alunos</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-profile-9" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                    Admins</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active" id="tabs-home-9">
                    <h2>Alunos</h2>
                    <div class="table-responsive">
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
                            @foreach($users["users"] as $user)
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
                <div class="tab-pane" id="tabs-profile-9">
                    <h2>Administradores</h2>
                    <div class="table-responsive">
                        <table id="table-2" class="table table-vcenter card-table">
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
                            @foreach($users["admins"] as $user)
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
            </div>
        </div>
    </div>
    <script>
        $('#table').DataTable();
        $('#table-2').DataTable();
    </script>
@endsection
