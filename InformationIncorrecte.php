<?php

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}


$titre_onglet="Signaler une information incorrecte";
$titre_page="Une information à faire changer ?";
$sujet_defaut="Demande de modification d'information";

require 'vues/Formulaire.php'
?>