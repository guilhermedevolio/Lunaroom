@extends('layouts.campus')
@section('content')
    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3 justify-content-between">
                <h2 class="" style="font-size: 30px;">Checkout</h2>
                <p>Realize o pagamento com PIX ou Cartão de Crédito</p>
                <div  class="col-md-8 shadow-lg p-3 mb-5 bg-white rounded" >
                    <h2>Resumo do Pedido</h2>
                    <h3>Pacote de {{$totalCartCreditsValue}} créditos</h3>
                    <h3>Valor Total de R$ {{ number_format($paymentValue, 2) }}</h3>
                </div>
                <div class="col-md-3 shadow-lg p-3 mb-5 bg-white rounded" >
                    <h2>Resumo da Compra</h2>
                    <div class="alert alert-success">
                        <h1>R$ {{ number_format($paymentValue, 2) }}</h1>
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
                        <div class="btn btn-success w-100 mt-3 btn-exec-payment" onclick="processPayment()">Continuar</div>
                        <button id="btn-loading" style="display: none" class="btn btn-primary w-100" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Processando Pagamento
                        </button>
                    </div>
                    <div class="ccr_method methods-payment" style="display: none;">
                        <a onclick="resetPayment()" >Voltar</a>
                        <h2>Forma Selecionada: Cartão de Crédito</h2>
                        <div class="row">
                            <div class="pix-left  col-md-6">
                                <img width="200" src="https://i.pinimg.com/originals/51/ba/5c/51ba5cf6a6cf2477e29601662b584818.png" alt="">
                            </div>
                            <div class="pix-rigth  col-md-6">
                                <p>Como pagar com PIX?</p>
                                <p>Informe seus dados abaixo:</p>

                            </div>
                            <form id="form-checkout" >
                                <label class="form-label mt-3">Número do Cartão</label>
                                <input type="text" class="form-control mb-2" name="cardNumber" id="form-checkout__cardNumber" />
                                <label class="form-label">Data de Vencimento</label>
                                <input type="text" class="form-control mb-2" name="cardExpirationDate" id="form-checkout__cardExpirationDate" />
                                <label class="form-label">Titular do Cartão</label>
                                <input type="text" class="form-control mb-2" name="cardholderName" id="form-checkout__cardholderName"/>
                                <label class="form-label">Titular do Cartão</label>
                                <input type="email" class="form-control mb-2" name="cardholderEmail" id="form-checkout__cardholderEmail"/>
                                <label class="form-label">CVV</label>
                                <input type="text" class="form-control mb-2" name="securityCode" id="form-checkout__securityCode" />
                                <label class="form-label">Banco Emissor</label>
                                <select name="issuer" class="form-control mb-2" id="form-checkout__issuer"></select>
                                <label class="form-label">Tipo de Documento</label>
                                <select name="identificationType" class="form-control mb-2" id="form-checkout__identificationType"></select>
                                <label class="form-label">Documento</label>
                                <input type="text" class="form-control mb-2" name="identificationNumber" id="form-checkout__identificationNumber"/>
                                <label class="form-label">Parcelas</label>
                                <select name="installments" class="form-control mb-2" id="form-checkout__installments"></select>
                                <button type="submit" class="form-control btn-success" id="form-checkout__submit">Pagar</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('TEST-ea87f65a-4ff9-4b22-a9e1-0c54d90f5a3c');

        const cardForm = mp.cardForm({
            amount: "{{$paymentValue}}",
            autoMount: true,
            form: {
                id: "form-checkout",
                cardholderName: {
                    id: "form-checkout__cardholderName",
                    placeholder: "Titular do cartão",
                },
                cardholderEmail: {
                    id: "form-checkout__cardholderEmail",
                    placeholder: "E-mail",
                },
                cardNumber: {
                    id: "form-checkout__cardNumber",
                    placeholder: "Número do cartão",
                },
                cardExpirationDate: {
                    id: "form-checkout__cardExpirationDate",
                    placeholder: "Data de vencimento (MM/YYYY)",
                },
                securityCode: {
                    id: "form-checkout__securityCode",
                    placeholder: "Código de segurança",
                },
                installments: {
                    id: "form-checkout__installments",
                    placeholder: "Parcelas",
                },
                identificationType: {
                    id: "form-checkout__identificationType",
                    placeholder: "Tipo de documento",
                },
                identificationNumber: {
                    id: "form-checkout__identificationNumber",
                    placeholder: "Número do documento",
                },
                issuer: {
                    id: "form-checkout__issuer",
                    placeholder: "Banco emissor",
                },
            },
            callbacks: {
                onFormMounted: error => {
                    if (error) return console.warn("Form Mounted handling error: ", error);
                    console.log("Form mounted");
                },
                onSubmit: event => {
                    event.preventDefault();

                    const {
                        paymentMethodId: payment_method_id,
                        issuerId: issuer_id,
                        cardholderEmail: email,
                        amount,
                        token,
                        installments,
                        identificationNumber,
                        identificationType,
                    } = cardForm.getCardFormData();

                    fetch("/process_payment", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            token,
                            issuer_id,
                            payment_method_id,
                            transaction_amount: Number(amount),
                            installments: Number(installments),
                            description: "Descrição do produto",
                            payer: {
                                email,
                                identification: {
                                    type: identificationType,
                                    number: identificationNumber,
                                },
                            },
                        }),
                    });
                },
                onFetching: (resource) => {
                    console.log("Fetching resource: ", resource);

                    // Animate progress bar
                    const progressBar = document.querySelector(".progress-bar");
                    progressBar.removeAttribute("value");

                    return () => {
                        progressBar.setAttribute("value", "0");
                    };
                }
            },
        });
    </script>
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

            $('.btn-exec-payment').hide();
            $('#btn-loading').show();

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
