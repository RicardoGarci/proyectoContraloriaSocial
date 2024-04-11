@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title"> <i class="ri-mail-line"></i> Reporte de buzones</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="datatable-municipios-preview">
                                        <table id="basic-datatable-comites" class="table w-100">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tipo</th>
                                                    <th>Dependencia/Programa</th>
                                                    <th># de buzones</th>
                                                    <th># de comentarios</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($buzones as $buzon)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>

                                                        @switch($buzon->tipo)
                                                            @case(1)
                                                                <td>Dependencia/Entidad</td>
                                                            @break

                                                            @case(2)
                                                                <td>Programa Federal</td>
                                                            @break

                                                            @case(3)
                                                                <td>Programa Social
                                                                </td>
                                                            @break
                                                        @endswitch
                                                        <td>{{ $buzon->nombre_dependecia_programa }}</td>
                                                        <td>{{ $buzon->total_buzones }}</td>
                                                        <td>{{ $buzon->total_comentarios }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Tipo de comentarios</h4>
                                <br>
                                <div dir="ltr">
                                    <div id="donutchart" style="height: 500px;"></div>
                                </div>
                            </div>
                            <!-- end card body-->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Buzones por regiones</h4>
                                <br>
                                <div dir="ltr">
                                    <div id="piechart" style="height: 500px;"></div>
                                </div>
                            </div>
                            <!-- end card body-->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo', 'Cantidad'],
                @foreach ($conteoPorTipo as $tipo)
                    ['{{ $tipo->tipo_comentario }}', {{ $tipo->total }}],
                @endforeach
            ]);

            var options = {
                pieHole: 0.5,
            };
            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Region', 'N° Buzones'],
                @foreach ($conteoPorRegion as $region)
                    ['{{ $region->region }}', {{ $region->total }}],
                @endforeach
            ]);

            var options = {
                legend: 'none',
                pieSliceText: 'label',
                pieStartAngle: 100,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
@endsection
