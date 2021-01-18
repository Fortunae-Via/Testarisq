<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil.php');
} 

//Partie traitement de l'ajout de question :
if (isset($_POST['question']) && isset($_POST['reponse'])){
		
	require 'modele/connexionbdd.php';
	require 'modele/RequetesFAQ.php';

	AjouterQuestion($bdd, $_POST['question'], isset($_POST['reponse']));

	$_SESSION['MessageAjoutFAQ'] = true ;
	header('Location: GestionFAQ.php');
}

else {
	if (isset($_SESSION['MessageAjoutFAQ'])) {
		$MessageAjout = true;
		unset($_SESSION['MessageAjoutFAQ']);
	}
	else {
		$MessageAjout = false;
	}

	//On prépare la FAQ
	require 'modele/connexionbdd.php';
	require 'modele/RequetesFAQ.php';
	$faq = RecupFAQ($bdd);

	//On affiche la page
	require 'vues/GestionFAQ.php';
}






