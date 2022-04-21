@extends('layouts.admin')

@section('content')
    <div class="container-xl mt-4">
        <h2>Relatório de Vendas</h2>
        <p>Relatorio de Valores Faturados, Cancelados e Pendente de Pagamento</p>
        <button class="btn btn-success">Filtro Avançado</button>
        <div class="row row-deck row-cards mt-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Vendas</font></font></div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Atualizado
                                                Agora</font></font></a>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">{{count($data['sales'])}}</font></font></div>
                        <div class="d-flex mb-2">
                            <div><font style="vertical-align: inherit; color: blue"><font style="vertical-align: inherit;">Qtd de
                                        Vendas</font></font></div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Valor Aprovado</font></font></div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Atualizado
                                                Agora</font></font></a>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">R$ {{ number_format($data['values']['approved_value'],2,",",".")}}</font></font>
                        </div>
                        <div class="d-flex mb-2">
                            <div><font style="vertical-align: inherit; color: green"><font style="vertical-align: inherit;">Valor
                                        Aprovado</font></font></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Valor Pendente</font></font></div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Atualizado
                                                Agora</font></font></a>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">R$ {{ number_format($data['values']['pendent_value'],2,",",".")}}</font></font>
                        </div>
                        <div class="d-flex mb-2">
                            <div><font style="vertical-align: inherit; color: orange"><font style="vertical-align: inherit;">Valor
                                        Pendente</font></font></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Valor Cancelado</font></font></div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false"><font
                                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">Atualizado
                                                Agora</font></font></a>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">R$ {{ number_format($data['values']['canceled_value'],2,",",".")}}</font></font>
                        </div>
                        <div class="d-flex mb-2">
                            <div><font style="vertical-align: inherit; color: red"><font style="vertical-align: inherit;">Valor
                                        Cancelado</font></font></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3" style="height: 49px;" >
                <h2>Status Pagamento</h2>
                <div class="chart-container" style="position: relative; height:40px; width:500px">
                    <canvas id="myChart" ></canvas>
                </div>

            </div>
        </div>
    </div>


    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Valor Cancelado', 'Valor Pago', 'Valor Pendente'],
                datasets: [{
                    label: 'Status de Vendas',
                    data: [{{$data['values']['canceled_value']}}, {{$data['values']['pendent_value']}}, {{$data['values']['canceled_value']}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
