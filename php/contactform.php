<?php

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $mailFrom = $_POST['email'];
    $message = $_POST['message'];

    $mailTo = "jieming079@gmail.com";
    $headers = "From:.$mailFrom";
    $txt = "Vous avez reçu un e-mail de ".$name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: formulaire.php?mailsend")
}