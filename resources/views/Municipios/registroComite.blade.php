@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            @if ($edicion == 'edicion')
                                <h4 class="page-title">Editar Comité de {{ $municipio }}</h4>
                            @else
                                <h4 class="page-title">Registro del Comité de {{ $municipio }}</h4>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($edicion == 'edicion')
                                    <form method="POST" action="{{ route('comites.update', $id) }}">
                                        @method('PUT')
                                    @else
                                        <form method="POST" action="{{ route('comites.store') }}">
                                @endif
                                @csrf
                                @if ($edicion != 'edicion')
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="municipio"
                                            value="{{ $id }}" hidden>
                                    </div>
                                @endif
                                <h4>FECHAS Y LUGAR DE ACREDITACIÓN</h4> <br>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Nombramiento en el acta de asamblea</label>
                                    <input type="date" class="form-control" name="nombramiento"
                                        @if ($edicion == 'edicion') value="{{ $dato->nombramiento }}" @endif>
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Entrega de acreditación</label>
                                    <input type="date" class="form-control" name="acreditacion"
                                        @if ($edicion == 'edicion') value="{{ $dato->acreditacion }}" @endif>
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Elaboración de acreditación</label>
                                    <input type="date" class="form-control" name="elaboracion"
                                        @if ($edicion == 'edicion') value="{{ $dato->elaboracion_acreditacion }}" @endif>
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Se acreditó en:</label>
                                    <select class="form-control" name="se_acredito">
                                        @if ($edicion == 'edicion')
                                            <option>{{ $dato->acredito_en }}</option>
                                        @endif
                                        <option>Departamento de Capacitación a Municipios</option>
                                        <option>Oficina Regional</option>
                                    </select>
                                </div><br>
                                <h4>REGISTRO DEL COMITÉ</h4> <br>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Se registro en:</label>
                                    <select class="form-control" name="capacito_comite">
                                        @if ($edicion == 'edicion')
                                            <option>{{ $dato->capacito_comite }}</option>
                                        @endif
                                        <option>Departamento de Capacitación a Municipios</option>
                                        <option>Oficina Regional</option>
                                    </select>
                                </div>
                                @if ($edicion == 'edicion')
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Registro Comité</label>
                                        <input type="text" class="form-control" name="reviso"
                                            @if ($edicion == 'edicion') value="{{ $atendio }}" readonly @endif>
                                    </div>

                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Capacito Comité</label>
                                        <select class="form-control" name="capacito">
                                            @if ($edicion == 'edicion')
                                                <option value="{{ $idCapacito }}">{{ $capacito }}</option>
                                            @endif
                                            @foreach ($userAtendio as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Autorizo acreditación</label>
                                        <input type="text" class="form-control" name="autorizo"
                                            @if ($edicion == 'edicion') value="{{ $autorizo }}" readonly @endif>
                                    </div>
                                @endif <br>
                                <h4>OBSERVACIONES</h4> <br>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Acta de asamblea</label>
                                    <input type="text" class="form-control" name="acta_asamblea"
                                        @if ($edicion == 'edicion') value="{{ $dato->acta_asamblea }}" @endif>
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Lista de asistencia</label>
                                    <input type="text" class="form-control" name="lista_asamblea"
                                        @if ($edicion == 'edicion') value="{{ $dato->lista_asistencia }}" @endif>
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Datos del municipio y contralores</label>
                                    <input type="text" class="form-control" name="datos_municipio"
                                        @if ($edicion == 'edicion') value="{{ $dato->datos_municipio }}" @endif>
                                </div>
                                <br>
                                @if ($edicion == 'edicion')
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                @else
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
