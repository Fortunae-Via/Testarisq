<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once'phpmailer/Exception.php';
require_once'phpmailer/PHPMailer.php';
require_once'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'youremailadress@gmail.com';//Gmail adress which you want to use as SMTP server
        $mail->Password = 'ton mot de passe';//Gmail adress password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->port = 587;

        $mail->setForm('youremailadress@gmailcom');//Gmail adress which you used ae STMP server
        $mail->AddAddress('jieming079@gmail.com');//Email adress you want ti receive emails(you can use your any email adresses including the email adress which even used as SMTP server)
        $mail->isHTML(true);
        $mail->Subject = 'Message Received(Contact Page)';
        $mail->Body = '<h3>Prénom et nom : $name<br>Email : $email<br>Message : $message</h3>';
        
        $mail->send();
        $alert = '<div class="alert-success">
                    <span>La message est envoyé,merci pour nous connacter!</span>
                  </div>';

    }catch (Exception $e){
        $alert = '<div class="alert-error">
                    <span>'.$e->getMessage().'</span>
                  </div>';

    }

}
?>
