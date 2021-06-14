@extends('layouts.admin')

@section('content')
    <h2 class="mt-3">Gerenciar Cursos</h2>
    <div class="card pt-3">
        <div class="table-responsive p-3">
            <table id="table" class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Preço (Créditos)</th>
                    <th class="w-1"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->title}}</td>
                        <td class="text-muted">
                            {{$course->description}}
                        </td>
                        <td class="text-muted"><a href="#" class="text-reset">{{$course->price}}</a></td>
                        <td>
                            <a href="{{route('edit-course', $course->id)}}">Gerenciar</a>
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
