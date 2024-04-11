@extends('layouts.app')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <center>
                                <h3 class="page-title">ENCUESTA “EVALUAR PARA MEJORAR”</h3>
                            </center>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <form action="{{ route('guardarEvaluarparaMejorar') }}" method="post">
                        @csrf
                        <div class=" mb-3">
                            <label>Oficina</label>
                            <input type="text" class="form-control form-control-sm" maxlength="200" name="oficina" required />
                            <br>
                            <label for="simpleinputSexo" class="form-label">Sexo</label>
                            <select class="form-control" name="sexo">
                                <option value="HOMBRE">HOMBRE</option>
                                <option value="MUJER">MUJER</option>
                            </select>
                            <br>
                            <label for="simpleinputTipo" class="form-label">Tipo</label>
                            <select class="form-control" name="tipo">
                                <option value="TRAMITE">TRAMITE</option>
                                <option value="SERVICIO">SERVICIO</option>
                            </select>
                            <br>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        INFORMACIÓN
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        <a class="text-primary fw-bold mb-1 d-block">1. ¿A través de qué medio se enteró de
                                            los trámites y servicios que presta esta Dependencia?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion1Medios" name="informacion1"
                                                    class="form-check-input" value="MEDIOS DE DIFUSIÓN" required
                                                    onclick="toggleOtroInput(this)">
                                                <label class="form-check-label" for="informacion1Medios">MEDIOS DE
                                                    DIFUSIÓN</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion1Modulo" name="informacion1"
                                                    class="form-check-input" value="EN EL MÓDULO DE INFORMACIÓN" required
                                                    onclick="toggleOtroInput(this)">
                                                <label class="form-check-label" for="informacion1Modulo">EN EL MÓDULO DE
                                                    INFORMACIÓN</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion1Otro" name="informacion1"
                                                    class="form-check-input" value="OTRO: " required
                                                    onclick="toggleOtroInput(this)">
                                                <label class="form-check-label" for="informacion1Otro">OTRO ¿CUÁL?</label>
                                            </div>
                                            <br>
                                            <br>
                                            <div id="otroInput" style="display: none;">
                                                <input type="text" id="otroInputText" name="otroInput"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">2. ¿Identificó fácilmente las
                                            diferentes áreas de atención?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion2Si" name="informacion2"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion2Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion2No" name="informacion2"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion2No">NO</label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        EQUIDAD
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        <a class="text-primary fw-bold mb-1 d-block">3. ¿Considera que en algún momento fue
                                            discriminado por parte de la Institución?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion3Si" name="informacion3"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion3Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion3No" name="informacion3"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion3No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        INSTALACIONES
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        <a class="text-primary fw-bold mb-1 d-block">4. ¿Las instalaciones cuentan con los
                                            servicios y condiciones necesarios para brindar una buena atención?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion4Si" name="informacion4"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion4Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion4No" name="informacion4"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion4No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFour">
                                        TIEMPO DE ATENCIÓN
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingFour">
                                    <div class="accordion-body">
                                        <a class="text-primary fw-bold mb-1 d-block">5. En la atención brindada, ¿se
                                            respetó el horario de atención?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion5Si" name="informacion5"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion5Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion5No" name="informacion5"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion5No">NO</label>
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">6. ¿Cómo se siente con respecto al
                                            tiempo que invirtió para realizar su trámite o servicio?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion6Satisfecho" name="informacion6"
                                                    class="form-check-input" value="SATISFECHO" required>
                                                <label class="form-check-label"
                                                    for="informacion6Satisfecho">SATISFECHO</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion6Insatisfecho" name="informacion6"
                                                    class="form-check-input" value="INSATISFECHO" required>
                                                <label class="form-check-label"
                                                    for="informacion6Insatisfecho">INSATISFECHO</label>
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">7. ¿Durante el desarrollo del trámite
                                            o servicio existió algún retraso?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion7Si" name="informacion7"
                                                    class="form-check-input" value="SI:" required
                                                    onclick="toggleOtroInputDos(this)">
                                                <label class="form-check-label" for="informacion7Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion7No" name="informacion7"
                                                    class="form-check-input" value="NO" required
                                                    onclick="toggleOtroInputDos(this)">
                                                <label class="form-check-label" for="informacion7No">NO</label>
                                            </div>
                                            <br>
                                            <br>
                                            <div id="otroInputDos" style="display: none;">
                                                <input type="text" id="otroInputText" name="otroInputDos"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">8. ¿La persona servidora pública
                                            respetó los turnos para la atención?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion8Si" name="informacion8"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion8Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion8No" name="informacion8"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion8No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFive">
                                        HONESTIDAD
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingFive">
                                    <div class="accordion-body">
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">9. ¿Le solicitaron algún requisito o
                                            cobro no exhibido?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion9Si" name="informacion9"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion9Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion9No" name="informacion9"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion9No">NO</label>
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">10. ¿El servidor público a cambio de
                                            brindarle su atención, le insinuó o solicitó de forma directa algún tipo de
                                            beneficio, entre estos (dinero, regalos o favor)?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion10Si" name="informacion10"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion10Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion10No" name="informacion10"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion10No">NO</label>
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">11. ¿Algún gestor o tercera persona,
                                            para agilizar el trámite, servicio o atención de la o el servidor público, le
                                            insinuó o solicitó de forma directa algún tipo de beneficio, entre estos
                                            (dinero, regalos o favor)?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion11Si" name="informacion11"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion11Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion11No" name="informacion11"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion11No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseSix">
                                        AMABILIDAD
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingSix">
                                    <div class="accordion-body">
                                        <a class="text-primary fw-bold mb-1 d-block">12. ¿Se siente satisfecho con el
                                            desempeño de la persona servidora pública?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion12Si" name="informacion12"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion12Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion12No" name="informacion12"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion12No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseSeven">
                                        GRADO DE SATISFACCIÓN
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingSeven">
                                    <div class="accordion-body">
                                        <a class="text-primary fw-bold mb-1 d-block">13. ¿El trámite o servicio que realizó
                                            fue satisfactorio?</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacionSi13" name="informacion13"
                                                    class="form-check-input" value="SI" required>
                                                <label class="form-check-label" for="informacion12Si">SI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacion13No" name="informacion13"
                                                    class="form-check-input" value="NO" required>
                                                <label class="form-check-label" for="informacion13No">NO</label>
                                            </div>
                                        </div>
                                        <br>
                                        <a class="text-primary fw-bold mb-1 d-block">14. Derivado de la atención recibida
                                            desea interponer:</a>
                                        <div class="mt-2 ms-3">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacionQuejas" name="informacion14"
                                                    class="form-check-input" value="QUEJA: " required>
                                                <label class="form-check-label" for="informacionQuejas">QUEJA</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacionDenuncias" name="informacion14"
                                                    class="form-check-input" value="DENUNCIA: " required>
                                                <label class="form-check-label"
                                                    for="informacionDenuncias">DENUNCIA</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="informacionNinguna" name="informacion14"
                                                    class="form-check-input" value="NINGUNA" required>
                                                <label class="form-check-label" for="informacionNinguna">NINGUNA</label>
                                            </div>
                                            <br>
                                            <br>
                                            <div id="otroInputTres" style="display: none;">
                                                <input type="text" id="otroInputTextTres" name="otroInputTres"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Guardar Respuestas</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function toggleOtroInput(radio) {
            var otroInput = document.getElementById('otroInput');
            if (radio.id === 'informacion1Otro') {
                otroInput.style.display = 'block';
            } else {
                otroInput.style.display = 'none';
            }
        }

        function toggleOtroInputDos(radio) {
            var otroInputDos = document.getElementById('otroInputDos');
            if (radio.id === 'informacion7Si') {
                otroInputDos.style.display = 'block';
            } else {
                otroInputDos.style.display = 'none';
            }
        }
        const quejasRadio = document.getElementById('informacionQuejas');
        const denunciasRadio = document.getElementById('informacionDenuncias');
        const ningunaRadio = document.getElementById('informacionNinguna');
        const otroInputTres = document.getElementById('otroInputTres');

        quejasRadio.addEventListener('click', toggleInput);
        denunciasRadio.addEventListener('click', toggleInput);
        ningunaRadio.addEventListener('click', toggleInput);

        function toggleInput() {
            if (quejasRadio.checked || denunciasRadio.checked) {
                otroInputTres.style.display = 'block';
            } else {
                otroInputTres.style.display = 'none';
            }
        }
    </script>
@endsection
