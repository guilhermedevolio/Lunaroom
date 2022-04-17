@extends('layouts.campus')
@section('content')
    <style>
        footer {
            position: fixed;
            height: 60px;
            bottom: 0;
            width: 100%;
        }
    </style>

    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3">
                <h2 class="" style="font-size: 30px;">Comprar Créditos</h2>
                <p>Compre créditos para trocar em produtos da Lunaroom.</p>
                <p>O preço atual do LunaPoint é de: <span style="color: green">  R$ 0,10</span></p>

                <h2>Pacotes de Créditos</h2>
                <hr>
                <div class="row">
                    @foreach($packages as $package)
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h2 class="text-center">{{$package}} Lunapoints</h2>
                                <h3 style="color: green;" class="card-title text-center">R$ {{$package * 0.10}}</h3>
                                <a class="btn btn-success w-100 btn-add-cart" price="{{$package}}">Adicionar no Carrinho</a>
                                <button id="btn-loading" style="display: none"  class="btn btn-primary w-100" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Adicionando ...
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <footer class="navbar-dark">
        <div class="container ">
            <div style="display: flex; justify-content: space-between; align-items: center; height: 60px;">
                <h4 >10 Produtos Adicionados - 300 LunaPoints - R$ 30,00</h4>
                <button class="btn btn-success" >Finalizar Compra</button>
            </div>

        </div>
    </footer>

    <script>
        $(function() {
            $('.btn-add-cart').click(function(e) {
                const value = $(this).attr('price');
                const loadingInput = $(this).parent().find('#btn-loading');
                const btn = $(this);
                $(this).hide(10);
                loadingInput.show();

                $.ajax({
                    url: '{{route('add-to-cart')}}',
                    type: 'POST',
                    data: {
                        credits: value
                    },
                    success: function(e) {

                        if(e.status == 1) {
                            toastr.success('Produto Adicionado com sucesso');
                            loadingInput.hide();
                            return btn.show();
                        }

                        toastr.success('Erro ao adicionar produto');
                    },
                    error: function (e) {
                        return alert('erro');
                    }
                });

            });
        })
    </script>
@endsection
