@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Encuestas realizadas</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="datatable-municipios-preview">
                                        <table id="basic-datatable" class="table dt-responsive w-100">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Folio</th>
                                                    <th>Realizó</th>
                                                    <th>Fecha de aplicación</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datos as $dato)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $dato->idVerificacionFisica }}</td>
                                                        <td>{{ $dato->name }}</td>
                                                        <td>{{ $dato->created_at }}</td>
                                                        <td><a title="Ver" type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalVer{{ $dato->idVerificacionFisica }}">
                                                                <i class="ri-task-fill"></i>
                                                            </a>
                                                            @if (Auth::user()->administrador())
                                                                <form
                                                                    action="{{ route('programacion_evaluaciones.destroy', $dato->idVerificacionFisica) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="ri-delete-bin-2-fill"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <!--modal ver -->
                                                    <div id="modalVer{{ $dato->idVerificacionFisica }}" class="modal fade"
                                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"> Encuesta aplicada por
                                                                        {{ $dato->name }}</h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="accordion"
                                                                        id="accordionPanelsStayOpenExample">

                                                                        <div class=" mb-3">
                                                                            <label>Oficina</label>
                                                                            <input type="text"
                                                                                value="{{ $dato->oficina }}"
                                                                                class="form-control form-control-sm"
                                                                                readonly name="oficina" />
                                                                            <br>
                                                                            <label>No. de módulo o ventanilla</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="num_modulo"
                                                                                value="{{ $dato->num_modulo }}" readonly />
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingOne">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button" data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseOne"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseOne">
                                                                                    INFORMACIÓN PÚBLICA
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseOne"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingOne">
                                                                                <div class="accordion-body">
                                                                                    <?php
                                                                                    $preguntas = [
                                                                                        '1.¿Existe módulo de información o personal que oriente al usuario para realizar su trámite?',
                                                                                        '2.¿La información que se proporciona es amplia y suficiente respecto al trámite y/o servicio a realizar?',
                                                                                        '3.¿Se encuentran publicados a la vista del usuario, los trámites y/o servicios que ofrece la Dependencia?',
                                                                                        '4.¿Se proporcionan al usuario los diferentes medios de difusión donde puede consultar información publicada por la Dependencia?',
                                                                                        '5.¿Se encuentran señalizadas las diferentes áreas de adscripción de la Dependencia?',
                                                                                        '6.¿Las señalizaciones son claras y visibles para los usuarios en general?',
                                                                                        '7.¿Se encuentra visible el directorio de la Dependencia?',
                                                                                        '8.¿El personal de la Dependencia porta distintivos o gafete para identificarlos?',
                                                                                        '9.¿Menciono el aviso de privacidad para el resguardo de los datos personales?',
                                                                                        '10.¿Ofreció o mencionó los trámites que puede realizar en la Dependencia?',
                                                                                        '11.¿Se desempeña y desarrolla el tema con fluidez y conocimiento?',
                                                                                        '12.¿Al recibir al usuario fue cordial, amable y respetuoso la persona en el servicio público?',
                                                                                        '13.¿Lo hizo esperar mucho tiempo o lo canalizó con otra persona para recibir el servicio y/o trámite requerido?',
                                                                                        '14.¿Atendió el teléfono personal o se distrajo en otra actividad durante el desarrollo de la atención brindada al usuario?',
                                                                                        '15.¿Da algún tipo de trato preferencial al usuario?',
                                                                                        '16.¿Solicitó algún requisito adicional a los establecidos oficialmente?',
                                                                                    ];
                                                                                    
                                                                                    ?>
                                                                                    @foreach ($preguntas as $index => $pregunta)
                                                                                        <a
                                                                                            class="text-primary fw-bold mb-1 d-block">{{ $pregunta }}</a>
                                                                                        <div class="mt-2">
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="customRadio6"><strong>{{ $dato->{'info' . ($loop->index + 1)} }}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingTwo">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button" data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseTwo"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseTwo">
                                                                                    MECANISMOS DE ATENCIÓN
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseTwo"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingTwo">
                                                                                <div class="accordion-body">
                                                                                    <?php
                                                                                    $preguntas = ['1.¿Se encuentra a la vista o se mencionan mecanismos de Contraloría Social para presentar quejas, denuncias o sugerencias?'];
                                                                                    ?>
                                                                                    @foreach ($preguntas as $index => $pregunta)
                                                                                        <a
                                                                                            class="text-primary fw-bold mb-1 d-block">{{ $pregunta }}</a>
                                                                                        <div class="mt-2">
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="customRadio6"><strong>{{ $dato->{'meca' . ($loop->index + 1)} }}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingThree">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button" data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseThree"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseThree">
                                                                                    ACCESIBILIDAD
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseThree"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingThree">
                                                                                <div class="accordion-body">

                                                                                    <?php
                                                                                    $preguntas = ['1.¿Existen mecanismos e instalaciones para el acceso fácil y rápido de los usuarios con capacidades especiales?', '2.¿Las áreas de espera de uso común y servicios están habilitados para brindar condiciones necesarias al usuario?', '3.¿Están proporcionalmente distribuidos los espacios para la atención al usuario?', '4.¿Las instalaciones de la Dependencia se ubican en un lugar accesible y de fácil ubicación?', '5.¿Cuenta con áreas comunes para facilitar la atención al público?'];
                                                                                    ?>
                                                                                    @foreach ($preguntas as $index => $pregunta)
                                                                                        <a
                                                                                            class="text-primary fw-bold mb-1 d-block">{{ $pregunta }}</a>
                                                                                        <div class="mt-2">
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="customRadio6"><strong>{{ $dato->{'access' . ($loop->index + 1)} }}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingFour">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseFour"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseFour">
                                                                                    INFRAESTRUCTURA
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseFour"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingFour">
                                                                                <div class="accordion-body">
                                                                                    <?php
                                                                                    $preguntas = ['1.¿Las instalaciones se encuentran limpias, con insumos para el aseo de manos y gel antibacterial para uso del público en general?', '2.¿Cuenta con salidas de emergencia señalizadas?'];
                                                                                    ?>
                                                                                    @foreach ($preguntas as $index => $pregunta)
                                                                                        <a
                                                                                            class="text-primary fw-bold mb-1 d-block">{{ $pregunta }}</a>
                                                                                        <div class="mt-2">
                                                                                            <div
                                                                                                class="form-check form-check-inline">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="customRadio6"><strong>{{ $dato->{'infra' . ($loop->index + 1)} }}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--modal ver -->
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
