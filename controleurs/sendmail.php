<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../phpmailer/Exception.php';
require_once '../phpmailer/PHPMailer.php';
require_once '../phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

require '../controleurs/FonctionsGenerales.php';

if(isset($_POST['name'])){
  $name = securisation_totale($_POST['name']);
  $email = securisation_totale($_POST['email']);
  $subject = securisation_totale($_POST['subject']);
  $message = nl2br(securisation_partielle($_POST['message']));

  try{
    $mail->CharSet ="UTF-8";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'testarisq@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'Testarisq1234'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('testarisq@gmail.com'); // Gmail address which you used as SMTP server
    $mail->addAddress('testarisq@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "<h3>Nom : ". $name ." <br><br>Email : ".$email. "<br><br>Message : ". $message ."</h3>";

    $mail->send();
    header('Location: ../Accueil');
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
               echo($alert);
  }
}
?>
