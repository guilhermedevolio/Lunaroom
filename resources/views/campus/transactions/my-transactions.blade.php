@extends('layouts.campus')

@section('content')
    <h1 class="mt-5 text-center" style="font-size: 40px">Minha Carteira</h1>
    <p class="text-center">Atividades da sua Carteira </p>
    <h2 class="text-center font-weight-bold">Seus Créditos: {{Auth::user()->wallet->credits}}</h2>

    <!-- Button trigger modal -->
    <a class="text-center">
        <button type="button" class="btn btn-primary mt-3 text-center" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
            Enviar Créditos
        </button>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enviar Créditos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        Ao enviar créditos , não haverá reembolso, a menos que o usuário te devolva o dinheiro
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Valor (Créditos)</label>
                            <input type="number" class="form-control" placeholder="valor (Créditos)" id="amount">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Username do seu amigo</label>
                            <input type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" id="post-transaction">Enviar Transação</button>

                    <button style="display: none;" id="btn-loading-transaction" class="btn btn-success" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Solicitando Transação ...
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#post-transaction').click(function (e) {
            e.preventDefault();

            const value = $('#amount').val();
            const username = $('#username').val();

            $(this).hide();
            $('#btn-loading-transaction').show();

            $.ajax({
                url: "{{route('post-transaction')}}",
                method: 'POST',
                data: {
                    payee_username: username,
                    amount: value
                },
                success: (callback) => {
                    toastr.success('Transação para ' + username + ', Realizada com sucesso no valor de ' + value + ' Créditos');
                    setTimeout(() => {
                        location.reload();
                    }, 2000)
                },
                error: (callback) => {
                    $(this).show();
                    $('#btn-loading-transaction').hide();
                    if (callback.responseJSON.errors) {
                        $.each(callback.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error(callback.responseJSON.msg);
                    }
                }
            });
        })
    </script>

    <div class="card mt-3">
        <ul class="nav nav-tabs navbar-dark text-white shadow" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-home-9" class="nav-link active rounded-0" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    Entradas</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-profile-9" class="nav-link rounded-0" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    Saídas</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active" id="tabs-home-9">
                    <h2>Entradas</h2>
                    <div class="table-responsive">
                        <table id="table" class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>Valor</th>
                                <th>Quem Enviou</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions["receipts"] as $receipt)
                                <tr>
                                    <td>{{$receipt->amount}}</td>
                                    <td class="text-muted">
                                        {{$receipt->walletPayer->user->username}}
                                    </td>
                                    <td class="text-muted"><a class="text-reset">{{$receipt->created_at}}</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tabs-profile-9">
                    <h2>Saídas</h2>
                    <div class="table-responsive">
                        <table id="table-2" class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>Valor</th>
                                <th>Para Quem</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions["transactions"] as $transaction)
                                <tr>
                                    <td>{{$transaction->amount}}</td>
                                    <td class="text-muted">
                                        {{$transaction->walletPayee->user->username}}
                                    </td>
                                    <td class="text-muted"><a
                                            class="text-reset">{{$transaction->created_at}}</a></td>
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
