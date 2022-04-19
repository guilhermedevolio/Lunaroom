@extends('layouts.campus')

@section('content')
    <div class="container-xl">

        <h1 class="mt-5 text-center" style="font-size: 40px">Minhas Compras</h1>
        <p class="text-center">Suas compras da loja aparecem aqui </p>


        <h2>Seus Pedidos</h2>
        <div class="card mt-3 shadow">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ID do Pedido</font></font></th>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descrição</font></font></th>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Situacão</font></font></th>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Forma de Pagamento</font></font></th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userSales as $sale)
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"># {{$sale->id}}</font></font></td>
                                    <td class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                Pacote de {{$sale->credits}} créditos
                                            </font></font></td>
                                    <td class="text-muted"><a href="#" class="text-reset"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                    {{(new \App\Transformers\PaymentTransformer())->friendlyPaymentStatus($sale->status)}}
                                                </font></font></a></td>
                                    <td class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                {{$sale->payment_method}}
                                            </font></font></td>
                                    <td>
                                        <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <button class="btn btn-success" disabled>Sacar</button> </font></font></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{$userSales->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
