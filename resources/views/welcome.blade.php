@extends('micrositio.appmicrositio')
@section('content')
    <!-- Modal veda -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('/imagenes/veda.svg') }}" alt="Veda" style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>

    <!-- fin de modal -->
    <section class="row mt-3 mb-3">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="{{ asset('imagenes/slide1.png') }}"
                            style="filter: grayscale(100%) " alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{ asset('imagenes/slide2.png') }}"
                            style="filter: grayscale(100%) " alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{ asset('imagenes/slide3.png') }}"
                            style="filter: grayscale(100%) " alt="Third slide">
                    </div>
                    {{--  <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{ asset('imagenes/slide4.jpg') }}" style="filter: grayscale(100%) " alt="fourth slide">
                    </div> --}}
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-1"></div>
        </div>
    </section>

    <!-- START FEATURES 2 -->
    <section class="py-5">
        <div class="container">
            <div class="row mt-2 py-5 align-items-center">
                <div class="col-lg-5 col-md-6">
                    <img src="{{ asset('imagenes/logo_social.png') }}" style="filter: grayscale(100%)" class="img-fluid"
                        alt="">
                </div>
                <div class="col-lg-6 offset-md-1 col-md-5">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="ri-contacts-book-line"></i></h1>
                        <h2> <span class="text-success">Directorio</span></h2>
                    </div>
                    <div class="mt-4">
                        <h3 class="fw-normal"><i class="mdi mdi-circle-medium text-primary"></i>Departamento de Capacitación
                            a Municipios</h3>
                        <h4 class="fw-normal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;951 501 50 00 ext. 10192, 11704,
                            10472</h4>
                        <h3 class="fw-normal"><i class="mdi mdi-circle-medium text-primary"></i>Departamento de Seguimiento
                            a Programas Sociales</h3>
                        <h4 class="fw-normal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;951 501 50 00 ext. 11702, 10493,
                            11706, 11703</h4>
                        <h3 class="fw-normal"><i class="mdi mdi-circle-medium text-primary"></i>Departamento de Atención
                            Ciudadana</h3>
                        <h4 class="fw-normal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;951 501 50 00 ext. 10203, 10440</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END FEATURES 2 -->

    <!-- START SERVICES -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="m-auto">
                            <img class="mx-auto d-block" style="width: 30%;" src="{{ asset('imagenes/Acreditacion.svg') }}"
                                alt="">
                        </div>
                        <h4 class="mt-3">ACREDITACIÓN</h4>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/COMITES DE CONTRALORIA SOCIAL 2023.pdf') }}">
                            <span class="text-muted mt-2 mb-0">COMITÉS DE CONTRALORÍA SOCIAL 2023</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/COMITES DE CONTRALORIA SOCIAL 2022.pdf') }}">
                            <span class="text-muted mt-2 mb-0">COMITÉS DE CONTRALORÍA SOCIAL 2022</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/COMITES DE CONTRALORIA SOCIAL 2021.pdf') }}">
                            <span class="text-muted mt-2 mb-0">COMITÉS DE CONTRALORÍA SOCIAL 2021</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/COMITES DE CONTRALORIA SOCIAL 2020.pdf') }}">
                            <span class="text-muted mt-2 mb-0">COMITÉS DE CONTRALORÍA SOCIAL 2020</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/COMITES DE CONTRALORIA SOCIAL 2019.pdf') }}">
                            <span class="text-muted mt-2 mb-0">COMITÉS DE CONTRALORÍA SOCIAL 2019</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="https://www.oaxaca.gob.mx/sctg/wp-content/uploads/sites/40/2016/02/ACREDITACION-DE-COMITES-DE-CONTRALORIA-SOCIAL-2018-1.pdf">
                            <span class="text-muted mt-2 mb-0">COMITÉS DE CONTRALORÍA SOCIAL 2018</span>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="m-auto">
                            <img class="mx-auto d-block" style="width: 30%;"
                                src="{{ asset('imagenes/seguimiento.svg') }}" alt="">
                        </div>
                        <h4 class="mt-3">SEGUIMIENTO A ACCIONES</h4>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/REPORTE DE VIGILANCIA RECIBIDOS 2023.pdf') }}">
                            <span class="text-muted mt-2 mb-0">REPORTE DE VIGILANCIA RECIBIDOS 2023</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/REPORTE DE VIGILANCIA RECIBIDOS 2022.pdf') }}">
                            <span class="text-muted mt-2 mb-0">REPORTE DE VIGILANCIA RECIBIDOS 2022</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/REPORTE DE VIGILANCIA RECIBIDOS 2021.pdf') }}">
                            <span class="text-muted mt-2 mb-0">REPORTE DE VIGILANCIA RECIBIDOS 2021</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/REPORTE DE VIGILANCIA RECIBIDOS 2020.pdf') }}">
                            <span class="text-muted mt-2 mb-0">REPORTE DE VIGILANCIA RECIBIDOS 2020</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/REPORTE DE VIGILANCIA RECIBIDOS 2019.pdf') }}">
                            <span class="text-muted mt-2 mb-0">REPORTE DE VIGILANCIA RECIBIDOS 2019</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="https://www.oaxaca.gob.mx/sctg/wp-content/uploads/sites/40/2016/02/ACREDITACION-DE-COMITES-DE-CONTRALORIA-SOCIAL-2018-1.pdf">
                            <span class="text-muted mt-2 mb-0">REPORTE DE VIGILANCIA RECIBIDOS 2018</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/RESUMEN DE REPORTES RECIBIDOS 2018.pdf') }}">
                            <span class="text-muted mt-2 mb-0">RESUMEN DE REPORTES RECIBIDOS 2018</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="m-auto">
                            <img class="mx-auto d-block" style="width: 30%;" src="{{ asset('imagenes/Talleres.svg') }}"
                                alt="">
                        </div>
                        <h4 class="mt-3">TALLERES</h4>
                        <a target="_blank" class="text-center" href="{{ asset('files/TALLERES IMPARTIDOS 2023.pdf') }}">
                            <span class="text-muted mt-2 mb-0">TALLERES IMPARTIDOS 2023</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/TALLERES IMPARTIDOS 2022.pdf') }}">
                            <span class="text-muted mt-2 mb-0">TALLERES IMPARTIDOS 2022</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/TALLERES IMPARTIDOS 2021.pdf') }}">
                            <span class="text-muted mt-2 mb-0">TALLERES IMPARTIDOS 2021</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/TALLERES IMPARTIDOS 2020.pdf') }}">
                            <span class="text-muted mt-2 mb-0">TALLERES IMPARTIDOS 2020</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/TALLERES IMPARTIDOS 2019.pdf') }}">
                            <span class="text-muted mt-2 mb-0">TALLERES IMPARTIDOS 2019</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="https://www.oaxaca.gob.mx/sctg/wp-content/uploads/sites/40/2016/02/ACREDITACION-DE-COMITES-DE-CONTRALORIA-SOCIAL-2018-1.pdf">
                            <span class="text-muted mt-2 mb-0">TALLERES IMPARTIDOS 2018</span>
                        </a>


                    </div>
                </div>


            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class=" m-auto">
                            <img class="mx-auto d-block" style="width: 30%;"
                                src="{{ asset('imagenes/eje-buzones.png') }}" alt="">
                        </div>
                        <a target="_blank" href="{{ route('buzones') }}">
                            <h4 class="mt-3">BUZONES DE ATENCIÓN CIUDADANA</h4>
                        </a>
                        <a target="_blank" class="text-center" href="{{ asset('files/RESULTADOS 2023.pdf') }}">
                            <span class="text-muted mt-2 mb-0">RESULTADOS 2023</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="m-auto">
                            <img class="mx-auto d-block" style="width: 30%;"
                                src="{{ asset('imagenes/eje-evaluar-para-mejorar.png') }}" alt="">
                        </div>
                        <h4 class="mt-3">EVALUAR PARA MEJORAR</h4>
                        <a target="_blank" class="text-center" href="{{ asset('files/EVALUAR PARA MEJORAR.pdf') }}">
                            <span class="text-muted mt-2 mb-0">EVALUAR PARA MEJORAR</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class="m-auto">
                            <img class="mx-auto d-block" style="width: 30%;" src="{{ asset('imagenes/Talleres.svg') }}"
                                alt="">
                        </div>
                        <h4 class="mt-3">GUIA CONTRALORES LENGUA INDIGENA</h4>
                        <a target="_blank" class="text-center" href="{{ asset('files/MAZATECO ALTA-HUAUTLA.pdf') }}">
                            <span class="text-muted mt-2 mb-0">MAZATECO ALTA-HUAUTLA</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/MIXE ALTA MEDIA-AYUTLA.pdf') }}">
                            <span class="text-muted mt-2 mb-0">MIXE ALTA MEDIA - AYUTLA</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/MIXTECO ALTA 2-TLAXIACO.pdf') }}">
                            <span class="text-muted mt-2 mb-0">MIXTECO ALTA 2 - TLAXIACO</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center" href="{{ asset('files/MIXTECO ALTA 3-HUAJUAPAN.pdf') }}">
                            <span class="text-muted mt-2 mb-0">MIXTECO ALTA 3 - HUAJUAPAN</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/MIXTECO ALTA 3-NOCHIXTLÁN.pdf') }}">
                            <span class="text-muted mt-2 mb-0">MIXTECO ALTA 3 - NOCHIXTLÁN</span>
                        </a>
                        <br>
                        <a target="_blank" class="text-center"
                            href="{{ asset('files/ZAPOTECO DE LA SIERRA JUÁREZ-DIDZA XHIDZA.pdf') }}">
                            <span class="text-muted mt-2 mb-0">ZAPOTECO DE LA SIERRA JUÁREZ - DIDZA XHIDZA</span>
                        </a>
                    </div>
                </div>
    </section>
    <!-- END SERVICES -->

    <!-- START FEATURES 1 -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Guía practica para <span class="text-primary">Contraloras y Contralores Sociales</span>
                        </h3>
                        <p></p>
                        <p></p>
                        <p></p>
                        <embed src="files/GUIA2023.pdf" type="application/pdf" width="100%" height="500px" />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contador de visitas -->
    <div class="text-center">
        Eres la visita numero: {{ $contador }}
    </div>
    <!-- Fin Contador de visitas -->
     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <script>
        // Script para mostrar el modal automáticamente al cargar la página
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    </script>
@endsection
