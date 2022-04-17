@extends('layouts.campus')
@section('content')
    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3 justify-content-between">
                <h2 class="" style="font-size: 30px;">Checkout</h2>
                <p>Realize o pagamento com PIX ou Cartão de Crédito</p>
                <div  class="col-md-8 shadow-lg p-3 mb-5 bg-white rounded" >
                    <h2>Produtos Adicionados</h2>
                </div>
                <div class="col-md-3 shadow-lg p-3 mb-5 bg-white rounded" >
                    <h2>Resumo da Compra</h2>
                    <div class="alert alert-success">
                        <h1>R$ 50,00</h1>
                    </div>
                </div>
            </div>

            <div class="row mt-3 justify-content-between">
                <h2>Formas de Pagamento</h2>

                <div  class="col-md-8 shadow-lg p-3 mb-5 bg-white rounded" >

                    <div class="row formas-pagto">
                        <div class="card forma-pagto-card shadow-lg  bg-white rounded " method="pix" style="width: 15rem; cursor: pointer;">
                            <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                <img width="100" src="https://logospng.org/download/pix/logo-pix-icone-1024.png" alt="">
                                <h2>PIX</h2>
                            </div>
                        </div>
                        <div class="card shadow-lg forma-pagto-card bg-white rounded" method="ccr" style="width: 15rem; margin-left: 5px; cursor: pointer;">
                            <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                <img width="160" src="https://i.pinimg.com/originals/51/ba/5c/51ba5cf6a6cf2477e29601662b584818.png" alt="">
                                <h2>Cartão de Crédito</h2>
                            </div>
                        </div>
                    </div>
                    <div class="pix_method methods-payment" style="display: none;">
                        <a onclick="resetPayment()" >Voltar</a>
                        <h2>Forma Selecionada: PIX</h2>
                        <div class="row">
                            <div class="pix-left  col-md-6">
                                <img width="200" src="https://logospng.org/download/pix/logo-pix-icone-1024.png" alt="">
                            </div>
                            <div class="pix-rigth  col-md-6">
                                <p>Como pagar com PIX?</p>
                                <p>Após finalizar a compra será gerado um QRCode, realize o pagamento por seu banco de preferência</p>
                            </div>
                        </div>
                        <div class="btn btn-success w-100 mt-3" onclick="processPayment()">Continuar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const Payment = {};

        $(function() {

            $('.forma-pagto-card').click(function(e) {

                const method = $(this).attr('method');
                const valid_methods = ['pix', 'ccr'];

                if(!valid_methods.includes(method)) {
                    return alert('Forma de pagamento selecionada inválida');
                }

                $('.formas-pagto').hide(100);
                $("." + method + "_method").show(100);
                Payment.method = method;
            });
        });
        function buyCredits(value) {

        }

        function processPayment() {
            if(Payment.method == undefined || "") {
                return alert('Selecione uma forma de pagamento antes de continuar');
            }

            $.ajax({
                url: "{{route('post-execute-transaction')}}",
                method: 'POST',
                data: {
                    payment_method: Payment.method
                },
                success: (callback) => {
                   if(callback.payment.payment_method === "pix") {
                       return window.location.href = "pix/" + callback.payment.base64payload
                   }
                },
                error: (callback) => {
                    console.log(callback);
                }
            });
        }

        function resetPayment() {
            $('.methods-payment').hide(100);
            $('.formas-pagto').show(100);
            delete Payment.method;
        }
    </script>
@endsection
