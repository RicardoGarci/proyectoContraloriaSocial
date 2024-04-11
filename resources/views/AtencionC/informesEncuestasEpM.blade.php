@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title"> <i class="ri-pie-chart-fill"></i> Informe de Encuesta Evaluar para Mejorar
                            </h4>
                        </div>

                    </div>
                </div>
                <h4 style="text-align: center"><strong> Encuestas aplicadas: {{ $total }} </strong></h4>

                @if ($promedio > 0 and $promedio <= 4)
                    <h4 style="text-align: center;">Satisfacción: <strong style="color: red;"> NO SATISFACTORIO</strong></h4>
                @elseif($promedio >= 5 and $promedio <= 7)
                    <h4 style="text-align: center;"> Satisfacción: <strong>REGULAR </strong></h4>
                @elseif($promedio >= 8 and $promedio <= 10)
                    <h4 style="text-align: center;"> Satisfacción: <strong style="color: green;"> SATISFACTORIO </strong>
                    </h4>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div align="right">
                                    <a type="button" class="btn btn-success"
                                        href="{{ route('programacion_evaluaciones.show', '1' . $id) }}">
                                        <i class="ri-todo-line"></i><span> Ver encuestas</span>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="datatable-municipios-preview">
                                            <table class="table mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Pregunta</th>
                                                        <th>Resultado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1. ¿A través de qué medio se enteró de los trámites y
                                                            servicios
                                                            que presta esta Dependencia?</td>
                                                        @php
                                                            $cantidadMediosdeDifusion = App\Models\EvaluarparaMejorar::where(
                                                                'pregunta1',
                                                                'MEDIOS DE DIFUSIÓN',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeMediosdeDifusion =
                                                                ($cantidadMediosdeDifusion * 100) / $total;

                                                            $cantidadModuloInformacion = App\Models\EvaluarparaMejorar::where(
                                                                'pregunta1',
                                                                'EN EL MÓDULO DE INFORMACIÓN',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeModuloInformacion =
                                                                ($cantidadModuloInformacion * 100) / $total;

                                                            $registrosNoDeseados = [
                                                                'MEDIOS DE DIFUSIÓN',
                                                                'EN EL MÓDULO DE INFORMACIÓN',
                                                            ];
                                                            $cantidadOtro = App\Models\EvaluarparaMejorar::whereNotIn(
                                                                'pregunta1',
                                                                $registrosNoDeseados,
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeOtro = ($cantidadOtro * 100) / $total;
                                                        @endphp
                                                        <td style="min-width: 200px;">
                                                            <span>MEDIOS DE DIFUSIÓN - </span>
                                                            <span
                                                                class="progress-value fw-bold">{{ $cantidadMediosdeDifusion }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width:{{ $porcentajeMediosdeDifusion }}%;">
                                                                </div>
                                                            </div>
                                                            <span>MÓDULO DE INFORMACIÓN</span>
                                                            <span
                                                                class="progress-value fw-bold">{{ $cantidadModuloInformacion }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width:{{ $porcentajeModuloInformacion }}%;">
                                                                </div>
                                                            </div>
                                                            <span>OTRO</span>
                                                            <span class="progress-value fw-bold"> {{ $cantidadOtro }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width:{{ $porcentajeOtro }}%;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $preguntas = [
                                                        '2. ¿Identificó fácilmente las diferentes áreas de atención?',
                                                        '3. ¿Considera que en algún momento fue discriminado por parte de la Institución?',
                                                        '4. ¿Las instalaciones cuentan con los servicios y condiciones necesarios para brindar una buena atención?',
                                                        '5. En la atención brindada, ¿se respetó el horario de atención?',
                                                        '6. ¿Cómo se siente con respecto al tiempo que invirtió para realizar su trámite o servicio?',
                                                        '7. ¿Durante el desarrollo del trámite o servicio existió algún retraso?',
                                                        '8. ¿La persona servidora pública respetó los turnos para la atención?',
                                                        '9. ¿Le solicitaron algún requisito o cobro no exhibido?',
                                                        '10. ¿El servidor público a cambio de brindarle su atención, le insinuó o solicitó de forma directa algún tipo de beneficio, entre estos (dinero, regalos o favor)?',
                                                        '11. ¿Algún gestor o tercera persona, para agilizar el trámite, servicio o atención de la o el servidor público, le insinuó o solicitó de forma directa algún tipo de beneficio, entre estos (dinero, regalos o favor)?',
                                                        '12. ¿Se siente satisfecho con el desempeño de la persona servidora pública?',
                                                        '13. ¿El trámite o servicio que realizó fue satisfactorio?',
                                                    ];
                                                    
                                                    $respuestas = ['pregunta2', 'pregunta3', 'pregunta4', 'pregunta5', 'pregunta6', 'pregunta7', 'pregunta8', 'pregunta9', 'pregunta10', 'pregunta11', 'pregunta12', 'pregunta13'];
                                                    ?>
                                                    @foreach ($respuestas as $index => $respuesta)
                                                        <tr>
                                                            <td>{{ $preguntas[$index] }}</td>
                                                            @php
                                                                $cantidadSi = App\Models\EvaluarparaMejorar::where(
                                                                    function ($query) use ($respuesta) {
                                                                        $query
                                                                            ->where($respuesta, 'LIKE', '%SI%')
                                                                            ->orWhere($respuesta, 'SATISFECHO');
                                                                    },
                                                                )
                                                                    ->where('id_programacion_fk', $id)
                                                                    ->count();
                                                                $porcentajeSi = ($cantidadSi * 100) / $total;

                                                                $cantidadNo = App\Models\EvaluarparaMejorar::where(
                                                                    function ($query) use ($respuesta) {
                                                                        $query
                                                                            ->where($respuesta, 'NO')
                                                                            ->orWhere($respuesta, 'INSATISFECHO');
                                                                    },
                                                                )
                                                                    ->where('id_programacion_fk', $id)
                                                                    ->count();
                                                                $porcentajeNo = ($cantidadNo * 100) / $total;
                                                            @endphp
                                                            <td style="min-width: 200px;">
                                                                @if ($respuestas[$index] ==='pregunta6')
                                                                    <span>SATISFECHO - </span>
                                                                @else
                                                                    <span>SI - </span>
                                                                @endif
                                                                <span class="progress-value fw-bold"> {{ $cantidadSi }}
                                                                </span>
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{ $porcentajeSi }}%;"></div>
                                                                </div>
                                                                @if ($respuestas[$index] ==='pregunta6')
                                                                    <span>INSATISFECHO - </span>
                                                                @else
                                                                    <span>NO - </span>
                                                                @endif
                                                                <span class="progress-value fw-bold"> {{ $cantidadNo }}
                                                                </span>
                                                                <div class="progress progress-lg">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{ $porcentajeNo }}%;"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td>14. Derivado de la atención recibida desea interponer:</td>
                                                        @php
                                                            $cantidadQueja = App\Models\EvaluarparaMejorar::where(
                                                                'pregunta14',
                                                                'LIKE',
                                                                '%QUEJA%',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeQueja = ($cantidadQueja * 100) / $total;

                                                            $cantidadDenuncia = App\Models\EvaluarparaMejorar::where(
                                                                'pregunta14',
                                                                'LIKE',
                                                                '%DENUNCIA%',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeDenuncia = ($cantidadDenuncia * 100) / $total;

                                                            $cantidadNinguna = App\Models\EvaluarparaMejorar::where(
                                                                'pregunta14',
                                                                'NINGUNA',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeNinguna = ($cantidadNinguna * 100) / $total;
                                                        @endphp
                                                        <td style="min-width: 200px;">
                                                            <span>Queja - </span>
                                                            <span class="progress-value fw-bold">{{ $cantidadQueja }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width:{{ $porcentajeQueja }}%;"></div>
                                                            </div>
                                                            <span>Denuncia - </span>
                                                            <span class="progress-value fw-bold">{{ $cantidadDenuncia }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width:{{ $porcentajeDenuncia }}%;"></div>
                                                            </div>
                                                            <span>Ninguna - </span>
                                                            <span class="progress-value fw-bold">{{ $cantidadNinguna }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width:{{ $porcentajeNinguna }}%;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
