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
        $c_numot = $trato->c_numot;
        $c_rucprov = $trato->DetalleOt[0]->c_rucprov;
        $c_nomprov = $trato->DetalleOt[0]->c_nomprov;
        $c_asunto = $trato->c_asunto;
        $c_tecnico = $trato->DetalleOt[0]->c_tecnico;
        $tdoc = $trato->DetalleOt[0]->tdoc;
        $monto = $trato->DetalleOt[0]->monto;
        $n_cant = $trato->DetalleOt[0]->n_cant;
        $n_igvd = $trato->DetalleOt[0]->n_igvd;
        $n_totd = $trato->DetalleOt[0]->n_totd;
        $montop = $trato->DetalleOt[0]->montop;
        
        $fechaHoy = date('d-m-Y H:i:s');
        // Obtén el contenido de la imagen
        $imagenContenido = file_get_contents('Assets/img/image.png');
        // Codifica el contenido de la imagen a base64
        $imagenBase64 = base64_encode($imagenContenido);
        // Crea el diseño en html

        //SEGUNDA TABLA
     

        $tablaContenido = '';

        foreach ($trato->NotaSalida as $notaSalida) {
            $nt_ndoc = $notaSalida->NT_NDOC;
            $nt_cart = $notaSalida->NotaSalidaDetalle[0]->NT_CART;
            $c_desprd = $notaSalida->NotaSalidaDetalle[0]->detaoc[0]->c_desprd;
            $moneda = $notaSalida->NotaSalidaDetalle[0]->detaoc[0]->moneda[0]->c_codmon;
            $cantidad = $notaSalida->NotaSalidaDetalle[0]->NT_CANT;
            $monedaText = $moneda === "1" ? "dolares" : "soles";
            $unidadMedida = $notaSalida->NotaSalidaDetalle[0]->NT_CUND;
            $precioUnd= $notaSalida->NotaSalidaDetalle[0]->detaoc[0]->n_preprd;
            $precioTotal = number_format($precioUnd * $cantidad, 2, '.', '');
            $precioTotalIgv = number_format($precioUnd * $cantidad * 0.18 + $precioTotal, 2, '.', '');
            $responsable = $notaSalida->NT_RESPO;
            $fechaNS = $notaSalida->NT_FDOC;
            $motivo = $notaSalida->c_motivo;

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
            body {
                font-family: "Roboto Slab", sans-serif;
                font-size: 9px;
                margin: 0;
                padding: 0;
                width: 210mm; /* Ancho de una hoja A4 */
                height: 297mm; /* Altura de una hoja A4 */
                box-sizing: border-box; /* Incluye el padding y el borde en el tamaño total del elemento */
            }
            table {
                width: 10%; /* Cambia el ancho de la tabla al 100% */
                border-collapse: collapse;
                margin: 20px 0;
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

            .contenido__firmas {
                margin-top: 100px;
                display: flex;
                justify-content: space-between;
            }
        
            .firma {
                flex: 3;
                text-align: center;
            }
        
            .linea-firma {
                border-top: 1px solid black;
                width: 200px;
                margin: 0 auto; 
            }
           
        </style>
            </head>
            <body>
                <img src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="" width="120" height="60">
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
                    <p>Despahco por Almacen</p>
                </div>
                </div>



                <div class="contenido__fecha">
                    <p>Fecha:'.$fechaHoy.'</p>
                </div>

                          
            </body>
            <script>
                    let obtenerFechaHoy = new Date();
                    document.getElementByiD("fechaHoy").textContent = obtenerFechaHoy;
            </script>
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