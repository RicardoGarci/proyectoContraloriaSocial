@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Buzones de Atención Ciudadana</h4>
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
                                            data-bs-target="#modalAgregarBuzon">
                                            <i><svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-mailbox" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" />
                                                    <path d="M12 11v-8h4l2 2l-2 2h-4" />
                                                    <path d="M6 15h1" />
                                                </svg></i> <span> Agregar Buzón</span>
                                        </a>

                                        <a type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modalRegistrarTipo">
                                            <i class="ri-pantone-line"></i> <span> Registrar Dependencia/Programa</span>
                                        </a>
                                    </div><br>
                                @endif
                                        <table id="datatable-buttons" class="table table-striped dt-responsive w-100">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Dependencia/Programa</th>
                                                    <th>Numero de buzón</th>
                                                    <th>Ubicación</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($buzones as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item['nombre_dependecia_programa'] }}</td>
                                                        <td>{{ $item['numero_buzon'] }}</td>
                                                        <td>{{ $item['ubicacion'] }}</td>
                                                        <td>
                                                            @if (Auth::user()->administrador())
                                                                <a title="Editar" type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditarBuzon{{ $item['id_buzon'] }}">
                                                                    <i class="ri-file-edit-line"></i>
                                                                </a>
                                                            @endif
                                                            <a title="QR" type="button"
                                                                href="{{ url('descargar-qr/' . $item['id_buzon']) }}"
                                                                class="btn btn-primary">
                                                                <i class="ri-qr-code-line"></i>
                                                            </a>

                                                            <a title="Ver buzon"
                                                                href="{{ route('buzones_ciudadanos.show', $item['id_buzon']) }}"
                                                                type="button" class="btn btn-primary">
                                                                <i class="ri-inbox-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <!--modal editar municipios-->
                                                    <div id="modalEditarBuzon{{ $item['id_buzon'] }}" class="modal fade"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"> Editar Buzón </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ route('buzon.update', $item['id_buzon']) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class=" mb-3">
                                                                            <label>Numero de buzón</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtFolio"
                                                                                value="{{ $item['numero_buzon'] }}" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Ubicación</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtubicacion"
                                                                                value="{{ $item['ubicacion'] }}" />
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
                                    
                                    <!-- inicioModal de agregar  buzon-->
                                    <div id="modalAgregarBuzon" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Agregar Buzón </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{ route('buzon.store') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class=" mb-3">
                                                            <label>Numero de Buzón</label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="txtBuzon" />
                                                        </div>
                                                        <div class=" mb-3">
                                                            <label>Dependencia/Programa </label>
                                                            <select class="form-control form-control-sm"
                                                                name="txtAgregarRol" id="txtAgregarRol">
                                                                <option value="0">Seleccione una opción</option>
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
                                                            <label>Region </label>
                                                            <select class="form-control form-control-sm" name="region"
                                                                id="region">
                                                                <option value="Costa">Costa</option>
                                                                <option value="Cuenca del Papaloapan">Papaloapan</option>
                                                                <option value="Istmo">Istmo</option>
                                                                <option value="Sierra de Flores Magon">Sierra de Flores
                                                                    Magón</option>
                                                                <option value="Mixteca">Mixteca</option>
                                                                <option value="Sierra de Juarez">Sierra de Juárez</option>
                                                                <option value="Sierra Sur">Sierra Sur</option>
                                                                <option value="Valles Centrales">Valles Centrales</option>
                                                            </select>
                                                        </div>
                                                        <div class=" mb-3">
                                                            <label>Ubicación</label>
                                                            <textarea name="txtUbicacion" class="form-control form-control-sm"></textarea>
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
                                
                                <!-- fin  Modal de agregar buzon -->
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
