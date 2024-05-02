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
        //$imagenContenido = file_get_contents('Assets/img/logo_pdf.png');
        $headerPDF = file_get_contents('Assets/img/header_modelo_pdf.jpg');
        $footerPDF = file_get_contents('Assets/img/footer_modelo_pdf.jpg');
        // Codifica el contenido de la imagen a base64
        //$imagenBase64 = base64_encode($imagenContenido);
        $headerPDFBase64 = base64_encode($headerPDF);
        $footerPDFBase64 = base64_encode($footerPDF);
        // Crea el diseño en html

        //SEGUNDA TABLA
     

        $tablaContenido = '';
        //$contador = 0; //iniciar contador
        //$limite = 5; 

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
                    <td><strong>{$nt_cart}</strong></td>
                    <td style='text-align:left'><strong>{$c_desprd}</strong></td>
                    <td>{$monedaText}</td>
                    <td>{$cantidad}</td>
                    <td>{$unidadMedida}</td>
                    <td>{$precioUnd}</td>
                    <td>{$precioTotal}</td>
                    <td>{$precioTotalIgv}</td>
                    <td style='font-size:10px;'>{$responsable}</td>
                    <td>{$fechaNS}</td>
                    <td>{$motivo}</td>
                    </tr>
                ";
                /*
                $contador++;  
                if ($contador == $limite) {
                    $tablaContenido .= "<tr style='page-break-before: always;'></tr>";
                    $contador = 0;
                }*/
        } 
    }
        $aspecto = '
        <html>
            <head>
            <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap");

            /** Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado puede ser de altura   y     anchura completas. **/ 
            @page {
                margin: 0cm 0cm;
            }
            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 1cm;
                margin-left: 0cm;
                margin-bottom: 1cm;
                margin-right: 1cm;
            }
            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
            }
            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0.3cm; 
                left: 0cm;
                right: 0cm;
            }
            main {
                position: relative;
                top: 80px;
                left: 0cm;
                right: 0cm;
                margin-bottom: 2cm;
            } 
            main h1{
                text-align: center;
                font-size: 30px;
                font-weight: bold;
            }
            .container{
                width: 90%;
                height: 20%;
                border: 1px solid black;
                margin-top: 10px;
                margin-left: 40px;
                padding: 0 20px;
            }
            .container .columna{
                width: 18%;
                height: 100%;
                float: left;
                font-size: 13px;
                line-height: 1;
            }
            .container .columna__respuesta{
                width: 50%;
                height: 100%;
                float: left;
                line-height: 1;
                font-size: 13px;
            }
            .container .columna2{
                width: 40%;
                float:right;
                font-size: 13px;
                line-height:1;
                margin-bottom: 100px;
            }
            .container .columna2__respuesta{
                width: 20%;
                float:right;
                font-size:13px;
                line-height: 1;
            }
            table {
                width: 96%; /* Cambia el ancho de la tabla al 100% */
                border-collapse: collapse;
                margin: 10px 0 10px 0;
                margin-left: 40px; 
                font-size: 10px;
               
            }

            table + table{
                margin-top: 10px;
                
            }
            
            th, td {
                border: 1px solid black;
                font-size: 8px;
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
                margin-left: 40px;

            }
            
            .contenido__firmas .firma {
                width: 30%;
                float: left;
                text-align: center;
                line-height: 1;
                font-size:13px;
                
            }
        
            .linea-firma {
                border-top: 1px solid black;
                width: 140px;
                margin: 0 auto; 
                margin-left: 50px;
            }
            </style>
            </head>
            <body>
                <header>   
                <img src="data:image/jpeg;base64,' . $headerPDFBase64 . '" width=800mm">
                </header> 
                <footer>
                <img src="data:image/jpeg;base64,' . $footerPDFBase64 . '" width=800mm">
                </footer>
                <main>
                <h1>O.T : 27589 | COTIZACION: 10022034777</h1>
                <div class="container">
                    <div class="columna">
                        <p><strong>RUC</strong></p>
                        <p><strong>Solicitante</strong></p>
                        <p><strong>Otros Equipos</strong></p>
                        <p><strong>Contenedor</strong></p>
                        <p><strong>Cod. Contenedor</strong></p>
                        <p><strong>Trabajo a realizar</strong></p>
                        <p><strong>Refrigerante</strong></p>
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
                        <p><strong>RAZON SOCIAL</strong></p>
                        <p><strong>PRODUCTO N°</strong></p>
                        <p><strong>Marca</strong></p>
                        <p><strong>Modelo</strong></p>
                        <p><strong>N° SERIE</strong></p>
                        <p><strong>Controlador</strong></p>
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
                                <td style="font-size:8">'.$c_numot.'</td>
                                <td style="font-size:8">'.$c_rucprov.'</td>
                                <td style="font-size:8">'.$c_nomprov.'</td>
                                <td style="text-align:left; font-size:8">'.$c_asunto.'</td>
                                <td style="font-size:8">'.$c_tecnico.'</td>
                                <td style="font-size:8">'.$tdoc.'</td>
                                <td style="font-size:8">'.$monto.'</td>
                                <td style="font-size:8">'.$n_cant.'</td>
                                <td style="font-size:8">'.$n_igvd.'</td>
                                <td style="font-size:8">'.$n_totd.'</td>
                                <td style="font-size:8">'.$montop.'</td>
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
                            '.$tablaContenido.'
                        </tbody>
                    </table>
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

                </main>
           
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