<?php
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //SMTP::DEBUG_OFF;
    $mail->isSMTP();                                           
    $mail->Host       = 'mail.gmail.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'ventascortesshoes@gmail.com';                     
    $mail->Password   = 'Joseantonio123@$';                            
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                    

    //Recipients
    $mail->setFrom('ventascortesshoes@gmail.com', 'Tienda_Cortes');
    $mail->addAddress('contactocortesshoes@gmail.com', 'Joe User');

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Detalles de Su Compra';

    $cuerpo = '<h4> Gracias Por Su Compra </h4>';
    $cuerpo .= '<p> El ID de Su Compra es<br>'. $id_transaccion .'</br> </p>';


    $mail->Body    = utf_decode($cuerpo);
    $mail->AltBody = 'Le Enviamos los Detalles de su Compra.';

    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo Electronico de la compra: {$mail->ErrorInfo}";
    //exit;
}