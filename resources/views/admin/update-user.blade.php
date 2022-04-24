@extends('layouts.admin')

@section('content')
    <div class="mt-3">
        <h2>Editar Usuário {{$user->name}}</h2>
    </div>
    <div class="card p-3 ">
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
                        <h2>Informações de Cadastro</h2>
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


                </div>
            </form>
        </div>
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

    {{-- Courses --}}
    <div class="card p-3 mt-3" >
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Controle de Acesso</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Adicionar Nova Regra
            </button>

        </div>

    </div>

        {{-- Courses --}}
        <div class="card p-3 mt-3" >
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h2>Gerenciar Cursos</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Adicionar Curso
                </button>

            </div>
            <div class="table-responsive">
                <table id="table" class="table table-vcenter card-table">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Remover</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->courses as $course)
                        <tr id="">
                            <td>{{$course->title}}</td>
                            <td class="text-muted">
                                <a class="btn btn-danger" course-id="{{$course->id}}" id="btn-remove-user-course">Remover</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    {{--  Modal Add Course      --}}

    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Curso - {{$user->name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Curso:</label>
                            <select class="form-select" id="select-course" aria-label="Default select example">
                                <option selected>Selecione uma opção</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="btn-add-course" class="btn btn-primary">Adicionar Curso</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#btn-add-course').click((e) => {
                e.preventDefault();

                $.ajax({
                    url: "{{route('add-course-to-user')}}",
                    method: 'POST',
                    data: {
                        user_id: {{$user->id}},
                        course_id: $("#select-course option:selected").val()
                    },
                    success: function (callback) {
                        toastr.success('Atualizando a página ...', 'O curso foi adicionado com sucesso');
                        setTimeout(() => [
                            window.location.reload()
                        ], 2000);
                    },
                    error: function (callback) {
                        if (callback.responseJSON.errors) {
                            $.each(callback.responseJSON.errors, function (key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error("O usuário já possui o curso informado");
                        }
                    }

                })
            })

            $(document).on("click", "#btn-remove-user-course", function (e) {
                e.preventDefault();
                const course_id = $(this).attr('course-id');

                if (confirm("Certeza que deseja remover o curso " + course_id + " do usuário {{$user->name}} ?")) {
                    $(this).parent().parent().hide();
                    $.ajax({
                        url: "{{route('remove-course-to-user')}}",
                        method: 'DELETE',
                        data: {
                            user_id: "{{$user->id}}",
                            course_id: course_id
                        },
                        success: function (callback) {
                            toastr.success('Curso Removido com sucesso');
                        },
                        error: function (callback) {
                            if (callback.responseJSON.errors) {
                                $.each(callback.responseJSON.errors, function (key, value) {
                                    toastr.error(value);
                                });
                            } else {
                                toastr.error('Erro ao remover curso');
                            }
                        }
                    })
                }

            })
        </script>


        <script>
            $('table').DataTable();
        </script>

@endsection
