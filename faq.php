<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil.php');
}

require 'modele/connexionbdd.php';

//On prépare les éléments de la FAQ
$reponse = $bdd->prepare('SELECT * FROM ElementFAQ');  
$execute = $reponse->execute();
$faq = $reponse->fetchAll();

//On affiche la page
require 'vues/FAQ.php';



