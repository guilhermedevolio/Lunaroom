@extends('layouts.admin')

@section('content')
    <div class="container-xl mt-5">
        <h2>Gerar Voucher de Créditos</h2>
        <div class="alert alert-info">
            Ao gerar um voucher, ele ficará aberto eternamente , até que alguém o resgate
        </div>
        <div class="card p-3">
            <form action="" id="form" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">Valor</label>
                    <input type="number" name="amount" placeholder="Valor" class="form-control">
                    <button type="submit" id="btn-generate-voucher" class="btn btn-success mt-3">Gerar</button>
                </div>
                <div id="voucher" style="display: none;" class="alert alert-success">
                    Voucher Gerado :  <eae style="font-weight: bold" id="voucher_code"></eae>
                </div>
            </form>
        </div>
    </div>
    <style>
        eae{
            id
        }
    </style>
    <script>
        $('#btn-generate-voucher').click(function (e) {
            e.preventDefault();
            const form = $('#form').serialize();

            $.ajax({
                url: "{{route('post-voucher')}}",
                method: 'POST',
                data: form,
                success: function (callback) {
                    toastr.success('Voucher Gerado com sucesso');
                    $('#voucher').show();
                    $('#voucher_code').html(callback.voucher);
                },
                error: function(callback) {
                    console.log(callback);
                }
            })

        })
    </script>
@endsection
