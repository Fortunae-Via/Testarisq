<?php

//On démarre la session
session_start();


//Si on est déja connectés
if (isset($_SESSION['TypeCompte'])) {

	switch($_SESSION['TypeCompte']) {

		case 'CIT':		//Citoyen
			include 'vues/AccueilCitoyen.php'; 
			break;

		case 'AUE':		//Auto-école
			include 'vues/AccueilAutorite.php'; 
			break;

		case 'POL':		//Police
			include 'vues/AccueilAutorite.php'; 
			break;

		case 'ADM':		//Admin
			include 'vues/AccueilAdministrateur.php'; 
			break;
	}
} 


//Si on vient de soumettre le formulaire 
else if (isset($_POST['identifiant']) AND isset($_POST['mdp'])) { 

	if (strlen($_POST['identifiant'])>3 AND $_POST['mdp'] !== "") {

		//On récupère l'identifiant et le mdp donné
		$IDCompte = $_POST['identifiant'];
		$MDP = $_POST['mdp'];
		$NIR = substr($IDCompte, 0, -3); //On enlève les trois caractères à la fin indiquant le type de compte
		$TypeCompteDemande = substr($IDCompte, -3);
		
		require 'modele/connexionbdd.php';  //Connexion à la base de données
		require 'modele/fonctionsSQL.php';		//On récupère les fonctions

		if (BonneCombinaison($bdd,$NIR,$MDP)) {	//L'utilisateur existe et a fourni le bon mot de passe

			$_SESSION['NIR'] = $NIR;	//On note le NIR en session

			if (in_array($TypeCompteDemande,ListeComptes($bdd,$NIR))){	//S'il a bien le compte qu'il demande

			$_SESSION['TypeCompte'] = $TypeCompteDemande;

				switch($TypeCompteDemande) {

					case 'CIT':		//Citoyen
						include 'vues/AccueilCitoyen.php'; 
						break;

					case 'AUE':		//Auto-école
						include 'vues/AccueilAutorite.php'; 
						break;

					case 'POL':		//Police
						include 'vues/AccueilAutorite.php'; 
						break;

					case 'ADM':		//Admin
						include 'vues/AccueilAdministrateur.php'; 
						break;

				}

			}

			else {	//S'il n'a pas précisé de type de compte ou qu'il demande l'accès à un compte qu'il n'a pas, on renvoie à l'accueil citoyen
				$_SESSION['TypeCompte'] = 'CIT';
				include 'vues/AccueilCitoyen.php'; 
			}

		}

		else {
			//Combinaison incorrecte
			$mdp_incorrect=true;
			include 'vues/Authentification.php';
		}	

	}

	else {
		//Combinaison impossible (identifiant trop petit et/ou mot de passe vide)
		$mdp_incorrect=true;
		include 'vues/Authentification.php';
	}

}


else {
	$mdp_incorrect=false;
	include 'vues/Authentification.php';
}


?>