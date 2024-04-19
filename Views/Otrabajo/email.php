<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$remitente= 'zgroupsistemas@gmail.com';
$passRemitente= 'bsfgahtiqboilexe';
$correoEnvio = 'ztrack@zgroup.com';
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