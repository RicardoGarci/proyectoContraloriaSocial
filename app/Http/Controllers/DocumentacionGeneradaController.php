<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CatalogoMunicipio;
use App\Models\Buzone;
use Auth;
use App\Models\ComentariosBuzone;
use PDF;
use App\Models\IntegrantesComite;

class DocumentacionGeneradaController extends Controller
{
    public function constanciaMunicipio($id)
    {
        $datos = CatalogoMunicipio::MunicipioYAcreditacion($id)->first();
        $meses3 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $fecha3 = Carbon::parse($datos->fecha_validado);
        $mes3 = $meses3[$fecha3->format('n') - 1];
        $input3 = $fecha3->format('d') . ' de ' . $mes3 . ' de ' . $fecha3->format('Y');

        $tbl =
            '<br><br><br><div align="center">
               <font style="color:#616161;"> El Gobierno Constitucional del Estado de Oaxaca a través de la
Secretaría de Honestidad, Transparencia y Función Pública del
Poder Ejecutivo del Estado de Oaxaca, expide con carácter
honorífico la presente:</font><br><br><br>
<strong><font size="50" style="color:#9D2449;">CONSTANCIA</font><br><br><br><br>
al municipio de:</strong><br><br><br><font size="35" style="color:#9D2449;">
' .
            $datos->nombre .
            '</font><br><font style="color:#B38E5D;">REGIÓN ' .
            $datos->region .
            ' / DISTRITO ' .
            $datos->distrito .
            '</font><br><br><br>
            Por su participación y contribución en el Taller de<br>
<strong>Capacitación en Materia de Contraloría Social.<br><br><br><br><br><br><br>

Lic. María Teresa Jiménez Martínez<br>
Directora de Contraloría Social</strong><br><br><br><br></div>
<table >
  <tr>
    <td><font style="color:#616161;">Tlalixtac de Cabrera, ' .
            $input3 .
            '</font></td>
    <td align="right"><strong><font style="color:#B38E5D;">www.oaxaca.gob.mx/</font><font style="color:#9D2449;">honestidad</font></strong></td>
  </tr>
</table>
';

        PDF::setHeaderCallback(function ($pdf) {
            // Agregar la imagen a la página
            $pdf->Image('grecas.jpg', 185, 0, 50, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('grecas.jpg', 185, 240, 50, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('cs.png', 15, 10, 180, 28, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('abajo.jpg', -8, 270, 0, 8, '', '', '', false, 300, '', false, false, 0);
        });

        PDF::SetAuthor('Contraloria Social');
        PDF::SetTitle('Constancia de municipio');
        PDF::SetSubject('SERAP');
        PDF::SetMargins(20, 30, 25);
        PDF::SetFontSubsetting(false);
        PDF::SetAutoPageBreak(true, 10);
        PDF::AddPage('P', 'LETTER');
        // PDF::SetFont('Montserrat-Regular', '', 14);
        PDF::SetFont('times', '', '13');
        PDF::writeHTML($tbl, true, false, true, false, '');
        //PDF::AddPage();
        PDF::Output('Constancia de municipio.pdf', 'I');
    }

    public function constanciaIntegrante($id)
    {
        $datos = IntegrantesComite::IntegranteComiteMunicipio($id)->first();

        $meses3 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $fecha3 = Carbon::parse($datos->fecha_validado);
        $mes3 = $meses3[$fecha3->format('n') - 1];
        $input3 = $fecha3->format('d') . ' de ' . $mes3 . ' de ' . $fecha3->format('Y');

        $tbl = '<br><br><div align="center">
               <font style="color:#616161;"> La Secretaría de Honestidad, Transparencia y Función Pública del
Poder Ejecutivo del Estado de Oaxaca, con fundamento en el Título II,
Capítulo I, Apartado séptimo de los Lineamientos para la Integración,
Funcionamiento y Promoción de la Contraloría Social en el Estado de
Oaxaca, expide con carácter honorífico la presente:
</font><br><br><br>
<strong><font size="30" style="color:#9D2449;">CONSTANCIA DE
ACREDITACIÓN</font><br><br>';
        if ($datos->sexo == 'HOMBRE') {
            $tbl .= ' al contralor social<br><br><font size="20" style="color:#9D2449;">C. ' . $datos->nombre_completo . '</font>';
        } else {
            $tbl .= ' a la contralora social<br><br><font size="20" style="color:#9D2449;">C. ' . $datos->nombre_completo . '</font>';
        }
        $tbl .=
            '
</strong><br>
<br><font style="color:#616161;">Integrante al Comité de Contraloría Social del Municipio </font><br><br><font size="20" style="color:#9D2449;">' .
            $datos->nombre .
            '</font><br><font style="color:#616161;">Folio comite: ' .
            $datos->folio_comite .
            ' <br><br><br>
            Quien se desempeñará por el período de gestión de enero a diciembre del 2024.
Lo anterior, para realizar actividades y funciones de vigilancia, verificación, seguimiento,
y evaluación de las obras y programas sociales que se ejecuten con
recursos públicos federales, estatales y municipales.</font><br><br><br><br><br><br><br>
<strong>
Lic. María Teresa Jiménez Martínez<br>
Directora de Contraloría Social</strong><br><br></div>
<table >
  <tr>
    <td><font style="color:#616161;">Tlalixtac de Cabrera, ' .
            $input3 .
            '</font></td>
    <td align="right"><strong><font style="color:#B38E5D;">www.oaxaca.gob.mx/</font><font style="color:#9D2449;">honestidad</font></strong></td>
  </tr>
</table>
';

        PDF::setHeaderCallback(function ($pdf) {
            // Agregar la imagen a la página
            $pdf->Image('grecas.jpg', 185, 0, 50, null, '', '', '', false, 500, '', false, false, 0);
            $pdf->Image('grecas.jpg', 185, 240, 50, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('grecas.jpg', 185, 240, 50, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('cs.png', 15, 10, 180, 28, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('abajo.jpg', -8, 270, 0, 8, '', '', '', false, 300, '', false, false, 0);
        });

        PDF::SetAuthor('Contraloria Social');
        PDF::SetTitle('Constancia de integrante');
        PDF::SetSubject('Contraloria Social');
        PDF::SetMargins(20, 30, 25);
        PDF::SetFontSubsetting(false);
        PDF::SetAutoPageBreak(true, 10);
        PDF::AddPage('P', 'LETTER');
        // PDF::SetFont('Montserrat-Regular', '', 14);
        PDF::SetFont('times', '', '13');
        PDF::writeHTML($tbl, true, false, true, false, '');
        //PDF::AddPage();
        PDF::Output('Constancia de integrante.pdf', 'I');
    }

    public function credencialIntegrante($id)
    {
        $dat = IntegrantesComite::TodosIntegranteComite($id)->get();
        $ano = now()->year;
        $arrayDatos = $dat->toArray();
        $grupos = array_chunk($arrayDatos, 3);

        PDF::SetAuthor('Contraloria Social');
        PDF::SetTitle('Credenciales');
        PDF::SetSubject('Contraloria Social');
        PDF::SetMargins(20, 15, 25);
        PDF::SetFontSubsetting(false);
        PDF::SetAutoPageBreak(true, 10);

        PDF::setHeaderCallback(function ($pdf) use ($ano) {
            // Agregar la imagen a la página
            $pdf->Image('credencial.png', 20, 15, null, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('credencial.png', 90, 15, null, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('credencial.png', 160, 15, null, null, '', '', '', false, 300, '', false, false, 0);
            // Texto volteado
            $pdf->StartTransform();
            $pdf->SetFont('times', 'B', 11);
            $pdf->Rotate(180, 43, 80);
            $pdf->Text(50, 26, $ano);
            $pdf->StopTransform();

            $pdf->StartTransform();
            $pdf->SetFont('times', 'B', 11);
            $pdf->Rotate(180, 78, 92);
            $pdf->Text(50, 50, $ano);
            $pdf->StopTransform();

            $pdf->StartTransform();
            $pdf->SetFont('times', 'B', 11);
            $pdf->Rotate(180, 113, 102);
            $pdf->Text(50, 70, $ano);
            $pdf->StopTransform();
        });

        for ($i = 0; $i < count($grupos); $i++) {
            $tbl = '<table><tr>';

            foreach ($grupos[$i] as $datos) {
                // Construye la tabla para cada elemento del grupo actual
                $tbl .=
                    '
            <td width="198">
                <div align="center"><strong>
                <br><br>
                        <font style="color:#285C4D;" size="11"> ' .
                    $datos['nombre_completo'] .
                    '</font><br><br>';
                $imageUrl = 'storage/' . $datos['archivo_fotografia'];
                if ($imageUrl == 'storage/') {
                    $tbl .= '
                        <img src="perfil.jpg" alt="foto" style="width: 60px; height: 60px; margin-top: 10mm;"><br>';
                } else {
                    $tbl .=
                        '
                        <img src="' .
                        $imageUrl .
                        '" alt="foto"
                            style="width: 70px; height: 70px; margin-top: 10mm;"><br>';
                }
                if ($datos['sexo'] == 'HOMBRE') {
                    $tbl .=
                        '<font style="color:#B38E5D;" size="11">CONTRALOR SOCIAL</font><br>
                        <font style="color:#9D2449;" size="11">' .
                        $datos['nombre'] .
                        '</font><br>
                         <font style="color:#9D2449;" size="11"><strong>' .
                        $datos['folio_comite'] .
                        '</strong>
                    </font>';
                } else {
                    $tbl .=
                        '<font style="color:#B38E5D;">CONTRALORA SOCIAL</font><br>
                        <font style="color:#9D2449;">' .
                        $datos['nombre'] .
                        '</font><br>
                         <font style="color:#9D2449;" ><strong>' .
                        $datos['folio_comite'] .
                        '</strong>
                    </font>';
                }
                $tbl .= '
                       <br><br><br>
                        Lic. María Teresa Jiménez Martínez<br>
                    </strong>
                    Directora de Contraloría Social<br>
                </div>
                
            </td>
            ';
            }

            $tbl .= '</tr></table>';

            PDF::AddPage('L', 'LETTER');
            PDF::SetFont('times', '', '11');
            PDF::writeHTML($tbl, true, false, true, false, '');
        }

        //PDF::AddPage();
        PDF::Output('Credenciales.pdf', 'I');
    }

    public function formatoQueja($id)
    {
        $datos = ComentariosBuzone::find($id);
        $buzon = Buzone::BuzonDependencia($datos->id_buzon_fk)->first();

        if (is_null($datos->abierto_por)) {
            $datos->estatus = 1;
            $datos->abierto_por = Auth::id();
            $datos->save();
        }

        $tbl =
            '<br><br><table border="1">
  <tr>
    <td align="center" colspan="2" style="background-color: silver;"><strong>FORMATO DE QUEJA Y/O DENUNCIA</strong></td>
  </tr>
  <tr style="background-color: silver;">
    <td>1.-Datos del promovente (denunciante o quejoso):</td>
    <td> Fecha: ' .
            $datos->created_at->format('d / m / Y') .
            '</td>
  </tr>
  <tr>
    <td colspan="2">1.1 Nombre completo:<br> ' .
            $datos->nombre .
            '</td>
  </tr>
  <tr>
    <td colspan="2">1.2. Domicilio correcto para oír y recibir todo tipo de notificaciones:<br>' .
            $datos->domicilio_promovente .
            '</td>
  </tr>
  <tr>
    <td colspan="2">1.3. Teléfono de contacto:<br>' .
            $datos->telefono_promovente .
            '</td>
  </tr>
  <tr>
    <td colspan="2">1.4. Correo electrónico:<br>' .
            $datos->correo_promovente .
            '</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background-color: silver;">2.- Datos del servidor público que cometió la presunta irregularidad:</td>
  </tr>
  <tr>
    <td colspan="2">2.1. Nombre completo y cargo: (en caso de no contar describe sus rasgos físicos):<br>' .
            $datos->nombre_servidor .
            '</td>
  </tr>
  <tr>
    <td colspan="2">2.2. Nombre de la dependencia o entidad de Gobierno a la que pertenece.<br>' .
            $buzon->nombre_dependecia_programa .
            '</td>
  </tr>
  <tr>
    <td colspan="2">2.3. Datos del municipio o región en donde se cometió la presunta irregularidad.<br> ' .
            $buzon->region .
            '</td>
  </tr>
  <tr>
    <td colspan="2">2.4. Fecha de los hechos ocurridos.<br>' .
            $datos->fecha_hechos .
            '</td>
  </tr>
  <tr>
    <td colspan="2">2.5. Narración de los hechos, realizar la mayor descripción posible de los mismos.<br>' .
            $datos->comentario .
            '</td>
  </tr>
   <tr>
    <td colspan="2" align="center" style="background-color: silver;">3. Constancias o documentos que pudieran corroborar su dicho.</td>
  </tr>
</table>
<small><div align="center"> AVISO DE PRIVACIDAD </div>
Se le hace saber que el trato que se le dará a la información que se le solicita, tendrá el carácter de confidencial y reservada, por
lo tanto, deberá ser tratada con las reservas que ameritan, de conformidad con lo dispuesto en los artículos 1, 7 fracción I, 10
fracción III, 54 fracciones XI, XII, XIII, XIV, 61 y 62 fracciones I y IV y 63 de la Ley de Transparencia, Acceso a la Información Pública y
Buen Gobierno del Estado de Oaxaca publicada el día cuatro de septiembre de dos mil veintiuno en el Periódico Oficial del
Estado de Oaxaca y en los artículos 1, 2 fracción I y 3 fracción II de la Ley de Protección de Datos Personales en Posesión de Sujetos
Obligados del Estado de Oaxaca. </small>

';

        PDF::setHeaderCallback(function ($pdf) {
            // Agregar la imagen a la página
            $pdf->Image('grecas.jpg', 185, 0, 50, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('grecas.jpg', 185, 240, 50, null, '', '', '', false, 300, '', false, false, 0);
            $pdf->Image('cs.png', 15, 5, 180, 28, '', '', '', false, 300, '', false, false, 0);
            $pdf->SetY(-25);
            $pdf->SetFont('Times', ' ', 8, ' ', true);
            $pdf->Cell(60, 0, 'Ciudad Administrativa (Edificio 3 “Andrés Henestrosa”, Nivel 3)', 0, 0, 'C', 0, '', 1);
            $pdf->Ln(3);
            $pdf->Cell(55, 0, 'Carretera Internacional Oaxaca-Istmo, km. 11.5 ', 0, 0, 'C', 0, '', 1);
            $pdf->Ln(3);
            $pdf->Cell(45, 0, 'Tlalixtac de Cabrera, Oaxaca C.P. 68270', 0, 0, 'C', 0, '', 1);
            $pdf->Ln(3);
            $pdf->Cell(40, 0, 'Tel. 01(951) 501 50 00, Ext. 10479', 0, 0, 'C', 0, '', 1);
            $pdf->Ln(3);
            $pdf->Cell(40, 0, 'quejas.honestidad@oaxaca.gob.mx', 0, 0, 'C', 0, '', 1);
            $pdf->Ln(3);
            $pdf->Cell(35, 0, 'www.oaxaca.gob.mx/honestidad/', 0, 0, 'C', 0, '', 1);
        });

        PDF::SetAuthor('Contraloria Social');
        PDF::SetTitle('Formato de queja');
        PDF::SetSubject('SERAP');
        PDF::SetMargins(20, 30, 25);
        PDF::SetFontSubsetting(false);
        PDF::SetAutoPageBreak(true, 10);
        PDF::AddPage('P', 'LETTER');
        // PDF::SetFont('Montserrat-Regular', '', 14);
        PDF::SetFont('times', '', '11');
        PDF::writeHTML($tbl, true, false, true, false, '');
        //PDF::AddPage();
        PDF::Output('Formato de queja', 'I');
    }
}
