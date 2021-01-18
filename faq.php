<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil.php');
}

//On prépare la FAQ
require 'modele/connexionbdd.php';
require 'modele/RequetesFAQ.php';
$faq = RecupFAQ($bdd);

//On affiche la page
require 'vues/FAQ.php';



