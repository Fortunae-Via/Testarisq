<?php

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}

// On écrit les paramètres
$titre_onglet="Poser une question";
$titre_page="Une question ?";
$sujet_defaut="Question sur l'utilisation";

//On affiche la page
require 'vues/Formulaire.php';
