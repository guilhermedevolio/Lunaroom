@extends('layouts.admin')

@section('content')
    <h2 class="mt-3 ">Gerenciar Curso - {{$course->title}}</h2>
    <form action="{{route('put-course', $course->id)}}" id="form" method="POST" class="mb-4"
          enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="card p-3">
            <img src="{{asset("storage/courses/$course->image")}}" class="img-fluid w-25 rounded-1 pb-3" alt="">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" value="{{$course->title}}" name="title">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="description" id="" cols="30" rows="10">{{$course->description}}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Preço (Créditos da Plataforma)</label>
                <input type="number" class="form-control" value="{{$course->price}}" name="price">
            </div>

            <div class="mb-3">
                <div class="form-label">Alterar Imagem de Capa</div>
                <input type="file" name="image" class="form-control">
            </div>

            <button id="btn-post" type="submit" class="btn btn-primary mt-3 w-100 mb-3">Atualizar Dados
            </button>
            <a id="btn-delete-course" class="btn btn-danger">Excluir
                Curso</a>
        </div>
    </form>
    <script>
        $('#btn-delete-course').click(function (e) {
            e.preventDefault();
            const assert = confirm('Certeza que deseja excluir o curso ?');

            if (assert) {
                toastr.success('Redirecionando ...', 'Curso Deletado com sucesso')
                setTimeout(() => {
                    location.href = "{{route('delete-course', $course->id)}}"
                }, 3000)
            }


        });
    </script>
    {{-- Modal Add Module    --}}
    <div class="d-flex justify-content-between mb-3">
        <h2 class="mt-3">Gerenciar Módulos</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Cadastrar Módulo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Módulo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label  for="exampleInputEmail1" class="form-label">Nome do Módulo</label>
                                <input id="module_name" type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="btn-post-module" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#btn-post-module').click((e) => {
                e.preventDefault();
                const course_id = "{{$course->id}}";
                const module_name = $('#module_name').val();

                $.ajax({
                    url: "{{route('post-module')}}",
                    method: 'POST',
                    data: {
                        course_id: course_id,
                        name: module_name
                    },
                    success: (callback) => {
                        toastr.success('Atualizado a Página ...', 'Módulo Cadastrado com Sucesso');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);

                    },
                    error: (callback) => {
                        if(callback.responseJSON.errors){
                            $.each(callback.responseJSON.errors, function (key, value) {
                                toastr.error(value);
                            });
                        }else {
                            console.log(callback);
                        }
                    }
                })
            })
        </script>

    </div>
    <div class="card pt-3 mb-3">
        <div class="table-responsive p-3 ">
            <table id="table" class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Gerenciar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course->modules as $module)
                    <tr>
                        <td>{{$module->id}}</td>
                        <td>{{$module->name}}</td>
                        <td><a href="{{route('get-module', $module->id)}}">Gerenciar</a></td>
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
