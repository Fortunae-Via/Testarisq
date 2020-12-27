<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}

require 'modele/connexionbdd.php';
require 'modele/fonctionsSQL.php';

// On récupère toutes ses informations
$InfosUser=$_SESSION['Infos'];
$Adresse=InfosAdresse($bdd,$InfosUser['Adresse_Id']);


//On affiche la page
require 'vues/MonCompte.php'; 



