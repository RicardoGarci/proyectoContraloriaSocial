@extends('layouts.app')
@section('content')
    <style>
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            display: none;
        }
    </style>
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Comités</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="basic-datatable-comites" class="table w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Folio</th>
                                            <th>Región</th>
                                            <th>Distrito</th>
                                            <th>Municipio</th>
                                            <th>Fecha Acreditación</th>
                                            <th>Atendido por</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($municipios as $mun)
                                            <tr>
                                                @if (empty($mun->folio_comite))
                                                    <td> S/F</td>
                                                @else
                                                    <td>{{ $mun->folio_comite }}</td>
                                                @endif
                                                <td>{{ $mun->region }}</td>
                                                <td>{{ $mun->distrito }}</td>
                                                <td>{{ $mun->nombre }}</td>
                                                <td>{{ date('Y-m-d', strtotime($mun->fecha_validado)) }}</td>

                                                <td>{{ $mun->name }}</td>

                                                @switch($mun->estatus ?? -1)
                                                    @case(0)
                                                        <td style="color:  orange">Comité registrado</td>
                                                    @break

                                                    @case(1)
                                                        <td style="color:  orange">Comité e integrantes registrados</td>
                                                    @break

                                                    @case(2)
                                                        <td style="color:  orange">Comité y documentación registrados
                                                        </td>
                                                    @break

                                                    @case(3)
                                                        <td style="color: blue">Listo para validar</td>
                                                    @break

                                                    @case(4)
                                                        <td style="color: green">Comité validado</td>
                                                    @break

                                                    @case(5)
                                                        <td style="color: red">Revisar información</td>
                                                    @break

                                                    @default
                                                        <td style="color: red">Sin comite</td>
                                                @endswitch
                                                <td>
                                                    @if (empty($mun->nombramiento))
                                                        <a type="button" class="btn btn-secondary" title="Registrar"
                                                            href="{{ route('crearComite', $mun->id_municipio) }}"><i
                                                                class="ri-quill-pen-line"></i></a>
                                                    @else
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="btn-group d-flex justify-content-center"
                                                                    role="group" aria-label="Grupo de botones 1">
                                                                    <a style="border-color: white;" type="button"
                                                                        class="btn btn-primary" title="Integrantes"
                                                                        href="{{ route('integrantes.show', $mun->id_acreditacion) }}">
                                                                        <i class="ri-team-fill"></i>
                                                                    </a>
                                                                    <a style="border-color: white;" type="button"
                                                                        class="btn btn-primary" title="Documentacion"
                                                                        href="" class="btn btn-info"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#bs-example-modal-lg-{{ $mun->id_acreditacion }}">
                                                                        <i class="ri-folder-open-fill"></i>
                                                                    </a>
                                                                    <a style="border-color: white;" type="button"
                                                                        class="btn btn-primary" title="Ver/Editar"
                                                                        href="{{ route('comites.edit', $mun->id_acreditacion) }}">
                                                                        <i class="ri-eye-fill"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="col">
                                                                <div class="btn-group d-flex justify-content-center"
                                                                    role="group" aria-label="Grupo de botones 2">
                                                                    @if ($mun->estatus == 4)
                                                                        <a style="border-color: white;" type="button"
                                                                            class="btn btn-primary"
                                                                            title="Credenciales Integrantes" target="_blank"
                                                                            href="{{ route('credencial_integrante', $mun->id_acreditacion) }}">
                                                                            <i class="ri-contacts-book-2-line"></i>
                                                                        </a>
                                                                    @endif

                                                                    @if (Auth::user()->administrador())
                                                                        <a style="border-color: white;" type="button"
                                                                            class="btn btn-primary" title="Validar"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal-{{ $mun->id_acreditacion }}">
                                                                            <i class="ri-thumb-up-fill"></i>
                                                                        </a>
                                                                    @endif

                                                                    @if ($mun->estatus != 5 and Auth::user()->administrador())
                                                                        <a style="border-color: white;" type="button"
                                                                            class="btn btn-primary"
                                                                            title="Revisar Información"
                                                                            href="{{ route('revisarComite', $mun->id_acreditacion) }}">
                                                                            <i class="ri-thumb-down-fill"></i>
                                                                        </a>
                                                                    @endif

                                                                    @if ($mun->estatus == 4)
                                                                        <a style="border-color: white;" type="button"
                                                                            class="btn btn-primary" title="Constancia"
                                                                            target="_blank"
                                                                            href="{{ route('constancia_municipio', $mun->id_acreditacion) }}">
                                                                            <i class="ri-profile-line"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- modal documentacion comite-->
                                                        <div class="modal fade"
                                                            id="bs-example-modal-lg-{{ $mun->id_acreditacion }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myLargeModalLabel">
                                                                            Documentación de comité</h4>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-hidden="true"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table class="table table-centered mb-0">
                                                                            <thead class="table-dark">
                                                                                <tr>
                                                                                    <th>Nombre</th>
                                                                                    <th>Archivo</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <div class="modal-body">
                                                                                        <div id='bonito' role="alert"
                                                                                            style="display: none;">
                                                                                            <p id="flash-message"
                                                                                                class="alert alert-info">
                                                                                                {{ session('mensaje') }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="overlay" id="overlay">
                                                                                    </div>
                                                                                    <div class="loader" id="loader">
                                                                                    </div>
                                                                                    <td>Acta de asamblea</td>
                                                                                    @if (empty($mun->archivo_acta))
                                                                                        <td>
                                                                                            <form
                                                                                                id="form_acta_{{ $mun->id_acreditacion }}"
                                                                                                action="{{ route('CSubirDoc', $mun->id_acreditacion) }}"
                                                                                                method="POST"
                                                                                                data-modal-id="bs-example-modal-lg-{{ $mun->id_acreditacion }}"
                                                                                                enctype="multipart/form-data"
                                                                                                style="display: inline-block; vertical-align: middle;">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <input type="text"
                                                                                                    name="tipo"
                                                                                                    value="acta" hidden>
                                                                                                <input type="file"
                                                                                                    id="archivo_acta"
                                                                                                    name="archivo_acta"
                                                                                                    accept=".doc, .docx, .pdf">
                                                                                            </form>
                                                                                        </td>
                                                                                    @else
                                                                                        <td
                                                                                            id="botones_lista_{{ $mun->id_acreditacion }}">
                                                                                            <a type="button"
                                                                                                class="btn btn-primary"
                                                                                                href="{{ asset('storage/' . $mun->archivo_acta) }}"
                                                                                                target="_blank"><i
                                                                                                    class="ri-file-download-line"></i>
                                                                                                Descargar</a>&nbsp;
                                                                                            @if ($mun->estatus != 4 or (Auth::user()->super() or Auth::user()->administrador()))
                                                                                                <form
                                                                                                    action="{{ route('CEliminarDoc', ['id' => '1' . $mun->id_acreditacion]) }}"
                                                                                                    method="post"
                                                                                                    style="display: inline-block; vertical-align: middle;">
                                                                                                    @csrf
                                                                                                    @method('delete')

                                                                                                    <button type="submit"
                                                                                                        class="btn btn-danger"
                                                                                                        onclick="confirmarEliminar()">
                                                                                                        <i
                                                                                                            class="ri-delete-bin-6-line"></i>
                                                                                                        Eliminar
                                                                                                    </button>
                                                                                                </form>
                                                                                            @endif
                                                                                        </td>
                                                                                    @endif
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Lista de asistencia</td>
                                                                                    @if (empty($mun->archivo_lista))
                                                                                        <td>
                                                                                            <form
                                                                                                id="form_lista_{{ $mun->id_acreditacion }}"
                                                                                                action="{{ route('CSubirDoc', $mun->id_acreditacion) }}"
                                                                                                method="POST"
                                                                                                data-modal-id="bs-example-modal-lg-{{ $mun->id_acreditacion }}"
                                                                                                enctype="multipart/form-data"
                                                                                                style="display: inline-block; vertical-align: middle;">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <input type="text"
                                                                                                    name="tipo"
                                                                                                    value="lista" hidden>
                                                                                                <input type="file"
                                                                                                    id="archivo_lista"
                                                                                                    name="archivo_lista"
                                                                                                    accept=".doc, .docx, .pdf">
                                                                                            </form>
                                                                                        </td>
                                                                                    @else
                                                                                        <td><a type="button"
                                                                                                class="btn btn-primary"
                                                                                                href="{{ asset('storage/' . $mun->archivo_lista) }}"
                                                                                                target="_blank"><i
                                                                                                    class="ri-file-download-line"></i>
                                                                                                Descargar</a>&nbsp;
                                                                                            @if ($mun->estatus != 4 or (Auth::user()->super() or Auth::user()->administrador()))
                                                                                                <form
                                                                                                    action="{{ route('CEliminarDoc', ['id' => '2' . $mun->id_acreditacion]) }}"
                                                                                                    method="post"
                                                                                                    style="display: inline-block; vertical-align: middle;">
                                                                                                    @csrf
                                                                                                    @method('delete')

                                                                                                    <button type="submit"
                                                                                                        class="btn btn-danger"
                                                                                                        onclick="confirmarEliminar()">
                                                                                                        <i
                                                                                                            class="ri-delete-bin-6-line"></i>
                                                                                                        Eliminar
                                                                                                    </button>
                                                                                                </form>
                                                                                            @endif
                                                                                        </td>
                                                                                    @endif
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- fin de modal documentacion comite -->


                                                        @if (Auth::user()->administrador())
                                                            <!-- INICIO DEL MODAL DE FECHA DE VALIDACION -->
                                                            <div class="modal fade"
                                                                id="exampleModal-{{ $mun->id_acreditacion }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Validación de comité
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST"
                                                                                action="{{ route('validarComite', $mun->id_acreditacion) }}">
                                                                                @method('PUT')
                                                                                @csrf
                                                                                <div class="mb-3">
                                                                                    <label for="recipient-name"
                                                                                        class="col-form-label">Fecha de
                                                                                        validación:</label>
                                                                                    <input type="date"
                                                                                        class="form-control"
                                                                                        name="fecha_validacion">
                                                                                </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary"> Validar</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- FIN DEL MODAL DE FECHA DE VALIDACION -->
                                                        @endif
                                                    @endif
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

    <!-- Agrega las bibliotecas para exportar a Excel y PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>



    <script>
        function confirmarEliminar() {
            if (confirm('¿Estás seguro de que deseas eliminar este documento?')) {
                document.getElementById('eliminarForm').submit();
            }
        }

        $(document).ready(function() {
            $('#basic-datatable-comites').DataTable({
                scrollX: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                searching: true,
                paging: true,
                info: true,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                }],

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', 'form[id^="form_"] input[type="file"]', function() {
                var form = $(this).closest('form');
                var modalId = form.data('modal-id');
                handleFormSubmission(form, modalId);
            });
        });

        function handleFormSubmission(form, modalId) {
            var formData = new FormData(form[0]);

            $('#' + modalId + ' #overlay').fadeIn();
            $('#' + modalId + ' #loader').fadeIn();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#' + modalId + ' #flash-message').text(
                            '¡El archivo se cargó correctamente! Recarga la página para visualizar los cambios.'
                        );
                        $('#' + modalId + ' #bonito').show();
                    } else {
                        $('#' + modalId + ' #flash-message').text(
                            'Ocurrió un error al tratar de cargar el archivo, por favor intente más tarde.'
                        );
                        $('#' + modalId + ' #bonito').show();
                    }
                },
                error: function(xhr, status, error) {},
                complete: function() {
                    // Ocultar la pantalla de carga
                    $('#' + modalId + ' #overlay').fadeOut();
                    $('#' + modalId + ' #loader').fadeOut();
                    // Ocultar el mensaje flash después de 3 segundos
                    setTimeout(function() {
                        $('#' + modalId + ' #flash-message').empty();
                        $('#' + modalId + ' #bonito').hide();
                    }, 3000);
                }
            });
        }
    </script>


@endsection
