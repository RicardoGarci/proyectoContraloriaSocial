@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Fechas de intervención en Dependencias y Entidades
                                {{ \Carbon\Carbon::now()->year }}</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (Auth::user()->administrador() or Auth::user()->super())
                                    <div align="right">
                                        <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#modalAgregarFecha">
                                            <i class="ri-calendar-event-line"></i><span> Agregar Fecha</span>
                                        </a>

                                        <a type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modalRegistrarTipo">
                                            <i class="ri-pantone-line"></i> <span> Registrar Dependencia y Entidad</span>
                                        </a>
                                    </div><br>
                                @endif
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="datatable-municipios-preview">
                                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Dependencia/Entidad</th>
                                                    <th>Etapa</th>
                                                    <th>Fecha inicio</th>
                                                    <th>Fecha Finalización</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($buzones as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item['nombre_dependecia_programa'] }}</td>
                                                        <td>{{ $item['tipo_intervencion'] }}° etapa</td>
                                                        <td>{{ $item['fecha_inicio'] }}</td>
                                                        <td>{{ $item['fecha_fin'] }}</td>
                                                        <td>
                                                            @if ($item['fecha_fin'] && now()->lt($item['fecha_fin']) and Auth::user()->administrador())
                                                                <a title="Editar" type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditarProgramacion{{ $item['id_programacion'] }}">
                                                                    <i class="ri-file-edit-fill"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('programacion_evaluaciones.destroy', $item['id_programacion']) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="ri-delete-bin-2-fill"></i>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            @if ($item['fecha_fin'] && now()->gt($item['fecha_fin']))
                                                                <a title="Resultados EPM"
                                                                    href="{{ route('resultados_evaluarparaMejorar', $item['id_programacion']) }}"
                                                                    type="button" class="btn btn-primary">
                                                                    <i class=" ri-bar-chart-2-line"></i>
                                                                </a>
                                                                <a title="Resultados VF"
                                                                    href="{{ route('resultados_verificacion', $item['id_programacion']) }}"
                                                                    type="button" class="btn btn-primary">
                                                                    <i class="ri-pie-chart-fill"></i>
                                                                </a>
                                                                @if (is_null($item['informe']))
                                                                    @if (Auth::user()->administrador())
                                                                        <a title="Subir Informe" data-bs-toggle="modal"
                                                                            data-bs-target="#modalEditarProgramacion{{ $item['id_programacion'] }}"
                                                                            type="button" class="btn btn-primary">
                                                                            <i class="ri-task-line"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <a title="Descargar Informe"
                                                                        href="{{ asset('storage/' . $item['informe']) }}"
                                                                        target="_blank" type="button"
                                                                        class="btn btn-primary">
                                                                        <i class="ri-task-line"></i>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!--modal informe -->
                                                    <div id="modalEditarProgramacion{{ $item['id_programacion'] }}"
                                                        class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"> Informe
                                                                        de resultados </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ route('subirInforme', $item['id_programacion']) }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class=" mb-3">
                                                                            <label>Informe</label>
                                                                            <input type="file"
                                                                                class="form-control form-control-sm"
                                                                                name="archivo_informe" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--fin modal informe -->
                                                    <!--modal editar -->
                                                    <div id="modalEditarProgramacion{{ $item['id_programacion'] }}"
                                                        class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"> Editar Programación de encuesta
                                                                        a {{ $item['nombre_dependecia_programa'] }} </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ route('programacion_evaluaciones.update', $item['id_programacion']) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class=" mb-3">
                                                                            <label>Etapa </label>
                                                                            <select class="form-control form-control-sm"
                                                                                name="etapa" id="etapa">
                                                                                <option
                                                                                    value="{{ $item['tipo_intervencion'] }}">
                                                                                    {{ $item['tipo_intervencion'] }}° etapa
                                                                                </option>
                                                                                <option value="1">1° etapa</option>
                                                                                <option value="2">2° etapa</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Fecha de inicio</label>
                                                                            <input type="date"
                                                                                class="form-control form-control-sm"
                                                                                name="fecha_inicio"
                                                                                value="{{ $item['fecha_inicio'] }}" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Fecha de finalización</label>
                                                                            <input type="date"
                                                                                class="form-control form-control-sm"
                                                                                name="fecha_fin"
                                                                                value="{{ $item['fecha_fin'] }}" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Observaciones</label>
                                                                            <textarea name="observaciones" class="form-control form-control-sm">{{ $item['observaciones'] }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--modal editar -->
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- inicioModal de agregar  -->
                                    <div id="modalAgregarFecha" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Agregar Fecha </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('programacion_evaluaciones.store') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class=" mb-3">
                                                            <label>Dependencia/Programa </label>
                                                            <select class="form-control form-control-sm"
                                                                name="txtAgregarRol" id="txtAgregarRol">
                                                                <option value="0">Seleccione una opcion</option>
                                                                <option value="1">Dependencia/Entidad</option>
                                                                <option value="2">Programa Federal</option>
                                                                <option value="3">Programa social</option>
                                                            </select>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <select class="form-control form-control-sm"
                                                                name="txtTipoBuzon" id="txtTipoBuzon">
                                                                <!-- Opciones serán agregadas dinámicamente -->
                                                            </select>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <label>Fecha inicio </label>
                                                            <input type="date" class="form-control form-control-sm"
                                                                name="fecha_inicio" />
                                                        </div>
                                                        <div class=" mb-3">
                                                            <label>Fecha Fin </label>
                                                            <input type="date" class="form-control form-control-sm"
                                                                name="fecha_fin" />
                                                        </div>
                                                        <div class=" mb-3">
                                                            <label>Etapa </label>
                                                            <select class="form-control form-control-sm" name="etapa"
                                                                id="etapa">
                                                                <option value="1">Primera etapa</option>
                                                                <option value="2">Segunda etapa</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- fin  Modal de agregar  -->
                                <!-- inicioModal de resgistrar dependencia/priograma-->
                                <div id="modalRegistrarTipo" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> Registrar Dependencia/Programa </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('registrar_tipo_buzon') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class=" mb-3">
                                                        <label>Tipo </label>
                                                        <select class="form-control form-control-sm" name="txtAgregarTipo"
                                                            id="txtAgregarTipo">
                                                            <option value="1">Dependencia/Entidad</option>
                                                            <option value="2">Programa Federal</option>
                                                            <option value="3">Programa social</option>
                                                        </select>
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label>Nombre de la Dependencia, Programa o Municipio </label>
                                                        <input class="form-control form-control-sm" name="nombre_dpm">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- fin  Modal de resgistrar dependencia/priograma -->
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cronograma {{ \Carbon\Carbon::now()->year }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table mb-0">
                                    <table id='cronograma'>
                                        <thead>
                                            <tr align="center">
                                                <th rowspan="2">
                                                    Actividad
                                                </th>
                                                <th colspan="52">
                                                    Semanas
                                                </th>
                                            </tr>
                                            <tr>
                                                @for ($i = 1; $i <= 52; $i++)
                                                    <th>
                                                        {{ $i }}
                                                    </th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($buzones as $a)
                                                <tr>
                                                    <td>{{ $a->nombre_dependecia_programa }}<br><strong>{{ $a->tipo_intervencion }}°
                                                            etapa</strong></td>

                                                    @php
                                                        $currentYear = \Carbon\Carbon::parse($a->fecha_inicio)->year;
                                                        $currentWeek = \Carbon\Carbon::parse($a->fecha_inicio)
                                                            ->weekOfYear;
                                                        $endOfWeek = \Carbon\Carbon::parse($a->fecha_fin)->endOfWeek()
                                                            ->weekOfYear;
                                                    @endphp
                                                    @for ($i = 1; $i <= 52; $i++)
                                                        @if ($i >= $currentWeek && $i <= $endOfWeek && $currentYear == \Carbon\Carbon::parse($a->fecha_fin)->year)
                                                            @if ($i >= \Carbon\Carbon::parse($a->fecha_inicio)->weekOfYear)
                                                                <td style="background-color: rgb(147, 147, 138);"></td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    @endfor
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#txtAgregarRol').on('change', function() {
                var tipo = $(this).val();

                $.ajax({
                    url: '/social/obtener-tipos-buzon/' + tipo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#txtTipoBuzon').empty();

                        $.each(data, function(key, value) {
                            $('#txtTipoBuzon').append($('<option>', {
                                value: value.id_catalogo_dependencias,
                                text: value.nombre_dependecia_programa,
                            }));
                        });

                        $('#txtTipoBuzon').selectpicker('refresh');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
            $('#txtAgregarRol, #txtTipoBuzon').selectpicker();
        });
    </script>
@endsection
