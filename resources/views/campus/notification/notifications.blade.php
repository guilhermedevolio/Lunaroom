@extends('layouts.campus')

@section('content')
    <div class="container-xl">
        <h1 class="text-center mt-5" style="font-size: 40px;">Notificações</h1>
        <p class="text-center">Tudo que acontece na sua conta é relatado aqui</p>
        <div class="card mt-4 shadow p-3">
            <table id="table" class="table table-striped striped cell-border">
                <thead>
                <tr>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <th scope="row">{{$notification->message}}</th>
                        <td>{{date('d-m-Y', strtotime($notification->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$notifications->links()}}
        </div>
    </div>
    <script>$('#table').DataTable()</script>
@endsection
