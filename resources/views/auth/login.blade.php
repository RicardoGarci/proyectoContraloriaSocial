<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true">
<style>
    /* img {
        filter: grayscale(100%) brightness(500%);
        padding: 5px;
    } */

    img {
        filter:  brightness(500%);
        padding: 5px;
    }
</style>

<head>
    <meta charset="utf-8" />
    <title>Iniciar Sesión | Honestidad</title>
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
</head>

<body class="authentication-bg" style="background-image: url('imagenes/bg-pattern.png');">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5" >
        <div class="container" >
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header py-6 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="{{ asset('imagenes/logoCSNEW.png') }}" alt="logo"
                                        height="90"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Iniciar Sesión</h4>
                                <p class="text-muted mb-4">Ingrese su dirección de correo electrónico y contraseña para
                                    acceder al panel de administración.</p>
                            </div>


                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Correo electronico</label>
                                    <input class="form-control" type="email" id="email" required=""
                                        placeholder="ejemplo@gmail.com" @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">

                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            @error('password') is-invalid @enderror" name="password" required
                                            autocomplete="current-password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Recordarme</label>
                                    </div>
                                </div>



                                <div class="row mb-0">
                                    <div class="col-md-5 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        {{--  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    <!-- Vendor js -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.min.js') }}"></script>

</body>

</html>
