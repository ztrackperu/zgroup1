<?php 
//envios de correo
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    //genrar pdf
    use Dompdf\Dompdf;

    function procesarNumOT($numot){
        $digitos = 10;
        $num = strval($numot);
        $can = strlen($num);
        $falta = $digitos - $can - 1;
        $respuesta = "1";
        for( $i = 0; $i < $falta; $i++) {
            $respuesta .= "0";
        }
        $cadena =$respuesta.$numot;
        return $cadena;
    }
    
    function  procesarPdf($htmlContent,$numot){
        // Crea el PDF con Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        header('Content-Type: application/pdf');
        $dompdf->render();
        $dompdf->stream($numot.".pdf", ['Attachment' => false]);
        return $dompdf ;
    }


    function  aspectoPDFoT($data){
        //PRIMERA TABLA
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

        //CONTENIDO PDF
        $c_ejecuta = isset($trato->c_ejecuta) ? $trato->c_ejecuta : null;
        $unidad = isset($trato->unidad) ? $trato->unidad : null;
        
        //Fecha con zona horari de Lima- Perú
        date_default_timezone_set('America/Lima');
        $fechaHoy = date('d/m/Y H:i:s');
        // Obtén el contenido de la imagen
        $imagenContenido = file_get_contents('Assets/img/logo_pdf.png');
        $modeloPDF = file_get_contents('Assets/img/modelo_pdf.jpg');
        // Codifica el contenido de la imagen a base64
        $imagenBase64 = base64_encode($imagenContenido);
        $modeloPDFBase64 = base64_encode($modeloPDF);
        // Crea el diseño en html

        //SEGUNDA TABLA
     

        $tablaContenido = '';
        $contador = 1; //Iniciar contador

        //Controlar secuancia de foreach
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
        $contador++;
        
    }
        // <img src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="" width="120" height="60">
        /*
        $nt_ndoc = $trato->NotaSalida[0]->NT_NDOC;
        $nt_cart = $trato->NotaSalida[0]->NotaSalidaDetalle[0]->NT_CART;
        $c_desprd = $trato->NotaSalida[0]->NotaSalidaDetalle[0]->detaoc[0]->c_desprd;
        $moneda = $trato->NotaSalida[0]->NotaSalidaDetalle[0]->detaoc[0]->moneda[0]->c_codmon;
        $cantidad = $trato->NotaSalida[0]->NotaSalidaDetalle[0]->NT_CANT;
        //Cambio de 1/0 a dolares y soles
        $monedaText = $moneda === "1" ? "dolares" : "soles";
        $unidadMedida = $trato->NotaSalida[0]->NotaSalidaDetalle[0]->NT_CUND;
        $precioUnd= $trato->NotaSalida[0]->NotaSalidaDetalle[0]->detaoc[0]->n_preprd;
        $precioTotal = number_format($precioUnd * $cantidad, 2, '.', '');
        $precioTotalIgv = number_format($precioUnd * $cantidad * 0.18 + $precioTotal, 2, '.', '');
        $responsable = $trato->NotaSalida[0]->NT_RESPO;
        $fechaNS = $trato->NotaSalida[0]->NT_FDOC;
        $motivo = $trato->NotaSalida[0]->c_motivo;*/
        $aspecto = '
        <html>
            <head>
            <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap");
            @page {
                margin-left: 0;
                margin-right: 0;
                margin-top:0;
                margin-bottom: 0;
            }
            body {
                font-family: "Roboto Slab", sans-serif;
                font-size: 9px;
                margin: 0;
                padding: 0;
                width: 210mm; /* Ancho de una hoja A4 */
                height: 297mm; /* Altura de una hoja A4 */
                box-sizing: border-box; /* Incluye el padding y el borde en el tamaño total del elemento */
            }
            .container{
                width: 85%;
                height: 15%;
                border: 1px solid black;
                margin-top: 10px;
                margin-left: 40px;
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
                line-height: 1.5;
            }
            .container .columna2{
                width: 40%;
                float:right;
                margin-bottom: 100px;
            }
            .container .columna2__respuesta{
                width: 20%;
                float:right;
                line-height: 1.5;
            }
            .tabla table{
                padding-top:120px; 
 
            }

            table {
                width: 90%; /* Cambia el ancho de la tabla al 100% */
                border-collapse: collapse;
                margin: 30px 0 10px 0;
                margin-left: 40px; 
               
            }
            table + table{
                margin-top: 20px;
                
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
            .contenido__firmas {
                margin-top: 50px;
                width: 100%;
                overflow: auto; 
                margin-left: 20px;

            }
            
            .contenido__firmas .firma {
                width: 30%;
                float: left;
                text-align: center;
                
            }
        
            .linea-firma {
                border-top: 1px solid black;
                width: 140px;
                margin: 0 auto; 
                margin-left: 50px;
            }
            .modelo {
                position: relative;
                background-image: url("data:image/jpeg;base64,' . $modeloPDFBase64 . '");
                background-repeat: repeat-y;
                background-size: cover;
            }
            .modelo img{
                width: 100%;
                height: 100%;
                
            }
            .contenido-superpuesto {
                position: absolute;
                top: 0;
                left: 0;
            }

            .contenido-superpuesto h1{
                font-size: 30px;
                text-align: center;
                margin-top: 120px;
            }
            
           
        </style>
            </head>
            <body>
                <div class="modelo">
                    <img src="data:image/jpeg;base64,' . $modeloPDFBase64 . '">
                    <div class="contenido-superpuesto">
                        <h1>O.T : 27589 | COTIZACION: 10022034777</h1>
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
                                <p>:'. $c_rucprov .'</p>
                                <p>:'. $c_ejecuta .'</p>
                                <p>:Thermo King</p>
                                <p>:Thermo King</p>
                                <p>:'. $unidad .'</p>
                                <p>:Thermo King</p>
                                <p>:Thermo King</p>
                            </div>
                            <div class="columna2">
                                <h3>RAZON SOCIAL</h3>
                                <h3>PRODUCTO N°</h3>
                                <h3>Marca</h3>
                                <h3>Modelo</h3>
                                <h3>N° Serie</h3>
                                <h3>Controlador</h3>
                            </div>
                            <div class="columna2__respuesta">
                                <p>:ZGROUP S.A.C</p>
                                <p>:Thermo King</p>
                                <p>:Thermo King</p>
                                <p>:Thermo King</p>
                                <p>:Thermo King</p>
                                <p>:Thermo King</p>
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
                    </div>
                    <div class="tabla">
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
                            <tr><td>'.$contador.'</td></tr>
                            '.$tablaContenido.'
                        </tbody>
                    </table>
                    </div>
                    <div class="contenido__firmas">
                        <div class="firma">
                            <div class="linea-firma"></div>
                            <p>Firma</p>
                            <p>Tecnico Asignado</p>
                        </div>
                        <div class="firma">
                            <div class="linea-firma"></div>
                            <p>Firma</p>
                            <p>Verificacion de Componentes</p>
                        </div>
                        <div class="firma">
                            <div class="linea-firma"></div>
                            <p>Firma</p>
                            <p>Derecho por Almacen</p>
                        </div>
                    </div>
                </div>            
            </body>
        </html>';
        
        return $aspecto ;
    }
    function envio_correo($remitente,$passRemitente,$destinatario)
    { 
        $mail = new PHPMailer(true);
        $correoEnvio = $destinatario;    
        $asunto = "Bienvenido" ;
        $mensaje = "<h2> Test Ok  </h2>";
        $mensaje .= "<h3>CONEXION ESTABLECIDA</h3>";
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();    
            $mail->From = $remitente; 
            //$mail->From = "desarrollo@zgroup.com.pe";                                   //Send using SMTP
            $mail->Host       = "smtp.gmail.com";                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            //$mail->Username   = 'desarrollo@zgroup.com.pe';                     //SMTP username
            //$mail->Password   = 'Des5090100';                               //SMTP password
            $mail->Username   = $remitente;                     //SMTP username
            $mail->Password   = $passRemitente;                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Agregar destinatario
            $mail->AddAddress($correoEnvio);
            $mail->Subject = utf8_decode($asunto);
            $mail->Body =utf8_decode($mensaje);
            $mail->isHTML(true);
            //$mail->AddAttachment('./excel/'.$nombreContenedor.'_'.$fechaZ.'.xlsx', $nombreContenedor.'_'.$fechaZ.'.xlsx');
            //Avisar si fue enviado o no y dirigir al index
            if ($mail->Send()) {
                $data ='ok';  
            } else {
                $data ='<script type="text/javascript">alert("NO ENVIADO, intentar de nuevo");</script>';
            }    
        }catch (Exception $e) {
            $data = "Se ha producido un mensaje de error . Mailer Error: {$mail->ErrorInfo}"; 
        }
        return $data;
    }

    function envio_correoTest($remitente,$passRemitente,$destinatario)
    { 
        $mail = new PHPMailer(true);
        $correoEnvio = $destinatario;    
        $asunto = "TEST" ;
        $mensaje = "<h2> Test Ok  </h2>";
        $mensaje .= "<h3>CONEXION ESTABLECIDA</h3>";
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();    
            $mail->From = $remitente; 
            //$mail->From = "desarrollo@zgroup.com.pe";                                   //Send using SMTP
            $mail->Host       = "smtp.gmail.com";                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            //$mail->Username   = 'desarrollo@zgroup.com.pe';                     //SMTP username
            //$mail->Password   = 'Des5090100';                               //SMTP password
            $mail->Username   = $remitente;                     //SMTP username
            $mail->Password   = $passRemitente;                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Agregar destinatario
            $mail->AddAddress($correoEnvio);
            $mail->Subject = utf8_decode($asunto);
            $mail->Body =utf8_decode($mensaje);
            $mail->isHTML(true);
            //$mail->AddAttachment('./excel/'.$nombreContenedor.'_'.$fechaZ.'.xlsx', $nombreContenedor.'_'.$fechaZ.'.xlsx');
            //Avisar si fue enviado o no y dirigir al index
            if ($mail->Send()) {
                $data ='ok';  
            } else {
                $data ='<script type="text/javascript">alert("NO ENVIADO, intentar de nuevo");</script>';
            }    
        }catch (Exception $e) {
            $data = "Se ha producido un mensaje de error . Mailer Error: {$mail->ErrorInfo}"; 
        }
        return $data;
    }


?>