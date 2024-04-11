<!DOCTYPE html>
<html lang="es" data-layout="topnav">

<head>
    <meta charset="utf-8" />
    <title>Sistema de Contraloría Social</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="imagenes/favicon.ico">

    <!-- Theme Config Js -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('js/hyper-config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Datatables css -->
    <link href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    {{-- <link href="{{ asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
     <link href="{{ asset('vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" /> --}}

    <!-- App css -->
    <link href="{{ asset('css/app-modern.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        @if (Auth::user()->departamento == 1)
                            <a href="{{ asset('/home') }}" class="logo-light">
                            @elseif(Auth::user()->departamento == 2)
                                <a href="{{ asset('/home') }}" class="logo-light">
                        @endif
                        <span class="logo-lg">
                            <img src="{{ asset('imagenes/logoCSNEW.png') }}" style="height: 65px;" alt="logo">
                        </span>
                        <span class="logo-sm">
                            <img src="{{ asset('imagenes/logoCSNEW.png') }}" style="height: 65px;" alt="small logo">
                        </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('imagenes/logoCSNEW.png') }}"
                                    style="filter: grayscale(100%) brightness(500%); padding: 5px;" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('imagenes/logoCSNEW.png') }}"
                                    style="filter: grayscale(100%) brightness(500%); padding: 5px;" alt="small logo">
                            </span>
                        </a>

                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Modo Obscuro">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>
                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                </svg>
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ Auth::user()->name }}</h5>
                                <h6 class="my-0 fw-normal">{{ Auth::user()->rol }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bienvenido !</h6>
                            </div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Horizontal Menu Start ========== -->
        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <!-- menu catalogo COMITES -->
                            @if (Auth::user()->departamento == 1 or (Auth::user()->super() or Auth::user()->director()))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#"
                                        id="topnav-dashboards" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-dashboard"></i>Comités <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                        <a class="dropdown-item"
                                            href="{{ route('catalogo_municipios.index') }}">Municipios </a>
                                        <a href="{{ route('comites.index') }}" class="dropdown-item">Comités</a>
                                        <a href="{{ route('resumenAcreditaciones') }}" class="dropdown-item">Resumen
                                            de Acreditaciones</a>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->departamento == 2 or (Auth::user()->super() or Auth::user()->director()))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#"
                                        id="topnav-dashboards" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded=b "false">
                                        <i class="uil-dashboard"></i>Buzón Digital <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                        <a href="{{ route('buzon.index') }}" class="dropdown-item">Buzones</a>
                                        <a href="{{ route('informe_buzones') }}" class="dropdown-item">Informes</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#"
                                        id="topnav-dashboards" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-dashboard"></i>Evaluaciones <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboards">

                                        <a href="{{ route('programacion_evaluaciones.index') }}"
                                            class="dropdown-item">Programación</a>
                                        <a href="{{ route('EvaluarparaMejorar') }}" class="dropdown-item">Evaluar
                                            P/Mejorar</a>
                                        <a href="{{ route('evaluacionDireccionFisica') }}"
                                            class="dropdown-item">Verificación Física</a>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->super() or Auth::user()->administrador())
                                <!-- menu catalogo usuarios -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none"
                                        href="{{ route('catalogo_usuarios.index') }}">
                                        <i class=" ri-contacts-line"></i>Usuarios
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->super())
                                <!-- menu catalogo usuarios -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="/social/logs/">
                                        <i class="ri-bug-line"></i>Log
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ========== Horizontal Menu End ========== -->
        @yield('content')

        <!-- Footer Start -->

    </div>
    </div>


    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>

    <!-- Code Highlight js -->
    {{-- <script src="{{ asset('vendor/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('vendor/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('js/hyper-syntax.js') }}"></script> --}}

    <!-- Datatables js -->
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script> --}}
     <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script> 
     <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script> 
    {{-- <script src="{{ asset('vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>  --}}

    <!-- Datatable Demo Aapp js -->
    <script src="{{ asset('js/pages/demo.datatable-init.js') }}"></script> 

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

</body>

</html>
