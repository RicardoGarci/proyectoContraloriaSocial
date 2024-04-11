@extends('micrositio.appmicrositio')
@section('content')
    <section class="row mt-3 mb-3">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="row pb-3 pt-5 align-items-center">
                <div class="col-lg-6 col-md-5">
                    <h3 class="fw-normal">¿Qué es Contraloría Social?</h3>
                    <p class="text-muted mt-3">
                        Conjunto de acciones de vigilancia, seguimiento y verificación que
                        realizan las y los ciudadanos, de manera organizada o independiente,
                        con el propósito de contribuir a que la gestión gubernamental y el
                        manejo de los recursos públicos se realicen en términos de
                        transparencia, eficacia, legalidad y honradez.
                    </p>

                </div>
                <div class="col-lg-5 col-md-6 offset-md-1">
                    <img src="{{asset('imagenes/contraloria_social.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
        <div class="row mt-2 py-5 align-items-center">
            <div class="col-lg-5 col-md-6">
                <img src="{{ asset('imagenes/como_vigilo.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 offset-md-1 col-md-5">
                <h3 class="fw-normal">¿Cómo vigilo?</h3>
                <p class="text-muted mt-3 ">La vigilancia se realiza de manera organizada, objetiva, activa y propositiva,
                    en
                    comunicación con sus autoridades municipales de manera corresponsal, puesto que son quienes proporcionan
                    la información y así se pueda realizar la vigilancia, verificación, y seguimiento de la obra pública y
                    programas sociales, que se ejecutan con recursos públicos.</p>
            </div>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <div class="row mt-2 py-5 align-items-center">
            <div class="text-center">
                <h3 class="fw-normal">¿Cómo se realiza la vigilancia?</h3>
                <p class="text-muted mt-3">Para poder vigilar las obras públicas y programas sociales en tú municipio
                    debes seguir los siguientes pasos:</p>

            </div>
            <div class="center">
                <img src="{{asset('imagenes/pasos_para_vigilar.png')}}" class="img-fluid" alt="">
            </div>
        </div>
        </div>
    </section>
@endsection
