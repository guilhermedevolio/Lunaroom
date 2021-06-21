@extends('layouts.campus')

@section('content')
    <div class="container-xl mt-5">
        <h2 class="text-center" style="font-size: 40px">Resgatar Voucher</h2>
        <p class="text-center">Recebeu algum voucher de presente ? Resgate-o aqui</p>
        <div class="card shadow mt-3">
            <form action="" id="form" method="POST">
                <div class="mb-3 p-3">
                    <div class="alert alert-info">Ao resgatar um voucher, ele não será mais válido.</div>
                    <label for="" class="form-label">Voucher</label>
                    <input type="text" name="voucher" class="form-control" placeholder="Voucher">
                    <button type="submit" id="btn-redeem" class="btn btn-success mt-3">Resgatar</button>
                    <button id="btn-loading" style="display: none" class="btn btn-success mt-3" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Validando Voucher
                    </button>
                    <div style="display: none;" id="info" class="alert alert-success mt-3"></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#btn-redeem').on('click', function (event) {
            event.preventDefault();
            const payload = $('#form').serialize();
            $('#btn-redeem').hide();
            $('#btn-loading').show();
            $.ajax({
                url: "{{route('redeem-voucher')}}",
                type: 'POST',
                data: payload,
                success: (callback) => {
                    toastr.success('Voucher Resgatado com sucesso');
                    $('#info').show();
                    $('#info').text('Você recebeu ' + callback.amount + ' Créditos');
                    $('#btn-redeem').show();
                    $('#btn-loading').hide();
                },
                error: (callback) => {
                    $('#info').hide();
                    $('#btn-redeem').show();
                    $('#btn-loading').hide();
                    if (callback.responseJSON.errors) {
                        $.each(callback.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error(callback.responseJSON.msg);
                    }

                }
            })

        });
    </script>
@endsection
