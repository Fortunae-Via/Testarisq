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

?>


<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Gestion des utilisateurs</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionUtilisateurs.css" />
</head>
	<body>

		<?php
		// Appel de la base de donnée bdd_testarisq
		require("modele/connexionbdd.php");
		// Definition des fonctions de requête SQL
		require('modele/RequetesGestion.php');

		if(isset($_POST['type_compte'], $_POST['id'], $_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['jour'], $_POST['mois'], $_POST['annee'], $_POST['sexe'], $_POST['mail'], $_POST['numeroRue'], $_POST['rue'], $_POST['ville'], $_POST['code'], $_POST['region'], $_POST['pays'], $_POST['telephone'])){

			$caract="abcdefghijklmnopqrstuvwyxz0123456789@!:;,$/?*=+";
			for($i=1; $i<=12; $i++){
				$nbr=strlen($caract);
				$nbr=mt_rand(0, ($nbr-1));
				$mdp[$i]=$caract[$nbr];
			}
			$mdp=implode($mdp);

			$DateNaissance = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];

			Ajouter($bdd, $_POST['id'], $_POST['numeroRue'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['region'], $_POST['pays'], $mdp, $_POST['nom'], $_POST['nom_usage'], $_POST['prenom'], $_POST['prenom_2'], $_POST['prenom_3'], $DateNaissance, $_POST['sexe'], $_POST['mail'], $_POST['telephone'], $_POST['type_compte']);

			sleep(1);
				if('1'){
					// Redirection vers Rechercheutilisateur.php (la page précédente)
					header('Location: GestionUtilisateurs.php');
			}

		}else{
			// Inclusion du Header
			include("vues/Header.php");

			// Inclusion de la structure HTML
			include("vues/VuesGestion.php");
		}
		?>
 		<script type="text/javascript" src="js/fonctions_generiques.js">
 			
 		</script>
	</body>
</html>