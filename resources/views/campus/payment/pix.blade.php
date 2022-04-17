
@extends('layouts.campus')
@section('content')
    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3 justify-content-between">
                <h2 class="" style="font-size: 30px;">Pague com PIX</h2>
                <p>Realize o pagamento por PIX</p>
                <p></p>
            </div>
            <img style="width: 200px;" src="data:image/gif;base64,{{$payload['qr_code_image']}}">

        </div>
    </div>

@endsection
