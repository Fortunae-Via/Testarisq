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
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
// Definition des fonctions de requête SQL
require('modele/RequetesGestion.php');

//Si on fait une recherche
if(isset($_POST['id_name'])){

	$filtres=array();

	//On remplit par des "" si on vient de l'accueil et que l'on n'a pas posté de filtre
	$liste=array('sexe','region','year','test_number');
	foreach ($liste as $filtre) {
		if (isset($_POST[$filtre])) {
			$filtres[$filtre]=$_POST[$filtre];
		}
		else {
			$filtres[$filtre]="";
		}
	}

	// Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche

	// Definition du regex pour le nom recherché
	$regex = '"%' . $_POST['id_name'] . '%"';

	//affichage de la page
	require("vues/GestionUtilisateurs.php");

}

//Si les informations minimales sont rentrées, un ajout à la bdd est possible
else if( (!(empty($_POST['type_compte']))) && (!(empty($_POST['id']))) && (!(empty($_POST['nom']))) && (!(empty($_POST['prenom']))) && (!(empty($_POST['jour']))) && (!(empty($_POST['mois']))) && (!(empty($_POST['annee']))) && (!(empty($_POST['sexe']))) && (!(empty($_POST['mail']))) ){

	// On récupère toutes les données du POST dans $DonneesUtilisateur
	$TypeCompte = $_POST['type_compte'];
	$DonneesUtilisateur = array(
		'datenaissance' => $_POST['annee']."-".$_POST['mois']."-".$_POST['jour']);

	$liste_donnees_utilisateur=array('id','nom','nom_usage','prenom','prenom_2','prenom_3','sexe','mail','telephone');
	foreach ($liste_donnees_utilisateur as $champ) {
		$DonneesUtilisateur[$champ]=$_POST[$champ];
	}

	// On crée le mot de passe de l'utilisateur
	$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
	for($i=1; $i<=12; $i++){
		$nbr=strlen($caract);
		$nbr=mt_rand(0, ($nbr-1));
		$mdp[$i]=$caract[$nbr];
	}
	$mdp=implode($mdp);
	$DonneesUtilisateur['mdp']=$mdp;

	// Pour l'adresse, on regarde si un des champs est rempli
	if( (!(empty($_POST['numeroRue']))) OR (!(empty($_POST['rue']))) OR (!(empty($_POST['ville']))) OR (!(empty($_POST['code']))) OR (!(empty($_POST['region']))) OR (!(empty($_POST['pays']))) ){

		$liste_donnees_adresse=array('numeroRue','rue','ville','code','region','pays');
		foreach ($liste_donnees_adresse as $champ_adresse) {
			$InfosAdresse[$champ_adresse]=$_POST[$champ_adresse];
		}

		if(empty($InfosAdresse['region'])) {
			$InfosAdresse['region']=null;
		}


		$Id_Adresse=AjouterAdresse($bdd, $InfosAdresse);
		$DonneesUtilisateur['id_adresse']=$Id_Adresse;
	}
	else {
		$DonneesUtilisateur['id_adresse']=0;
	}
	
	AjouterPersonne($bdd, $DonneesUtilisateur);

	if (in_array($TypeCompte, array('AUE','POL','ADM'))) {
		AjouterCompte($bdd,$DonneesUtilisateur['id'],$TypeCompte);
	}

	sleep(1);
		if('1'){
			// Redirection vers Rechercheutilisateur.php (la page précédente)
			header('Location: GestionUtilisateurs.php');
	}
}

else{

	// Affichage de la page
	include("vues/GestionUtilisateurs.php");
}
?>
