<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil.php');
}

//On prépare la FAQ
require 'modele/connexionbdd.php';
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
require 'modele/RequetesFAQ.php';
require 'modele/RequetesGenerales.php';
require 'controleurs/FonctionsPagination.php';

$PageMaximum = PageMaximum($bdd,'ElementFAQ');

if (isset($_GET['page'])) {
	$PageDemandee = $_GET['page'];
	//Si on demande bien un nombre et pas n'importe quoi
	if (is_numeric ($PageDemandee) && intval($PageDemandee)>0) {
		if ($PageDemandee <= PageMaximum($bdd,'ElementFAQ')){
			$PageAffichage = $PageDemandee;
		} 
		else {
			$PageAffichage = 1;
		}
	}
	else {
		$PageAffichage = 1;
	}  
}
else {
	$PageAffichage = 1;
}

$faq = RecupFAQ($bdd,$PageAffichage);

//On affiche la page
require 'vues/FAQ.php';



