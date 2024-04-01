<?php
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};


class Mailer{
    function enviarEmail($email, $asunto, $cuerpo)
    {

    //require_once '../config/config.php';
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';
    require './phpmailer/src/Exception.php';

    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'ventascortesshoes@gmail.com';                     
    $mail->Password   = 'ipcbecixfwdvpygm';                            
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                    

    //Recipients
    $mail->setFrom('ventascortesshoes@gmail.com', 'Tienda_Cortes');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $asunto;


    $mail->Body    = utf8_decode($cuerpo);
    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

    if($mail->send()){
        return true;
    }else {
        return false;   
    }
} catch (Exception $e) {
    echo "Error al enviar el correo Electronico de la compra: {$mail->ErrorInfo}";
    return false;
    exit;
}

}

}

