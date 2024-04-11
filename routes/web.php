<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {return view('welcome');});
Route::get('/', 'App\Http\Controllers\WelcomeController@incrementarContador')->name('inicio');
Route::get('/veda', 'App\Http\Controllers\WelcomeController@veda')->name('veda');

//RUTA DE BUZON CIUDADANO SIN AUTENTIFICACION
Route::resource('/buzones_ciudadanos', 'App\Http\Controllers\ComentariosBuzonesController');

//RUTAS MICROSITIO
Route::view('contraloriasocial', '/micrositio/contraloriasocial')->name('contraloriasocial');
Route::view('formatos', '/micrositio/formatos')->name('formatos');
Route::view('presupuesto2023', '/micrositio/presupuesto2023')->name('presupuesto2023');
Route::view('presupuesto2022', '/micrositio/presupuesto2022')->name('presupuesto2022');
Route::view('buzones', '/micrositio/buzones')->name('buzones');
Auth::routes();

//RUTAS DEL MODULO DEL DEPARTAMENTO DE CAPACITACION A MUNICIPIOS
Route::middleware(['auth', 'departamento:1'])->group(function () {
    Route::resource('/comites', 'App\Http\Controllers\ComitesController');
    Route::get('/registrar_comite/{id}', 'App\Http\Controllers\ComitesController@crearComite')->name('crearComite');
    Route::put('/validar-comite/{id}', 'App\Http\Controllers\ComitesController@validarComite')->name('validarComite');
    Route::get('/revisar_comite/{id}', 'App\Http\Controllers\ComitesController@RevisarInformacion')->name('revisarComite');
    Route::put('/subir_documentacion/{id}', 'App\Http\Controllers\ComitesController@subirDocumentacion')->name('CSubirDoc');
    Route::delete('/eliminar_documentacion/{id}', 'App\Http\Controllers\ComitesController@eliminarDocumentacion')->name('CEliminarDoc');
    Route::resource('/comites', 'App\Http\Controllers\ComitesController');
    Route::resource('/integrantes', 'App\Http\Controllers\IntegrantesComiteController');
    Route::put('/subir_documentacion_integrantes/{id}', 'App\Http\Controllers\IntegrantesComiteController@subirDocumentacionIntegrantes')->name('CSubirDocInt');
    Route::delete('/eliminar_documentacion_integrantes/{id}', 'App\Http\Controllers\IntegrantesComiteController@eliminarDocumentacionIntegrantes')->name('CEliminarDocInt');
    Route::resource('/catalogo_municipios', 'App\Http\Controllers\MunicipioController');
    Route::get('/constancia_municipio/{id}', 'App\Http\Controllers\DocumentacionGeneradaController@constanciaMunicipio')->name('constancia_municipio');
    Route::get('/constancia_integrante/{id}', 'App\Http\Controllers\DocumentacionGeneradaController@constanciaIntegrante')->name('constancia_integrante');
    Route::get('/credencial_integrante/{id}', 'App\Http\Controllers\DocumentacionGeneradaController@credencialIntegrante')->name('credencial_integrante');
    Route::get('/resumen_acreditaciones', 'App\Http\Controllers\InformesController@resumenAcreditaciones')->name('resumenAcreditaciones');
    Route::get('/modalIntegrantes', 'App\Http\Controllers\InformesController@modalIntegrantesResumen')->name('modalIntegrantes');
});

//RUTAS DEL MODULO DEL DEPARTAMENTO DE ATENCION CIUDADANA
Route::middleware(['auth', 'departamento:2'])->group(function () {
    Route::resource('/buzon', 'App\Http\Controllers\BuzonesController');
    Route::get('/informes', 'App\Http\Controllers\BuzonesController@informes')->name('informe_buzones');
    Route::post('/registrar_tipo_buzon', 'App\Http\Controllers\BuzonesController@registrarTiposBuzon')->name('registrar_tipo_buzon');
    Route::get('/obtener-tipos-buzon/{tipo}', 'App\Http\Controllers\BuzonesController@obtenerTiposBuzon');
    Route::get('descargar-qr/{id}', 'App\Http\Controllers\BuzonesController@descargarQR')->name('qr_buzon');
    Route::get('en_proceso/{id}', 'App\Http\Controllers\ComentariosBuzonesController@enProceso')->name('enProceso');
    Route::get('turnado/{id}', 'App\Http\Controllers\ComentariosBuzonesController@turnada')->name('turnada');
    Route::get('/verificacionFisica', 'App\Http\Controllers\VerificacionFisicaController@viewDireccionFisica')->name('evaluacionDireccionFisica');
    Route::post('/guardar-respuestas', 'App\Http\Controllers\VerificacionFisicaController@guardarRespuestas')->name('guardarDireccionFisica');
    Route::get('/abrir_mensaje/{id}', 'App\Http\Controllers\ComentariosBuzonesController@abrir')->name('abrirMensaje');
    Route::get('/formato_queja/{id}', 'App\Http\Controllers\DocumentacionGeneradaController@formatoQueja')->name('formato_queja');
    Route::post('/guardar-respuestas', 'App\Http\Controllers\VerificacionFisicaController@guardarRespuestasDireccionFisica')->name('guardarDireccionFisica');
    Route::get('resultados/{id}', 'App\Http\Controllers\VerificacionFisicaController@ResultadosEncuesta')->name('resultados_verificacion');
    Route::resource('/programacion_evaluaciones', 'App\Http\Controllers\ProgramacionEvaluacionesController');
    Route::post('/guardar-respuestaEpM', 'App\Http\Controllers\EvaluarparaMejorarController@guardarRespuestasEvaluarparaMejorar')->name('guardarEvaluarparaMejorar');
    Route::get('/evaluarparamejorar', 'App\Http\Controllers\EvaluarparaMejorarController@viewEvaluarparaMejorar')->name('EvaluarparaMejorar');
    Route::get('resultados-evaluacion/{id}', 'App\Http\Controllers\EvaluarparaMejorarController@ResultadosEncuesta')->name('resultados_evaluarparaMejorar');
    Route::put('/subir_informe/{id}', 'App\Http\Controllers\ProgramacionEvaluacionesController@subirInforme')->name('subirInforme');
});

// RUTAS GENERALES PARA USUARIOS AUTENTICADOS
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/catalogo_usuarios', 'App\Http\Controllers\UserController');
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});
