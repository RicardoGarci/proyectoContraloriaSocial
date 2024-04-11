@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Municipios</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="datatable-municipios-preview">
                                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Municipio</th>
                                                    <th>Región</th>
                                                    <th>Distrito</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($catalogo as $item)
                                                    <tr>
                                                        <td>{{ $item['folio'] }}</td>
                                                        <td>{{ $item['nombre'] }}</td>
                                                        <td>{{ $item['region'] }}</td>
                                                        <td>{{ $item['distrito'] }}</td>
                                                        <td>
                                                            @if (Auth::user()->super() or Auth::user()->administrador())
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditarMunicipio{{ $item['id_municipio'] }}">
                                                                    <i class="ri-file-edit-line"></i>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!--modal editar municipios-->
                                                    <div id="modalEditarMunicipio{{ $item['id_municipio'] }}"
                                                        class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"> Editar Municipio </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <form method="POST"
                                                                    action="{{ route('catalogo_municipios.update', $item['id_municipio']) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class=" mb-3">
                                                                            <label>Folio</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtFolio"
                                                                                placeholder="{{ $item['folio'] }}"
                                                                                maxlength="255" size="10" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Municipio</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtMunicipio"
                                                                                placeholder="{{ $item['nombre'] }}"
                                                                                maxlength="255" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Región</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtRegion"
                                                                                placeholder="{{ $item['region'] }}"
                                                                                maxlength="255" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Distrito</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtDistrito"
                                                                                placeholder="{{ $item['distrito'] }}"
                                                                                maxlength="255" />
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

                                                    <!--modal editar municipios-->
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
