@extends('layouts.campus')
@section('content')
    <div class="container-xl">
        <div class="container-xl">
            <div class="row mt-3">
                <h2 class="" style="font-size: 30px;">Resumo da Compra</h2>
                <p>Resumo do seu carrinho.</p>
                <hr>
                <h2>Produtos Adicionados</h2>
                @if(count($cartCourses))
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th class="w-1">Remover</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartCourses as $course)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-3"
                                                  style=" width: 100px; background-image: url({{asset('storage/courses/'.$course->image)}})"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{$course->title}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>1</div>
                                    </td>
                                    <td>
                                        <div>R$ {{$course->price}}</div>
                                    </td>
                                    <td class="text-muted" style="color: red !important;">
                                        <i class="fa fa-trash" onclick="removeItemCart({{$course->id}})"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route('store')}}" class=" w-100 btn btn-info">Continuar Comprando</a>
            </div>
            <div class="mt-3">
                <a href="{{route('view-checkout')}}" class=" w-100 btn btn-success">Ir para pagamento</a>
            </div>
        </div>
        @else
            <div class="alert alert-danger">Você não possui nenhum item no carrinho</div>
            <a href="{{route('store')}}" class=" w-100 btn btn-success">Voltar para loja</a>
        @endif

    </div>

    <script>
        function removeItemCart(course_id) {
            $.get({
                url: '/cart/remove/' + course_id,
                type: 'GET',
                success: function () {
                    location.reload();
                }
            });
        }
    </script>
@endsection
