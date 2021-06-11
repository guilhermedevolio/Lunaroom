@extends('layouts.admin')

@section('content')
    <div class="card p-3 mt-5">
        <div class="row">
            <form action="{{route('put-user', $user->id)}}" method="POST">
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

                    <label class="form-label">Cargo no Sistema</label>
                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                        <label class="form-selectgroup-item flex-fill">
                            <input type="radio" {{!$user->admin ? 'checked' : ''}} name="admin" value="{{\App\Enums\UserEnum::ROLE_USER}}"
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
                        <button type="submit" class="btn btn-primary mt-3">Atualizar Dados</button>
                    </div>
                </div>
            </form>
        </div>

@endsection
