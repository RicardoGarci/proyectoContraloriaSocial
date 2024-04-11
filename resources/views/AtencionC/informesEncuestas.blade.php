@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title"> <i class="ri-pie-chart-fill"></i> Informe de Encuesta de Verificación
                                Física </h4>
                        </div>
                    </div>
                </div>
                <h4 style="text-align: center"> Encuestas aplicadas:<strong> {{ $total }} </strong></h4>
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
                                        href="{{ route('programacion_evaluaciones.show', '2' . $id) }}">
                                        <i class="ri-todo-line"></i><span> Ver encuestas</span>
                                    </a>
                                </div><br>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="datatable-municipios-preview">
                                        <table id="basic-datatable-comites" class="table w-100">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Pregunta</th>
                                                    <th>Resultado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $preguntas = [
                                                    '1. ¿Existe módulo de información o personal que oriente al usuario para realizar su trámite?',
                                                    '2. ¿La información que se proporciona es amplia y suficiente respecto al trámite y/o servicio a realizar?',
                                                    '3. ¿Se encuentran publicados a la vista del usuario, los trámites y/o servicios que ofrece la Dependencia?',
                                                    '4. ¿Se proporcionan al usuario los diferentes medios de difusión donde puede consultar información publicada por la Dependencia?',
                                                    '5. ¿Se encuentran señalizadas las diferentes áreas de adscripción de la Dependencia?',
                                                    '6. ¿Las señalizaciones son claras y visibles para los usuarios en general?',
                                                    '7. ¿Se encuentra visible el directorio de la Dependencia?',
                                                    '8. ¿El personal de la Dependencia porta distintivos o gafete para identificarlos?',
                                                    '9. ¿Menciono el aviso de privacidad para el resguardo de los datos personales?',
                                                    '10. ¿Ofreció o mencionó los trámites que puede realizar en la Dependencia?',
                                                    '11. ¿Se desempeña y desarrolla el tema con fluidez y conocimiento?',
                                                    '12. ¿Al recibir al usuario fue cordial, amable y respetuoso la persona en el servicio público?',
                                                    '13. ¿Lo hizo esperar mucho tiempo o lo canalizó con otra persona para recibir el servicio y/o trámite requerido?',
                                                    '14. ¿Atendió el teléfono personal o se distrajo en otra actividad durante el desarrollo de la atención brindada al usuario?',
                                                    '15. ¿Da algún tipo de trato preferencial al usuario?',
                                                    '16. ¿Solicitó algún requisito adicional a los establecidos oficialmente?',
                                                    '17. ¿Se encuentra a la vista o se mencionan mecanismos de Contraloría Social para presentar quejas, denuncias o sugerencias?',
                                                    '18. ¿Existen mecanismos e instalaciones para el acceso fácil y rápido de los usuarios con capacidades especiales?',
                                                    '19. ¿Las áreas de espera de uso común y servicios están habilitados para brindar condiciones necesarias al usuario?',
                                                    '20. ¿Están proporcionalmente distribuidos los espacios para la atención al usuario?',
                                                    '21. ¿Las instalaciones de la Dependencia se ubican en un lugar accesible y de fácil ubicación?',
                                                    '22. ¿Cuenta con áreas comunes para facilitar la atención al público?',
                                                    '23. ¿Las instalaciones se encuentran limpias, con insumos para el aseo de manos y gel antibacterial para uso del público en general?',
                                                    '24. ¿Cuenta con salidas de emergencia señalizadas?',
                                                ];
                                                $respuestas = ['info1', 'info2', 'info3', 'info4', 'info5', 'info6', 'info7', 'info8', 'info9', 'info10', 'info11', 'info12', 'info13', 'info14', 'info15', 'info16', 'meca1', 'access1', 'access2', 'access3', 'access4', 'access5', 'infra1', 'infra2'];
                                                
                                                ?>
                                                @foreach ($preguntas as $index => $pregunta)
                                                    <tr>
                                                        <td>{{ $pregunta }}</td>
                                                        @php
                                                            $cantidadSi = App\Models\VerificacionFisica::where(
                                                                $respuestas[$loop->index],
                                                                'SI',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeSi = ($cantidadSi * 100) / $total;

                                                            $cantidadNo = App\Models\VerificacionFisica::where(
                                                                $respuestas[$loop->index],
                                                                'NO',
                                                            )
                                                                ->where('id_programacion_fk', $id)
                                                                ->count();
                                                            $porcentajeNo = ($cantidadNo * 100) / $total;
                                                        @endphp
                                                        <td style="min-width: 200px;">
                                                            <span>SI - </span>
                                                            <span class="progress-value fw-bold"> {{ $cantidadSi }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $porcentajeSi }}%;"></div>
                                                            </div>
                                                            <span>NO - </span>
                                                            <span class="progress-value fw-bold"> {{ $cantidadNo }}
                                                            </span>
                                                            <div class="progress progress-lg">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $porcentajeNo }}%;"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
