<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true">

<head>
    <meta charset="utf-8" />
    <title> Contraloría Social | Honestidad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="imagenes/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{ asset('js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('css/app-modern.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .font-head {
            color: #0a0a0a
        }

        .hero__img img {
            position: relative;
            right: -63px;
        }

        .justificado {
            text-align: justify;
        }



        .desplazamiento {

            animation: desplazar 60s linear infinite;
            /* Define la animación */
        }

        @keyframes desplazar {
            0% {
                transform: translateX(0);
                /* Inicio de la animación, sin desplazamiento horizontal */
            }

            50% {
                transform: translateX(200px);
                /* Desplazamiento horizontal a la mitad de la animación */
            }

            100% {
                transform: translateX(0);
                /* Fin de la animación, vuelve al punto de inicio */
            }
        }
    </style>

</head>

<body>

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg py-lg-1 navbar-dark">
        <div class="container">

            <!-- logo -->
            <a class="navbar-brand me-lg-1">
                <img src="{{ asset('imagenes/ConSocial1.svg') }}" style="filter: grayscale(100%) brightness(500%); padding: 5px;" alt="logo" class="logo-dark" height="80" />
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- menus -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <!-- left menu -->
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" purple role="button" aria-haspopup="true"
                            aria-expanded="false" href="{{ route('inicio') }}"><strong>Inicio</strong></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" role="button" aria-haspopup="true"
                            aria-expanded="false" href="{{ route('contraloriasocial') }}"><strong>Contraloria
                                Social</strong></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>Requisitos</strong>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a target="_blank"
                                href="{{ asset('files/REQUISITOS PARA SER INTEGRANTE DEL COMITE DE CONTRALORIA SOCIAL.pdf') }}"
                                class="dropdown-item">Requisitos para ser Integrante del Comité de Contraloría
                                Social</a>
                            <a target="_blank"
                                href="{{ asset('files/REQUISITOS PARA ACREDITAR AL COMITE DE CONTRALORIA SOCIAL  ANTE LA SHTFP.pdf') }}"
                                class="dropdown-item">Requisitos para Acreditar al Comité de la Contraloría Social ante
                                la SHTFP</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>Capacitaciones</strong>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a target="_blank"
                                href="{{ asset('files/CAPACITACIONES A COMITES DE CONTRALORIA SOCIAL.pdf') }}"
                                class="dropdown-item">Promoción de Contraloría Social</a>
                            <a target="_blank" href="{{ asset('files/PROMOCION DE CONTRALORIA SOCIAL.pdf') }}"
                                class="dropdown-item">Capacitación a Comités de Contraloría Social</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" role="button" aria-haspopup="true"
                            aria-expanded="false" href="{{ route('formatos') }}"><strong>Formatos</strong></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" purple role="button" aria-haspopup="true"
                            aria-expanded="false" target="_blank"
                            href="https://sig.oaxaca.gob.mx/prontuario/"><strong>Marco Juridico</strong></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>Buzones</strong>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a target="_blank" href="{{ route('buzones') }}" class="dropdown-item">¿Qué es?</a>
                            <a target="_blank" href="{{ asset('files/BUZONES DE ATENCION CIUDADANA.pdf') }}"
                                class="dropdown-item">información</a>
                            {{-- <a target="_blank"
                                href="{{ asset('files/RESULTADOS BUZONES DE ATENCION CIUDADANA.pdf') }}"
                                class="dropdown-item">Resultados buzones de atención ciudadana
                                2023</a> --}}
                                <a 
                                href="{{ route('veda') }}"
                                class="dropdown-item">Resultados buzones de atención ciudadana
                                2023</a>
                    </li>
                   {{--  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" target="_blank"
                            href="{{ asset('files/RESULTADOS EVALUAR PARA MEJORAR.pdf') }}" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <strong>Resultados 2023</strong>
                            <div class="arrow-down"></div>
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" 
                            href="{{ route('veda') }}" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <strong>Resultados 2023</strong>
                            <div class="arrow-down"></div>
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>Presupuesto ciudadano</strong>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a target="_blank" href="{{ route('presupuesto2023') }}"class="dropdown-item">2023</a>
                            <a href="{{ route('presupuesto2022') }}" class="dropdown-item">2022</a>
                        </div>
                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong>Presupuesto ciudadano</strong>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a  href="{{ route('veda') }}"class="dropdown-item">2023</a>
                            <a href="{{route('veda') }}" class="dropdown-item">2022</a>
                        </div>
                    </li>
                

                <!-- right menu -->
                    <li class="nav-item me-0">
                        <a type="button" class="btn btn-info rounded-pill" href="{{ route('login') }}">
                            <i class="ri-key-fill"></i> Iniciar Sesión
                        </a>
                    </li>
</ul>

            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">

        </div>
    </section>
    <!-- END HERO -->
    <div class="container">
        <p></p>
    </div>
    @yield('content')
    <footer class="bg-dark py-3">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-2">
                    <img src="{{ asset('imagenes/escudooax.png') }}" style="filter:  brightness(200%); "  alt="logo" class="logo-dark"
                        height="40" />
                    <br class="text-muted mt-4">Direccion de Contraloria Social

                    <ul class="social-list list-inline mt-3">
                        <li class="list-inline-item text-center">
                            <a href="https://www.facebook.com/HonestidadGobOax"
                                class="social-list-item border-primary text-primary"><i
                                    class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item text-center">
                            <a href="https://twitter.com/HonestidadOax"
                                class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                        </li>
                    </ul>

                </div>
                <div class="col-1"></div>
                <div class="col-5">
                    <h4>
                        <p class = "text-center">
                            <br> Ciudad Administrativa (Edificio 2 “Rufino Tamayo”, Planta Baja)
                            <br> Carretera Internacional Oaxaca-Istmo, km. 11.5
                            <br> Tlalixtac de Cabrera, Oaxaca C.P. 68270


                        </p>

                    </h4>

                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>

    {{-- <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>

    <!-- Remixicons Icons Demo js -->
    <script src="{{ asset('js/pages/demo.remixicons.js') }}"></script>  --}}
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
</body>

</html>
