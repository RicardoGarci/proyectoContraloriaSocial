@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title"> <i class="ri-mail-line"></i> BUZON NUMERO {{ $buzon }}</h4>
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
                                                    <th>Tipo</th>
                                                    <th>Seguimiento</th>
                                                    <th>Estatus</th>
                                                    <th>Creado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($todo as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item['tipo_comentario'] }}</td>
                                                        <td>{{ $item['name'] }}</td>
                                                        @switch($item['estatus'])
                                                            @case(0)
                                                                <td style="color:  red">No leido</td>
                                                            @break

                                                            @case(1)
                                                                <td style="color:  blue">Abierto</td>
                                                            @break

                                                            @case(2)
                                                                <td style="color:  green">Turnado
                                                                </td>
                                                            @break

                                                            @case(3)
                                                                <td style="color: green">En proceso</td>
                                                            @break
                                                        @endswitch

                                                        <td>{{ $item['created_at'] }}</td>
                                                        <td>
                                                            @if ($item['tipo_comentario'] == 'Queja y/o denuncia')
                                                                <a title="Formato Queja" type="button"
                                                                    class="btn btn-primary"
                                                                    href="{{ route('formato_queja', $item['id_comentario_buzon']) }})"
                                                                    target="_blank">
                                                                    <i class="ri-article-line"></i>
                                                                </a>
                                                            @else
                                                                <a title="Ver" type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalVer{{ $item['id_comentario_buzon'] }}"
                                                                    onclick="abrirMensaje('{{ route('abrirMensaje', $item['id_comentario_buzon']) }}')">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            @endif
                                                            @if ($item['estatus'] != 2 and $item['estatus'] != 0)
                                                                <a title="Turnada" type="button" class="btn btn-primary"
                                                                    href="{{ route('turnada', $item['id_comentario_buzon']) }}">
                                                                    <i class="ri-arrow-left-right-line"></i>
                                                                </a>
                                                            @endif

                                                            @if ($item['estatus'] != 3 and $item['estatus'] != 0)
                                                                <a title="En proceso" type="button" class="btn btn-primary"
                                                                    href="{{ route('enProceso', $item['id_comentario_buzon']) }}">
                                                                    <i class="ri-refresh-line"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!-- inicioModal para ver buzon-->
                                                    <div id="modalVer{{ $item['id_comentario_buzon'] }}" class="modal fade"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{ $item['tipo_comentario'] }}
                                                                    </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="tramite" class="form-label">Tramite
                                                                            realizado</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item['tramite_realizado'] }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="nombre" class="form-label">Nombre del
                                                                            promovente</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item['nombre'] }}" readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="nombre_sp" class="form-label">Nombre del
                                                                            servidor público que atendió</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item['nombre_servidor'] }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="comentario"
                                                                            class="form-label">Comentario</label>
                                                                        <textarea id="comentario" class="form-control" rows="5" readonly>{{ $item['comentario'] }}</textarea>
                                                                    </div>

                                                                    @if ($item['multimedia'] === null)
                                                                    @else
                                                                        <div class=" mb-3">
                                                                            <label>Multimedia </label>
                                                                            <a href="{{ asset('storage/' . $item['multimedia']) }}"
                                                                                target="_blank" type="button"
                                                                                class="btn btn-primary">Descargar</a>
                                                                        </div>
                                                                    @endif


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div>
                                    <!-- fin  Modal de para ver buzon -->
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

    {{--  <script>
        function redireccionar(url) {
            window.location.href = url;
        }
    </script> --}}
    <script>
        function abrirMensaje(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Maneja la respuesta aquí (puede no ser necesario hacer nada)
                    console.log('Mensaje abierto con éxito');
                },
                error: function(error) {
                    console.error('Error al abrir el mensaje:', error);
                }
            });
        }
    </script>
@endsection
