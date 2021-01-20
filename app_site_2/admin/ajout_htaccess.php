<?php
session_start();
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
  header('Location: ../Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {  
  header('Location: ../Accueil.php');
}
if (isset($_POST['login']) AND isset($_POST['pass']))
{
    $f = '.htpasswd';
    $handle = fopen($f,"a+");

    // regarde si le fichier est accessible en écriture
    if (is_writable($f)) {
    // Ecriture
      if (fwrite($handle, $login.":".$_POST['pass']."\n") === FALSE) {
        echo 'Impossible d\'écrire dans le fichier '.$f.'';
        exit;
      }
      if (fwrite($handle, $login.":".$pass_crypte."\n") === FALSE) {
        echo 'Impossible d\'écrire dans le fichier '.$f.'';
        exit;
      }

   
      echo 'Ecriture terminé';
   
      fclose($handle);
                   
  }
  else {
      echo 'Impossible d\'écrire dans le fichier '.$f.'';
  }
}
else // On n'a pas encore rempli le formulaire
{
?>

<p>Entrez votre login et votre mot de passe pour le crypter.</p>

<form method="post">
    <p>
        Login : <input type="text" name="login"><br />
        Mot de passe : <input type="text" name="pass"><br /><br />
    
        <input type="submit" value="Crypter !">
    </p>
</form>

<?php
}

?>