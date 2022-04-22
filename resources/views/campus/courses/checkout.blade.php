@extends('layouts.campus')

@section('content')
    <div class="container-md mt-3 col-md-7 mb-5" >
        <div class="card">
            <div class="card-header">Comprar Curso - {{$course->title}}</div>
            <div class=" d-flex justify-content-between  col-md-12">
                <div class="left p-3">
                    <h2>Finalizar Compra</h2>
                    <p>Seus Créditos: {{\Illuminate\Support\Facades\Auth::user()->wallet->credits}}</p>
                    <p><b>Valor do Curso: {{$course->price}}</b></p>
                    @if(\Illuminate\Support\Facades\Auth::user()->wallet->credits < $course->price)
                        <div class="alert alert-warning">Você não possui créditos suficientes, deseja comprar {{$course->price - \Illuminate\Support\Facades\Auth::user()->wallet->credits }} créditos agora?</div>
                        <a class="btn btn-success w-100 btn-add-cart">Comprar</a>
                        <input type="hidden" id="necessary_credits" value="{{$course->price - \Illuminate\Support\Facades\Auth::user()->wallet->credits }}">
                 \   @else
                        <a class="btn btn-success w-100 btn-buy">Comprar</a>
                    @endif


                </div>
                <div class="rigth d-flex align-items-center">
                    <img  src="{{asset('storage/courses/'.$course->image)}}" style="max-width: 500px; border-radius: 7px;" alt="">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('.btn-add-cart').click(function(e) {
                const credits = $('#necessary_credits').val();

                $.ajax({
                    url: '{{route('add-to-cart')}}',
                    type: 'POST',
                    data: {
                        credits: credits
                    },
                    success: function(e) {

                        if(e.status == 1) {
                            toastr.success('Produto Adicionado com sucesso');
                            return window.location.href = "/pay/checkout";
                        }

                        return window.location.href = "/pay/checkout";
                    },
                    error: function (e) {
                        return alert('erro');
                    }
                });

            });

            $('.btn-buy').on('click', function() {
                $.ajax({
                    url: '{{route('post-join-course')}}',
                    type: 'POST',
                    data: {
                        course_id: {{$course->id}}
                    },
                    success: function(e) {
                        toastr.success('Compra realizada com sucesso');
                        return window.location.href = "/course/buy/greetings";
                    },
                    error: function (e) {
                        return toastr.error(e.message);
                    }
                });
            });
        })
    </script>
@endsection
