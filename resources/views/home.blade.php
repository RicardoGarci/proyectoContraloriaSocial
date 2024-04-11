@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h2 class="page-title">Información General principal</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Total Buzones</h5>
                                <h3 class="mt-3 mb-3">{{ $totBuzones }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Evaluación en proceso</h5>
                                <h3 class="mt-3 mb-3">{{ $evProceso }}</h3>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
