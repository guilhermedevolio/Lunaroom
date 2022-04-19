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
    </div>
@endsection
