@extends('micrositio.appmicrositio')
@section('content')
    <!-- START HERO -->
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-1"></div>
                <div class="col-5">
                    <div class="mt-md-5">
                        <div>
                            <span class="text-10 ms-1">
                                <h3>Sugerencias, comentarios, denuncias y quejas</h3>
                            </span>
                        </div>
                        <h1 class="text">
                            Buzón Ciudadano
                        </h1>


                    </div>
                </div>
                <div class="col-5">
                    <div class="contenedor" >
                        <img class="desplazamiento" src="{{ asset('imagenes/startup.svg') }}" alt=""/>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <!-- END HERO -->
    <!-- START SERVICES -->
    <section class="py-5">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-12">
                    <div class="text">
                        <h2 class="text-center">¿Para qué sirve el Buzón Ciudadano?</h2>
                        <br>
                        <br>
                        <br>
                        <p class="justificado text-muted mt-2">Tes el medio a través del cual, la Secretaría de Honestidad,
                            Transparencia y Función Pública,
                            conoce tus quejas y/o denuncias, inconformidades, sugerencias, reconocimientos y felicitaciones
                            relacionadas con el actuar
                            de los servidores Públicos del Poder Ejecutivo del Estado de Oaxaca.</p>
                    </div>
                    <br>
                    <h2>Queremos escucharte.</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="text p-2 p-sm-3">
                        <div class=" m-auto">
                            <img class="mx-auto d-block" style="width: 30%;" src="{{ asset('imagenes/seguimiento.svg') }}"
                                alt="">
                        </div>
                        <h4 class="text-center mt-3">¿Qué es una queja de trámites y servicios y en qué casos se presentan?
                        </h4>
                        <p class="justificado mt-4 mb-0">Manifestación que realiza el ciudadano respecto del trámite o
                            servicio que presta alguna Dependencia o Entidad de la Administración Púbica Estatal, cuando
                            considera que un servidor público actuó de manera indebida y dicha acción afecta directamente a
                            ti.

                            En este caso el departamento de Atención Ciudadana canalizará tu queja a la Dirección de quejas,
                            Denuncias e Investigaciones de esta Secretaría.

                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 ">
                    <div class="text-center p-2 p-sm-3">
                        <div class=" m-auto">
                            <img class="mx-auto d-block" style="width: 30%;" src="{{ asset('imagenes/formulario.svg') }}"
                                alt="">
                        </div>
                        <h4 class=" text-center mt-3">¿Qué es una denuncia y que puedo denunciar?</h4>
                        <p class="justificado mt-4 mb-0">Medio a través del cual, cualquier particular o servidor público
                            hace del conocimiento de la Secretaría de Honestidad, que un servidor público de alguna
                            dependencia o Entidad de la Administración Púbica Estatal, actuó de manera indebida y afecta a
                            terceras personas.

                            El requisito es un oficio dirigido a la Secretaría de Honestidad, Transparencia y Función
                            Pública, en donde haga del conocimiento los hechos o conductas de las que quiera quejarse o
                            denunciar, para ello deberá expresar los hechos constitutivos de faltas administrativas graves

                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="text-center p-2 p-sm-3">
                        <div class=" m-auto">
                            <img class="mx-auto d-block" style="width: 30%;" src="{{ asset('imagenes/buzon.svg') }}"
                                alt="">
                        </div>
                        <h4 class="text-center mt-3">¿Cuándo presentar un reconocimiento, sugerencia o felicitación?</h4>
                        <p class="justificado mt-4 mb-0">Si la atención que se te dio fue satisfactoria, por el trato
                            recibido por parte de algún servidor público o quieres manifestar una idea, opinión, aporte o
                            propuesta para mejorar el servicio o tramite. Podrás hacerlo en el apartado de reconocimiento
                            sugerencia o comentario nosotros nos encargamos de darlo a conocer.
                        </p>
                    </div>
                </div>
                <div class="text">
                    <br>
                    <br>
                    <br>
                    <h2 class="text-center">Tipos de denuncia.</h2>
                    <br>
                    <br>
                    <br>
                    <p class="justificado text-muted mt-2 jjustificado">Estos son algunos ejemplos de faltas administrativas o actos de
                        corrupción
                        que puedes ser cometidos por servidores públicos o personas físicas y morales que estén vinculadas
                        con
                        actos de gobierno, si has sido víctima o eres testigo de ello, ¡DENUNCIA¡, la autoridad está
                        obligada
                        a guardar en todo momento tu identidad y la Secrecía del asunto, también puedes hacerlo de manera
                        anónima.</p>
                </div>
                <div class="">
                    <div class="text p-2 p-sm-3">
                        <p class="jutificado text-muted"><i class="mdi mdi-card-text "></i>Cuando un servidor público da o recibe una
                        remuneración monetaria, regalos o favor, para hacer su trabajo o dejarlo de hacer.</p>
                        <p class="jutificado text-muted"><i class="mdi mdi-card-text"></i>Realizar actos para
                            beneficio propio o para terceros con los que se tenga una relación personal.</p>
                        <p class=" justificado text-muted"><i class="mdi mdi-card-text"></i>Soborno.</p>
                        <p class="justificado text-muted"><i class="mdi mdi-card-text"></i> Abuso de funciones.</p>
                        <p class="justificado text-muted"><i class="mdi mdi-card-text"></i>Utilización indebida de
                            información.</p>
                        <p class="justificado text-muted"><i class="mdi mdi-card-text"></i>Solicitar un cobro no
                            exhibido.</p>
                    </div>
                </div>




            </div>

        </div>
    </section>
    <!-- END SERVICES -->
@endsection
