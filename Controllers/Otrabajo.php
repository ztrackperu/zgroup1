<?php

/*DOM PDF*/

require_once "Config/Config.php";
require_once "Config/Helpers.php";
//require_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
//use Dompdf\Dompdf;

class Otrabajo extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        // verificacion del permiso 
        $perm = $this->model->verificarPermisos($id_user, "Movimientos");
        if (!$perm && $id_user != 1) {
            // no tines permiso 
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    // GENERAR PDF
    public function generarPDF($param){ 
        

        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numot=procesarNumOT($pros[0]);
            $data = $this->model->consultarOT($numot);
           // ob_start();
            // Carga la vista con los datos
            //$this->views->getView($this, "pdf",$data="");
            // Obtiene el contenido del búfer y lo limpia
            //$htmlContent = ob_get_clean();
            //$htmlContent = $this->crearreporte($data);

            
            // Crea el PDF con Dompdf
            /*
            $dompdf = new Dompdf();
            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A4', 'landscape');
            header('Content-Type: application/pdf');
            $dompdf->render();
            $dompdf->stream($numot.".pdf", ['Attachment' => false]);
            */
            $htmlContent = aspectoPDFoT($data);
            procesarPdf($htmlContent,$numot);
            exit(0);
            //$dompdf->render();
            //$dompdf->stream();
            //$data=json_decode($data);
        }
        //echo json_encode($data, JSON_UNESCAPED_UNICODE);
        //die();

        //$data = $this->model->cargarTest(); 

    }    

    public function crear()
    {
        $data['ListaUnidadMedida'] =  $this->model->ListaUnidadMedida();
        $data['ListaSolicitanteOT'] =  $this->model->ListaSolicitanteOT();
        $data['ListaSupervisadoOT'] =  $this->model->ListaSupervisadoOT();
        $this->views->getView($this, "crear",$data);
    }

    public function test()
    {
        $this->views->getView($this, "test");
    }
    public function testCorreo()
    {
        $datosRecibidos = file_get_contents("php://input");
        //echo json_decode($datosRecibidos) ;
        echo $datosRecibidos ;   
    }
    public function listar()
    {
        $data = $this->model->getMovimientos();

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';

            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function consultarOT($param)
    {
        //evaluar el parametro 
        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numot=procesarNumOT($pros[0]);
            $data = $this->model->consultarOT($numot);
            $data=json_decode($data);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function testEstatica($param)
    {
        //$this->views->getView($this, "test");
        //evaluar el parametro 
        $numot="";
        $data="";
        if($param!=""){
            $pros = explode("/",$param);
            $numot=procesarNumOT($pros[0]);
            $data = $this->model->consultarOT($numot);
            $data=json_decode($data);
        }
        //echo json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->views->getView($this, "pdf",$data);
    }

    public function enviarCorreoReporte($param) {
       
        $pros = explode("/",$param);
        $numot = procesarNumOT($pros[0]);
        $data = $this->model->consultarOT($numot);
        $trato = json_decode($data);

        $c_numot = isset($trato->c_numot) ? $trato->c_numot : null;
        $c_rucprov = isset($trato->DetalleOt[0]->c_rucprov) ? $trato->DetalleOt[0]->c_rucprov : null;
        $c_nomprov = isset($trato->DetalleOt[0]->c_nomprov) ? $trato->DetalleOt[0]->c_nomprov : null;
        $c_asunto = isset($trato->c_asunto) ? $trato->c_asunto : null;
        $c_tecnico = isset($trato->DetalleOt[0]->c_tecnico) ? $trato->DetalleOt[0]->c_tecnico : null;
        $tdoc = isset($trato->DetalleOt[0]->tdoc) ? $trato->DetalleOt[0]->tdoc : null;
        $monto = isset($trato->DetalleOt[0]->monto) ? $trato->DetalleOt[0]->monto : null;
        $n_cant = isset($trato->DetalleOt[0]->n_cant) ? $trato->DetalleOt[0]->n_cant : null;
        $n_igvd = isset($trato->DetalleOt[0]->n_igvd) ? $trato->DetalleOt[0]->n_igvd : null;
        $n_totd = isset($trato->DetalleOt[0]->n_totd) ? $trato->DetalleOt[0]->n_totd : null;
        $montop = isset($trato->DetalleOt[0]->montop) ? $trato->DetalleOt[0]->montop : null;

        $c_ejecuta = isset($trato->c_ejecuta) ? $trato->c_ejecuta : null;
        $unidad = isset($trato->unidad) ? $trato->unidad : null;

        $tablaContenido = '';

        foreach ($trato->NotaSalida as $notaSalida) {
            foreach ($notaSalida->NotaSalidaDetalle as $detalle) {
                $nt_ndoc = isset($notaSalida->NT_NDOC) ? $notaSalida->NT_NDOC : null;
                $nt_cart = isset($detalle->NT_CART) ? $detalle->NT_CART : null;
                $c_desprd = isset($detalle->detaoc[0]->c_desprd) ? $detalle->detaoc[0]->c_desprd : null;
                $moneda = isset($detalle->detaoc[0]->moneda[0]->c_codmon) ? $detalle->detaoc[0]->moneda[0]->c_codmon : null;
                $cantidad = isset($detalle->NT_CANT) ? $detalle->NT_CANT : null;
                $monedaText = $moneda === "1" ? "dolares" : "soles";
                $unidadMedida = isset($detalle->NT_CUND) ? $detalle->NT_CUND : null;
                $precioUnd= isset($detalle->detaoc[0]->n_preprd) ? $detalle->detaoc[0]->n_preprd : null;
                $precioTotal = $precioUnd && $cantidad ? number_format($precioUnd * $cantidad, 2, '.', '') : null;
                $precioTotalIgv = $precioUnd && $cantidad ? number_format($precioUnd * $cantidad * 0.18 + $precioTotal, 2, '.', '') : null;
                $responsable = isset($notaSalida->NT_RESPO) ? $notaSalida->NT_RESPO : null;
                $fechaNS = isset($notaSalida->NT_FDOC) ? $notaSalida->NT_FDOC : null;
                $motivo = isset($notaSalida->c_motivo) ? $notaSalida->c_motivo : null;

                $tablaContenido .= "
                <tr>
                    <td>{$nt_ndoc}</td>
                    <td>{$nt_cart}</td>
                    <td>{$c_desprd}</td>
                    <td>{$monedaText}</td>
                    <td>{$cantidad}</td>
                    <td>{$unidadMedida}</td>
                    <td>{$precioUnd}</td>
                    <td>{$precioTotal}</td>
                    <td>{$precioTotalIgv}</td>
                    <td>{$responsable}</td>
                    <td>{$fechaNS}</td>
                    <td>{$motivo}</td>
                </tr>
            ";
        }
    }
        
        // Configura y envía el correo
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'zgroupsistemas@gmail.com'; // Reemplaza con tu dirección de correo electrónico de Gmail
        $mail->Password = 'bsfgahtiqboilexe'; // Reemplaza con tu contraseña de Gmail
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        // Configuración del correo electrónico
        $mail->setFrom('zgroupsistemas@gmail.com', 'Nombre del remitente');
        $mail->addAddress('zgroupsistemas@gmail.com'); // Reemplaza con la dirección de correo electrónico del destinatario
        $mail->Subject = 'Reporte';
        $mail->isHTML(true);
        
        $mail->addEmbeddedImage('Assets/img/logo_pdf.png', 'logo_img');
       
        $mail->Body = '<html>
        
        <head>
        <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap");
        body {
            font-family: "Roboto Slab", sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
           
        }

        .container{
            width: 85%;
            height: 15%;
            border: 1px solid black;
            margin-top: 100px;
            padding: 0 20px;
        }
        .container .columna{
            width: 20%;
            height: 100%;
            float: left;
        }

        .container .columna__respuesta{
            width: 40%;
            height: 100%;
            float: left;
            line-height: 2;
        }

        .container .columna2{
            width: 12%;
            float:right;
            margin-bottom: 100px;
            line-height:1.5;
        }

        .container .columna2__respuesta{
            margin-bottom: 100px;
            width: 20%;
            float:right;
            line-height: 1;
        }


        table {
            width: 90%; /* Cambia el ancho de la tabla al 100% */
            border-collapse: collapse;
            margin: 30px 0 10px 0;
            
        }

        table + table{
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            word-wrap: break-word; /* Asegura que las palabras largas se rompan y pasen a la siguiente línea */
        }
        th {
            background-color: #d9e5f4;
            color: black;
        }

        .contenido__fecha {
            position: absolute; /* Se posiciona de forma absoluta */
            bottom: 0;
            left: 0;
            padding: 10px;
            color: #1d2d4d;
            font-size: 12px;
        }
        .contenido__superior__derecho{
            position: absolute;
            top:0;
            right:0;
        }
        .contenido__superior__izquierda{
            position:absolute;
            top:0;
            left:0;
            padding: 10px;
            color: #1d2d4d;
            font-size: 12px;
            height: 50px;
            text-align:right;
            line-height: 5px;
        }
        
        .contenido__inferior__derecho {
            position: absolute; 
            bottom: 0;
            right: 0;
            padding: 0px;
            line-height:0;
            color: #1d2d4d;
            font-size: 12px;
            text-align: right; 
        }

        .contenido__firmas {
            margin-top: 50px;
            width: 100%;
            overflow: auto; 
        }
        
        .contenido__firmas .firma {
            width: 30%;
            float: left;
            text-align: center;
        }
    
        .linea-firma {
            border-top: 1px solid black;
            width: 100px;
            margin: 0 auto; 
        }
       
    </style>
        </head>
        <body>
            <div class="contenido__superior__izquierda">
                <h3>SISTEMA INTRANET</h3>
                <h3>THERMO KING</h3>
                <p>REPRESENTANTE OFICIAL PERÚ</p>
            </div>
            <div class="contenido__superior__derecho">
                <img src="cid:logo_img" alt="" width="250" height="90">
            </div>
            <div class="container">
                <div class="columna">
                    <h3>RUC</h3>
                    <h3>Solicitante</h3>
                    <h3>Otros Equipos</h3>
                    <h3>Contenedor</h3>
                    <h3>Cod. Contenedor</h3>
                    <h3>Trabajo a realizar</h3>
                    <h3>Refrigerante</h3>
                </div>
                <div class="columna__respuesta">
                    <p>:ruc </p>
                    <p>:encargado de la tarea</p>
                    <p>:Thermo King</p>
                    <p>:Thermo King</p>
                    <p>:CONTENEDOR</p>
                    <p>:Thermo King</p>
                    <p>:Thermo King</p>
                </div>
                <div class="columna2">
                    <p>:ZGROUP S.A.C</p>
                    <p>:Thermo King</p>
                    <p>:Thermo King</p>
                    <p>:Thermo King</p>
                    <p>:Thermo King</p>
                    <p>:Thermo King</p>
                </div>
                <div class="columna2__respuesta">
                    <h3>RZN. SOCIAL</h3>
                    <h3>PRODUCTO N°</h3>
                    <h3>Marca</h3>
                    <h3>Modelo</h3>
                    <h3>N° Serie</h3>
                    <h3>Controlador</h3>
                </div>
            </div>
        
            <table>
                <thead>
                    <tr>
                        <th>N° Orden de Trabajo</th>
                        <th>RUC</th>
                        <th>Proveedor</th>
                        <th>Trabajo Realizado</th>
                        <th>Tecnico Encargado </th>
                        <th>Tipo Dcto</th>
                        <th>Monto Unitario</th>
                        <th>Cantidad Dcto</th>
                        <th>IGV</th>
                        <th>Total Dcto</th>
                        <th>Monto Unitario Pactado</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>'.$c_numot.'</td>
                    <td>'.$c_rucprov.'</td>
                    <td>'.$c_nomprov.'</td>
                    <td>'.$c_asunto.'</td>
                    <td>'.$c_tecnico.'</td>
                    <td>'.$tdoc.'</td>
                    <td>'.$monto.'</td>
                    <td>'.$n_cant.'</td>
                    <td>'.$n_igvd.'</td>
                    <td>'.$n_totd.'</td>
                    <td>'.$montop.'</td>         
                </tr>
                </tbody>
            </table>
            <table>
                    <thead>
                        <tr>
                            <th>Nota Salida</th>
                            <th>Cod producto</th>
                            <th>Descripcion</th>
                            <th>Moneda</th>
                            <th>Cantidad</th>
                            <th>Unidad Medida</th>
                            <th>Precio UND. </th>
                            <th>Precio Total </th>
                            <th>Precio Total + IGV</th>
                            <th>Responsable</th>
                            <th>Fecha de NS</th>
                            <th>Motivo</th
                        </tr>
                    </thead>
                    <tbody>
                            <td>'.$tablaContenido.'</td>
                    </tbody>
                </table>
                <div class="contenido__inferior__derecho">
                <h3>ZGROUP S.A.C. RUC:20521180774</h3>
                <h3>SISTEMA INTRANET</h3>
                <h3>EMAIL: ZTRACK@ZGROUP.COM.PE</h3>
                <h3>WWW.ZGROUP.COM.PE</h3>
            </div>
        </body>
    </html>';
    
        try {
            $mail->send();
            echo json_encode(['msg' => 'Correo enviado con éxito', 'icono' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error al enviar el correo: ' . $mail->ErrorInfo, 'icono' => 'error']);
        }
    }

}
