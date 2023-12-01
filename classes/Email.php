<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
 
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token; 

    }

public function enviarConfirmación() {

    //crear el objeto de email
    $mail = new PHPMailer();
     $mail->isSMTP();
 $mail->Host = $_ENV['EMAIL_HOST'];
 $mail->SMTPAuth = true;
 $mail->Port = $_ENV['EMAIL_PORT'];
 $mail->Username = $_ENV['EMAIL_USER'];
 $mail->Password = $_ENV['EMAIL_PASS'];

//Dominio del proyecto 
$mail->setFrom('cuentas@approwan.com');
$mail->addAddress('cuentas@approwan.com', 'AppRowan.com');
$mail->subject = 'Confirma tu cuenta';

//Set HTML
$mail->isHTML(TRUE);
$mail->CharSet = 'UTF-8';

$contenido = "<html>";
$contenido .="<p><strong>Hola " . $this->$email . "</strong> Has creado tu cuenta en App Rowan,
solo debes confirmarla presionando el siguiente enlace</p>";
$contenido .= "<p>Presiona aquí: <a href='" .  $_ENV['APPROWAN_URL']  .  "/confirmar-cuenta?token="
. $this->token . "'>Confirmar Cuenta</a> </p>";
$contenido .="<p>Si no solicitaste esta cuenta, ignora el mensaje</p>";
$contenido .="</html>"; 
$mail->Body = $contenido;

//Enviar el email
$mail->send();


}


public function enviarInstrucciones(){

     //crear el objeto de email
     $mail = new PHPMailer();
     $mail->isSMTP();
 $mail->Host = $_ENV['EMAIL_HOST'];
 $mail->SMTPAuth = true;
 $mail->Port = $_ENV['EMAIL_PORT'];
 $mail->Username = $_ENV['EMAIL_USER'];
 $mail->Password = $_ENV['EMAIL_PASS'];

 $mail->setFrom('cuentas@approwan.com');
$mail->addAddress('cuentas@approwan.com', 'AppRowan.com');
$mail->subject = 'Reestablece tu password';

$mail->isHTML(TRUE);
$mail->CharSet = 'UTF-8';

$contenido = "<html>";
$contenido .="<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password,
continúa en el siguiente enlace para realizarlo.</p>";
$contenido .= "<p>Presiona aquí: <a href='" .  $_ENV['APPROWAN_URL']  .  "/recuperar?token="
. $this->token . "'>Reestablecer Password</a> </p>";
$contenido .="<p>Si no solicitaste esta cuenta, ignora el mensaje</p>";
$contenido .="</html>"; 
$mail->Body = $contenido;

//Enviar el email
$mail->send();

}

}