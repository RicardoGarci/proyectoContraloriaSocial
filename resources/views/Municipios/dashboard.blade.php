@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h2 class="page-title">Información General</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i
                                        class="mdi mdi-badge-account-horizontal widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Integrantes De Comité</h5>
                                <h3 class="mt-3 mb-3">{{ $integrantesTotal->totalIntegrantes }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i
                                        class="mdi mdi-account-multiple-check widget-icon bg-success-lighten text-success"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Comités Acreditados</h5>
                                <h3 class="mt-3 mb-3">{{ $comitesAcreditados->total }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Comités No Acreditados</h5>
                                <h3 class="mt-3 mb-3">{{ $comitesNoAcreditados->total }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="header-title">Resumen De Acreditaciones</h4>
                                </div>
                                <div id="chart">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var options = {
            series: [{
                name: 'Comites',
                data: {!! json_encode(array_values($comites[0]->toArray())) !!}
            }, {
                name: 'Contralores',
                data: {!! json_encode(array_values($contralores[0]->toArray())) !!}
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '60%',
                    endingShape: 'rounded',
                    borderRadius: 8,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ],
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "total: " + val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
