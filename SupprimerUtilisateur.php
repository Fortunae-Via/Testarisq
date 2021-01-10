<!DOCTYPE html>
<html>
	<head>
		<title>TESTARISQ - Recherche Utilisateur</title>
		<meta charset="utf-8"/>
		<!--
			Un stylesheet n'est pas nécessaire.
			La page n'effectue qu'une requête SQL.
		-->
	</head>
	<body>
		<h4>Utilisateur Supprimé</h4>
		<?php
			// Si on a bien récupérer l'identifiant d'un utilisateur à la page précédente Alors :
			if(isset($_GET['NIR'])){
				// Appel  de la base de donnée
				/*try{
					$bdd = new PDO('mysql:host=localhost; dbname=app2;port=3308', 'root', '');
				}catch(Exception $e){
					die('Erreur : '. $e->getMessage());
				}*/
				require("modele/connexionbdd.php");


				/**
					Suppression de l'utilisateur où l'identifiant unique correspond avec la valeur
					du $_GET['NIR']
					Puis
					Suppression des données correspondantes dans la table adresse lié à 
					la table personne par une clé étagère.
				**/
				$supprimer = $bdd->prepare('DELETE FROM personne WHERE NIR=?');
				$supprimer->execute(array($_GET['NIR']));
				$supprimer = $bdd->prepare('DELETE FROM adresse WHERE NIR=?');
				$supprimer->execute(array($_GET['NIR']));
				$supprimer->closeCursor();

				$pass=1;
				sleep(2);
				if($pass){
					/**
						L'utilisateur est redirigé vers la page de recherche.
						(Retour à la page précédente)
					**/
					header('Location: RechercheUtilisateur.php');
				}
			}
		?>
	</body>
</html>