<?php

function ListeAutoritesResponsables(PDO $bdd, string $Type): array {
	$query = $bdd->prepare("SELECT id, nom FROM AutoriteResponsable WHERE Type = ?");
	$query->execute(array($Type));
	return $query->fetchAll();
}

function Region($bdd){
	/**
	On affiche les différentes régions dans notre <select> en tant que <option>,
	ainsi ils peuvent être selectionnés et envoyer par formulaire
	sous $_POST['region'].
	**/
	$region = $bdd->query('SELECT Region FROM regionfr');
	while($display = $region->fetch()){
		echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
	}
	$region->closeCursor();
}

function AjouterAdresse(PDO $bdd, array $InfosAdresse): integer {
	$add_adresse = $bdd->prepare('
		INSERT INTO adresse (NumeroRue, Rue, CodePostal, Ville, Region, Pays) 
		VALUES (:numeroRue, :rue, :code, :ville, :region, :pays)');
	$add_adresse->execute($InfosAdresse);
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id de l'adresse créée
	return ($IdInsert);
}

//Ajoute une entrée Personne et un compte citoyen associé
function AjouterPersonne(PDO $bdd, array $DonneesUtilisateur){
	$add_personne = $bdd->prepare('
		INSERT INTO personne (NIR, MotDePasse, NomDeFamille, NomDUsage, Prenom1, Prenom2, Prenom3, DateNaissance, Sexe, Courriel, Portable, Adresse_Id) 
		VALUES (:id, :mdp, :nom, :nom_usage, :prenom, :prenom_2, :prenom_3, :datenaissance, :sexe, :mail, :telephone, :id_adresse)');
	$add_personne->execute($DonneesUtilisateur);

	$IdPersonne = $DonneesUtilisateur['id'];	

	$add_compte = $bdd->prepare("
		INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR) 
		VALUES (:id, 'CIT', :nir)");
	$add_compte->execute(array(
		'id' => $IdPersonne.'CIT',
		'nir' => $IdPersonne
		));
}


//Ajoute une entrée Compte
function AjouterCompte(PDO $bdd, string $NIR, string $TypeCompte, string $IdAutRes = null){
	if (empty($IdAutRes)) {
		$add_compte = $bdd->prepare(' INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR) VALUES (:id, :type_compte, :nir)');
		$add_compte->execute(array(
		'id' => $NIR.$TypeCompte,
		'type_compte' => $TypeCompte,
		'nir' => $NIR
		));
	}
	else {
		$add_compte = $bdd->prepare(' INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR, AutoriteResponsable_Id) VALUES (:id, :type_compte, :nir, :aut_res_id)');
		$add_compte->execute(array(
		'id' => $NIR.$TypeCompte,
		'type_compte' => $TypeCompte,
		'nir' => $NIR,
		'aut_res_id' => $IdAutRes
		));	
	}
}

function Rechercher($bdd, $sexe, $year, $regex, $region){
	/**
	La requête SQL permet d'aller récuperer dans la base de donnée
	les informations concernant des utilisateurs en fonction des différents
	choix fait dans le formulaire (et donc les filtres).
					
	A faire : Nombre de tests
	**/
	$recherche = $bdd->query('SELECT * FROM personne INNER JOIN adresse ON personne.Adresse_Id=adresse.Id WHERE personne.Sexe="'. $sexe .'" OR personne.DateNaissance LIKE "'. $year .'%" OR personne.NIR LIKE '. $regex .' OR personne.NomDeFamille LIKE '. $regex .' OR adresse.Region="'. $region .'"');
	/*$recherche = $bdd->query('SELECT *, COUNT(*) AS count_test FROM personne INNER JOIN adresse ON personne.Adresse_Id=adresse.Id INNER JOIN test ON personne.NIR=test.Personne_NIR WHERE personne.Sexe="'. $_POST['sexe'] .'" OR personne.DateNaissance LIKE "'. $_POST['year'] .'%" OR personne.NIR LIKE '. $regex .' OR personne.NomDeFamille LIKE '. $regex .' OR adresse.Region="'. $_POST['region'] .'"');*/

	/**
	Affichage des résultats d'une recherche.
	On affiche les informations concernant un utilisateur
	selon les filtres utilisés et donc la requête SQL executée
	quelques lignes au-dessus.
	**/
	while($display = $recherche->fetch()){
		echo'<tr><td>'. $display['NIR'] . '</td><td>' . $display['NomDeFamille'] . '</td><td>' . $display["NomDUsage"] . '</td><td>'. $display['Prenom1'] . ' '. $display['Prenom2'] . ' '. $display['Prenom3'] . '</td><td>'. $display['DateNaissance'] . '</td><td>'. $display['Sexe'] . '</td><td>'. $display['Courriel'] . '</td><td>'. $display['Portable'] . '</td><td>' . $display['NumeroRue'] . ' ' . $display['Rue'] . ' ' . $display['CodePostal'] . ' ' . $display['Ville'] . ' ' . $display['Region'] . ' ' . $display['Pays'] . '</td><td>'. ' ' . '</td>';
		/**
		Affiche les boutons permettant la modification ou la suppression de l'utilisateur de la ligne correspondante
		à partir d'un $_GET où l'on récupère le Identifiant (NIR) de l'utilisateur.
		Cette partie est seulement accèssible aux administrateurs.
		**/
		if(isset($_SESSION['TypeCompte'])){
			if($_SESSION['TypeCompte']=='ADM'){
				echo'<td><a href="ModifierUtilisateur.php?NIR='. $display['NIR'] .'"><img src="vues/img/modif.png"/></a><a href="SupprimerUtilisateur.php?NIR='. $display['NIR'] .'"><img src="vues/img/suppr.png"/></a></td></tr>';
			}
		}
	}
	//Fermeture de la requête SQL
	$recherche->closeCursor();
}
?>