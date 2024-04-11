@extends('layouts.app')
@section('content')
    @php use Carbon\Carbon; @endphp

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h2 class="page-title">RESUMEN DE ACREDITACIONES</h2>
                            <p class="text-muted font-20 mb-3">
                                Este apartado es un Concentrado de Información de las Acreditaciones de los Comités de
                                Contraloría Social que realizarán los trabajos de supervisión y vigilancia de recursos
                                públicos en sus municipios.
                            </p>
                        </div>
                    </div>
                </div>

                <table id="basic-datatable-primeroCopia" class="table table-bordered table-centered mb-0">
                    <thead class="table-dark ">
                        <tr>
                            <th>Región</th>
                            <th>Total de Comités</th>
                            <th>Total de Integrantes</th>
                            <th>Integrantes Mujeres</th>
                            <th>Integrantes Hombres</th>
                            <th>Hablan lengua indígena</th>
                            <th>Municipios con solo mujeres</th>
                            <th>Municipios con solo hombres</th>
                            <th>Municipios con al menos una mujer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totComites as $itemA)
                            <tr>
                                <td>{{ $itemA['region'] }}</td>
                                <td>{{ $itemA['total'] }}</td>
                                @foreach ($totintegrantes as $itemB)
                                    @if ($itemA['region'] == $itemB['region'])
                                        <td>{{ $itemB['totalIntegrantes'] }}</td>
                                        <td>{{ $itemB['total_mujeres'] }}</td>
                                        <td>{{ $itemB['total_hombres'] }}</td>
                                        <td>{{ $itemB['total_hablan_lengua_indigena'] }}</td>
                                        <td>{{ $itemB['municipios_solo_mujeres'] }}</td>
                                        <td>{{ $itemB['municipios_solo_hombres'] }} </td>
                                        <td>{{ $itemB['municipios_al_menos_una_mujer'] }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="mb-3">
                                <label for="ejercicioAño-select" class="form-label">Año</label>
                                <select class="form-select selectpicker" id="ejercicioAño-select" data-width="auto" style="max-width: 150px;">
                                    <option value="2024">Ejercicio 2024</option>
                                    <option value="2023">Ejercicio 2023</option>
                                    <option value="2022">Ejercicio 2022</option>
                                    <option value="2021">Ejercicio 2021</option>
                                    <option value="2020">Ejercicio 2020</option>
                                </select>
                            </div> --}}

                                <table id="basic-datatable-primero" class="table table-bordered table-centered mb-0">
                                    <thead class="table-dark ">
                                        <tr>
                                            <th>Región</th>
                                            <th>Total de Comités</th>
                                            <th>Total de Integrantes</th>
                                            <th>Integrantes Mujeres</th>
                                            <th>Integrantes Hombres</th>
                                            <th>Hablan lengua indígena</th>
                                            <th>Municipios con solo mujeres</th>
                                            <th>Municipios con solo hombres</th>
                                            <th>Municipios con al menos una mujer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalComites = 0;
                                            $totalIntegrantes = 0;
                                            $totalMujeres = 0;
                                            $totalHombres = 0;
                                            $totalHablanLenguaIndigena = 0;
                                            $totalMunicipiosMujeres = 0;
                                            $totalMunicipiosHombres = 0;
                                            $totalMunipiosAlmenosMujer = 0;
                                            $aux = 0;
                                        @endphp

                                        @foreach ($totComites as $itemA)
                                            @php $aux++; @endphp
                                            <tr>
                                                <td>{{ $itemA['region'] }}</td>
                                                <td>{{ $itemA['total'] }}</td>

                                                @php
                                                    $totalComites += $itemA['total'];
                                                @endphp

                                                @foreach ($totintegrantes as $itemB)
                                                    @if ($itemA['region'] == $itemB['region'])
                                                        @php
                                                            if ($aux == 1) {
                                                                $region = 'COSTA';
                                                            } elseif ($aux == 2) {
                                                                $region = 'CUENCA DEL PAPALOAPAN';
                                                            } elseif ($aux == 3) {
                                                                $region = 'ISTMO';
                                                            } elseif ($aux == 4) {
                                                                $region = 'MIXTECA';
                                                            } elseif ($aux == 5) {
                                                                $region = 'SIERRA DE FLORES MAGÓN';
                                                            } elseif ($aux == 6) {
                                                                $region = 'SIERRA DE JUÁREZ';
                                                            } elseif ($aux == 7) {
                                                                $region = 'SIERRA SUR';
                                                            } elseif ($aux == 8) {
                                                                $region = 'VALLES CENTRALES';
                                                            }
                                                            //$defaultYear = 2023;
                                                            $defaultYear = date('Y');

                                                            $modalIntegrantes = App\Models\IntegrantesComite::ModalIntegrantes(
                                                                $defaultYear,
                                                                $region,
                                                            )->get();
                                                            //;$sqlQuery = $modalIntegrantes->toSql();dd ($sqlQuery);
                                                            $modalMunicipiosMujeres = App\Models\IntegrantesComite::ModalMunicipiosMujer(
                                                                $defaultYear,
                                                                $region,
                                                            )->get();
                                                            $modalMunicipiosHombres = App\Models\IntegrantesComite::ModalMunicipiosHombre(
                                                                $defaultYear,
                                                                $region,
                                                            )->get();
                                                            $modalMunicipiosAlMenosMujer = App\Models\IntegrantesComite::ModalMunicipioAlMenosMujer(
                                                                $defaultYear,
                                                                $region,
                                                            )->get();

                                                        @endphp

                                                        <td>
                                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#modalVerIntegrantes-{{ $aux }}">
                                                                {{ $itemB['totalIntegrantes'] }}
                                                            </a>

                                                            <!-- Modal integrantes -->
                                                            <div class=" no-print modal fade"
                                                                id="modalVerIntegrantes-{{ $aux }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="myLargeModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                                                Directorio de Contralores</h4>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    id="basic-datatable-Integrantes{{ $aux }}"
                                                                                    class="table dt-responsive nowrap w-100">
                                                                                    <thead class="table-dark">
                                                                                        <tr>
                                                                                            <th class="text-center">Región
                                                                                            </th>
                                                                                            <th class="text-center">Distrito
                                                                                            </th>
                                                                                            <th class="text-center">
                                                                                                Municipio</th>
                                                                                            <th class="text-center">
                                                                                                Folio</th>
                                                                                            <th class="text-center">Nombre
                                                                                            </th>
                                                                                            <th class="text-center">Télefono
                                                                                            </th>
                                                                                            <th class="text-center">Celular
                                                                                            </th>
                                                                                            <th class="text-center">Sexo
                                                                                            </th>
                                                                                            <th class="text-center">Lengua
                                                                                                Indigena</th>
                                                                                            <th class="text-center">Correo
                                                                                            </th>
                                                                                            <th class="text-center">Datos
                                                                                                Presidente</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($modalIntegrantes as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item['region'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['distrito'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['nombre'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['folio_comite'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['nombre_completo'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['telefono'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['celular'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['sexo'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['lengua_indigena'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['correo'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['datos_municipio'] }}
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


                                                            <!-- Fin del modal integrantes -->
                                                        </td>
                                                        <td>{{ $itemB['total_mujeres'] }}</td>
                                                        <td>{{ $itemB['total_hombres'] }}</td>
                                                        <td>{{ $itemB['total_hablan_lengua_indigena'] }}</td>

                                                        <td>
                                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#modalVerMunicipiosMujeres-{{ $aux }}">
                                                                {{ $itemB['municipios_solo_mujeres'] }}
                                                            </a>
                                                            <!-- Modal municipiosMujeres -->
                                                            <div class="modal fade"
                                                                id="modalVerMunicipiosMujeres-{{ $aux }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                                                Comités de Contraloría Social conformados
                                                                                solo por Mujeres</h4>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    id="basic-datatable-municipioM{{ $aux }}"
                                                                                    class="table dt-responsive nowrap w-100">
                                                                                    <thead class="table-dark">
                                                                                        <tr>
                                                                                            <th class="text-center">Región
                                                                                            </th>
                                                                                            <th class="text-center">Folio
                                                                                                Del Comité</th>
                                                                                            <th class="text-center">
                                                                                                Municipio</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($modalMunicipiosMujeres as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item['region'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['folio_comite'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['nombre'] }}
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
                                                            <!-- Fin del modal municipiosMujeres -->
                                                        </td>
                                                        <td>
                                                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#modalVerMunicipiosHombres-{{ $aux }}">
                                                                {{ $itemB['municipios_solo_hombres'] }}
                                                            </a>
                                                            <!-- Modal municipios Hombres -->
                                                            <div class="modal fade"
                                                                id="modalVerMunicipiosHombres-{{ $aux }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                                                Comités de Contraloría Social conformados
                                                                                solo por Hombres</h4>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    id="basic-datatable-municipioH{{ $aux }}"
                                                                                    class="table dt-responsive nowrap w-100">
                                                                                    <thead class="table-dark">
                                                                                        <tr>
                                                                                            <th class="text-center">Región
                                                                                            </th>
                                                                                            <th class="text-center">Folio
                                                                                                Del Comité</th>
                                                                                            <th class="text-center">
                                                                                                Municipio</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($modalMunicipiosHombres as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item['region'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['folio_comite'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['nombre'] }}
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
                                                            <!-- Fin del modal municipios Hombres -->
                                                        </td>
                                                        <td>
                                                            <a type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalAlMenosMujer-{{ $aux }}">
                                                                {{ $itemB['municipios_al_menos_una_mujer'] }}
                                                            </a>
                                                            <!-- Modal municipios Al Menos Una Mujer -->
                                                            <div class="modal fade"
                                                                id="modalAlMenosMujer-{{ $aux }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="myLargeModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"
                                                                                id="myLargeModalLabel">Comités de
                                                                                Contraloría Social Conformados con al Menos
                                                                                una Mujer</h4>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    id="basic-datatable-municipioAlMenosM{{ $aux }}"
                                                                                    class="table dt-responsive nowrap w-100">
                                                                                    <thead class="table-dark">
                                                                                        <tr>
                                                                                            <th class="text-center">Región
                                                                                            </th>
                                                                                            <th class="text-center">Folio
                                                                                                Del Comité</th>
                                                                                            <th class="text-center">
                                                                                                Municipio</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($modalMunicipiosAlMenosMujer as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item['region'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['folio_comite'] }}
                                                                                                </td>
                                                                                                <td>{{ $item['nombre'] }}
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
                                                            <!-- Fin del municipios Al Menos Una Mujer -->
                                                        </td>

                                                        @php
                                                            $totalIntegrantes += $itemB['totalIntegrantes'];
                                                            $totalMujeres += $itemB['total_mujeres'];
                                                            $totalHombres += $itemB['total_hombres'];
                                                            $totalHablanLenguaIndigena +=
                                                                $itemB['total_hablan_lengua_indigena'];
                                                            $totalMunicipiosMujeres +=
                                                                $itemB['municipios_solo_mujeres'];
                                                            $totalMunicipiosHombres +=
                                                                $itemB['municipios_solo_hombres'];
                                                            $totalMunipiosAlmenosMujer +=
                                                                $itemB['municipios_al_menos_una_mujer'];
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tr style="font-weight: bold;">
                                        <td>TOTAL</td>
                                        <td>{{ $totalComites }}</td>
                                        <td>{{ $totalIntegrantes }}</td>
                                        <td>{{ $totalMujeres }}</td>
                                        <td>{{ $totalHombres }}</td>
                                        <td>{{ $totalHablanLenguaIndigena }}</td>
                                        <td>{{ $totalMunicipiosMujeres }}</td>
                                        <td>{{ $totalMunicipiosHombres }}</td>
                                        <td>{{ $totalMunipiosAlmenosMujer }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="basic-datatable-segundo" class="table table-bordered table-centered mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th rowspan="2" class="align-middle">Región</th>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <th colspan="2" style="text-align: center;">
                                                    {{ strtoupper(Carbon::create()->month($i)->locale('es')->isoFormat('MMMM')) }}
                                                </th>
                                            @endfor
                                            <th colspan="2" style="text-align: center;">TOTAL</th>
                                        </tr>
                                        <tr>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <th>Comités</th>
                                                <th>Contralores</th>
                                            @endfor
                                            <th>Comités</th>
                                            <th>Contralores</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($comitesMensual as $itemA)
                                            <tr>
                                                <td>{{ $itemA['region'] }}</td>
                                                @php $totalComitesPorMes = 0; @endphp

                                                @for ($i = 1; $i <= 12; $i++)
                                                    <td>{{ $itemA["{$meses[$i]}Comites"] }}</td>
                                                    @php
                                                        $totalComitesPorMes += $itemA["{$meses[$i]}Comites"];
                                                        $contralorParaEsteMes = collect($contraloresMensual)
                                                            ->where('region', $itemA['region'])
                                                            ->first();
                                                    @endphp
                                                    <td>{{ $contralorParaEsteMes["{$meses[$i]}Contralores"] }}</td>
                                                @endfor

                                                <td>{{ $itemA['total_comites'] }}</td>
                                                @php
                                                    $totalContraloresParaEstaRegion = collect($contraloresMensual)
                                                        ->where('region', $itemA['region'])
                                                        ->sum('total_contralores');
                                                @endphp
                                                <td>{{ $totalContraloresParaEstaRegion }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- Agregar la última fila con los totales de comités y contralores por mes --}}
                                    <tr style="font-weight: bold;">
                                        <td>TOTAL</td>
                                        @php
                                            $totalComitesAnual = 0;
                                            $totalContraloresAnual = 0;
                                        @endphp
                                        @foreach ($comitesMensual as $itemA)
                                            @php
                                                $totalComitesAnual += $itemA['total_comites'];
                                            @endphp

                                            @foreach ($contraloresMensual as $itemB)
                                                @if ($itemA['region'] == $itemB['region'])
                                                    @php
                                                        $totalContraloresAnual += $itemB['total_contralores'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endforeach

                                        @for ($i = 1; $i <= 12; $i++)
                                            @php
                                                $totalComitesPorMes = collect($comitesMensual)->sum(
                                                    "{$meses[$i]}Comites",
                                                );
                                                $totalContraloresPorMes = collect($contraloresMensual)->sum(
                                                    "{$meses[$i]}Contralores",
                                                );
                                            @endphp
                                            <td>{{ $totalComitesPorMes }}</td>
                                            <td>{{ $totalContraloresPorMes }}</td>
                                        @endfor
                                        <td>{{ $totalComitesAnual }}</td>
                                        <td>{{ $totalContraloresAnual }}</td>
                                    </tr>
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
        $(document).ready(function() {

            var table = $('#basic-datatable-primeroCopia').DataTable({
                dom: 'Bfrtip', // Agrega los elementos necesarios para los botones
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                }],
                searching: false,
                paging: false,
                info: false
            });
            $('#basic-datatable-primeroCopia').hide();
            $('.dt-buttons').on('click', function() {});

            $('#basic-datatable-primero').DataTable({
                searching: false,
                paging: false,
            });

            $('#basic-datatable-segundo').DataTable({
                scrollY: "550px",
                scrollX: true,
                searching: false,
                paging: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                }]
            });

            for (let i = 1; i <= 8; i++) {
                $("#basic-datatable-Integrantes" + i).DataTable({

                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }]
                });
                $("#basic-datatable-municipioM" + i).DataTable({

                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }]
                });
                $("#basic-datatable-municipioH" + i).DataTable({

                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }]
                });
                $("#basic-datatable-municipioAlMenosM" + i).DataTable({

                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }]
                });
            }
        });
    </script>
@endsection
