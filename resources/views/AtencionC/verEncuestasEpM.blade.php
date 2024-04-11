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
                                                        <td>{{ $dato->id_evaluacion }}</td>
                                                        <td>{{ $dato->name }}</td>
                                                        <td>{{ $dato->created_at }}</td>
                                                        <td><a title="Ver" type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalVer{{ $dato->id_evaluacion }}">
                                                                <i class="ri-task-fill"></i>
                                                            </a>
                                                            @if (Auth::user()->administrador())
                                                                <form
                                                                    action="{{ route('programacion_evaluaciones.destroy', $dato->id_evaluacion) }}"
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
                                                    <div id="modalVer{{ $dato->id_evaluacion }}" class="modal fade"
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
                                                                            <label>Sexo</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="sexo" value="{{ $dato->sexo }}"
                                                                                readonly />
                                                                            <br>
                                                                            <label>Tipo</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="tramite_servicio"
                                                                                value="{{ $dato->tramite_servicio }}"
                                                                                readonly />
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
                                                                                class="accordion-collapse collapse show"
                                                                                aria-labelledby="panelsStayOpen-headingOne">
                                                                                <div class="accordion-body">
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">1.
                                                                                        ¿A través de qué medio se enteró de
                                                                                        los trámites y servicios que presta
                                                                                        esta Dependencia?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta1 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">2.
                                                                                        ¿Identificó fácilmente las
                                                                                        diferentes áreas de atención?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta2 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
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
                                                                                    EQUIDAD
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseTwo"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingTwo">
                                                                                <div class="accordion-body">
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">3.
                                                                                        ¿Considera que en algún momento fue
                                                                                        discriminado por parte de la
                                                                                        Institución?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta3 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingThree">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseThree"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseThree">
                                                                                    INSTALACIONES
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseThree"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingThree">
                                                                                <div class="accordion-body">
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">4.
                                                                                        ¿Las instalaciones cuentan con los
                                                                                        servicios y condiciones necesarios
                                                                                        para brindar una buena atención?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta4 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
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
                                                                                    TIEMPO DE ATENCIÓN
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseFour"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingFour">
                                                                                <div class="accordion-body">
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">5.
                                                                                        En la atención brindada, ¿se
                                                                                        respetó el horario de atención?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta5 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">6.
                                                                                        ¿Cómo se siente con respecto al
                                                                                        tiempo que invirtió para realizar su
                                                                                        trámite o servicio?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta6 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">7.
                                                                                        ¿Durante el desarrollo del trámite
                                                                                        o servicio existió algún
                                                                                        retraso?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta7 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">8.
                                                                                        ¿La persona servidora pública
                                                                                        respetó los turnos para la
                                                                                        atención?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta8 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingFive">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseFive"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseFive">
                                                                                    HONESTIDAD
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseFive"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingFive">
                                                                                <div class="accordion-body">
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">9.
                                                                                        ¿Le solicitaron algún requisito o
                                                                                        cobro no exhibido?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta9 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">10.
                                                                                        ¿El servidor público a cambio de
                                                                                        brindarle su atención, le insinuó o
                                                                                        solicitó de forma directa algún tipo
                                                                                        de
                                                                                        beneficio, entre estos (dinero,
                                                                                        regalos o favor)?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta10 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">11.
                                                                                        ¿Algún gestor o tercera persona,
                                                                                        para agilizar el trámite, servicio o
                                                                                        atención de la o el servidor
                                                                                        público, le
                                                                                        insinuó o solicitó de forma directa
                                                                                        algún tipo de beneficio, entre estos
                                                                                        (dinero, regalos o favor)
                                                                                        ?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta11 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingSix">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseSix"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseSix">
                                                                                    AMABILIDAD
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseSix"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingSix">
                                                                                <div class="accordion-body">
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">12.
                                                                                        ¿Se siente satisfecho con el
                                                                                        desempeño de la persona servidora
                                                                                        pública?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta12 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="panelsStayOpen-headingSeven">
                                                                                <button class="accordion-button collapsed"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#panelsStayOpen-collapseSeven"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="panelsStayOpen-collapseSeven">
                                                                                    GRADO DE SATISFACCIÓN
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseSeven"
                                                                                class="accordion-collapse collapse"
                                                                                aria-labelledby="panelsStayOpen-headingSeven">
                                                                                <div class="accordion-body">
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">13.
                                                                                        ¿El trámite o servicio que realizó
                                                                                        fue satisfactorio?</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta13 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <a
                                                                                        class="text-primary fw-bold mb-1 d-block">14.
                                                                                        Derivado de la atención recibida
                                                                                        desea interponer:</a>
                                                                                    <div class="mt-2 ms-3">
                                                                                        <div
                                                                                            class="form-check form-check-inline">
                                                                                            <label
                                                                                                class="form-check-label"><strong>
                                                                                                    {{ $dato->pregunta14 }}
                                                                                                </strong></label>
                                                                                        </div>
                                                                                    </div>
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
