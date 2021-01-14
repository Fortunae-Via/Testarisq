<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil.php');
}
		
// Appel de la base de donnée bdd_testarisq
require("modele/connexionbdd.php");
// Definition des fonctions de requête SQL
require('modele/RequetesGestion.php');

//Si tout les parties obligatoire du formulaire sont remplies Alors :
if(isset($_POST['type_compte'], $_POST['id'], $_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['sexe'], $_POST['mail'], $_POST['numeroRue'], $_POST['rue'], $_POST['ville'], $_POST['code'], $_POST['region'], $_POST['pays'], $_POST['telephone'])){

	// Definition des caractères servant à la création d'un mot de passe
	$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
	for($i=1; $i<=12; $i++){
		$nbr=strlen($caract);
		$nbr=mt_rand(0, ($nbr-1));
		$mdp[$i]=$caract[$nbr];
	}
	// Conversion de la liste en un string
	$mdp=implode($mdp);

	/**
	Definition de la variable à partir des informations du formulaire
	On passe du système (français) JJ/MM/AAAA du formulaire
	au système (anglophone) AAAA-MM-JJ utilisé par la base de donnée
	**/
	$DateNaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];

	// Appel de la fonction Ajouter permettant l'ajout d'un utilisateur
	Ajouter($bdd, $_POST['id'], $_POST['numeroRue'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['region'], $_POST['pays'], $mdp, $_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['prenom_2'], $_POST['prenom_3'], $DateNaissance, $_POST['sexe'], $_POST['mail'], $_POST['telephone'], $_POST['type_compte']);

	sleep(1);
		if('1'){
			// Redirection vers Rechercheutilisateur.php (la page précédente)
			header('Location: GestionUtilisateurs.php');
		}

	}else{
		// Inclusion de la structure HTML
		include("vues/VuesGestion.php");
	}
?>