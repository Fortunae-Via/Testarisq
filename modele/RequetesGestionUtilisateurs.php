<?php

function AjouterAdresse(PDO $bdd, array $InfosAdresse): int {
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

function TailleRechercheUtilisateur(PDO $bdd, string $regex = '%%', string $conditionsfiltres="", string $conditionsfiltrenbtests="") : int {
	$requete = 'SELECT COUNT(Test.Id) AS NbTest FROM Personne JOIN Adresse ON Personne.Adresse_Id=Adresse.Id LEFT JOIN Test ON Test.Personne_NIR = Personne.NIR WHERE (Personne.NIR LIKE :regex OR Personne.NomDeFamille LIKE :regex) ' . $conditionsfiltres . 'GROUP BY NIR '. $conditionsfiltrenbtests ;
	$search = $bdd->prepare($requete);
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->execute();
	$count = $search->rowCount();
	return $count;
}

function RechercherUtilisateur(PDO $bdd, int $page, string $regex = '%%', string $conditionsfiltres="", string $conditionsfiltrenbtests="") : array {
	/**
	La requête SQL permet d'aller récuperer dans la base de donnée
	les informations concernant des utilisateurs en fonction des différents
	choix fait dans le formulaire (et donc les filtres).
	**/
	$offset = $page * 10 - 10;
	/**
	La requête SQL permet d'aller récuperer dans la base de donnée
	les informations concernant des utilisateurs en fonction de la
	recherche demandée
	**/
	$requete = 'SELECT NIR, Prenom1, Prenom2, Prenom3, NomDeFamille, Sexe, DATE_FORMAT(DateNaissance, "%d/%m/%Y") AS DateNaissance , COUNT(Test.Id) AS NbTest FROM Personne JOIN Adresse ON Personne.Adresse_Id=Adresse.Id LEFT JOIN Test ON Test.Personne_NIR = Personne.NIR WHERE (Personne.NIR LIKE :regex OR Personne.NomDeFamille LIKE :regex) ' . $conditionsfiltres . 'GROUP BY NIR ' . $conditionsfiltrenbtests . 'ORDER BY Personne.NomDeFamille, Personne.NIR ASC LIMIT 10 OFFSET :offset' ;
	$search = $bdd->prepare($requete);
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$search->execute();
	return $search->fetchAll();
}

function MiseAJour_personne($bdd, $nom, $nom_usage, $prenom, $prenom_2, $prenom_3, $sexe, $mail, $telephone, $DateNaissance, $NIR){
	// La base de donnée est Mise à Jour (UPDATE) avec les informations du formulaire
	// Mise à Jour de la table "personne"
	$update = $bdd->prepare("UPDATE personne SET NomDeFamille=?, NomDUsage=?, Prenom1=?, Prenom2=?, Prenom3=?, Sexe=?, Courriel=?, Portable=?, DateNaissance=? WHERE NIR=?");
	$update->execute(array($nom, $nom_usage, $prenom, $prenom_2, $prenom_3, $sexe, $mail, $telephone, $DateNaissance, $NIR));
	$update->closeCursor();
}

function MiseAJour_adresse($bdd, $numeroRue, $rue, $code, $ville, $pays, $region, $id){
	// Mise à Jour de la table "adresse"
	if(!empty($region)){
		$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=?, Region=? WHERE Id=?');
		$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $region, $id));
		$update->closeCursor();
	}else{
		$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=? WHERE Id=?');
		$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $id));
		$update->closeCursor();
	}
}

function ModifierAutResCompte(PDO $bdd, string $NIR, string $TypeCompte, string $IdAutRes){
	if (empty($IdAutRes)) {
		$update = $bdd->prepare('
			UPDATE Compte 
			SET AutoriteResponsable_Id = null
			WHERE Personne_NIR = ? AND TypeCompte_Type = ?');
		$update->execute(array($NIR, $TypeCompte));
	}
	else {
		$update = $bdd->prepare('
			UPDATE Compte 
			SET AutoriteResponsable_Id = ?
			WHERE Personne_NIR = ? AND TypeCompte_Type = ?');
		$update->execute(array($IdAutRes, $NIR, $TypeCompte));
	}
}


function SupprimerUtilisateur($bdd, $NIR){
	/**
	Suppression de l'utilisateur où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table personne par une clé étagère.
	**/
	$supprimer = $bdd->prepare('DELETE FROM personne WHERE NIR=?');
	$supprimer->execute(array($NIR));
	$supprimer = $bdd->prepare('DELETE FROM adresse WHERE NIR=?');
	$supprimer->execute(array($NIR));
	$supprimer->closeCursor();
}

function SupprimerCompte($bdd, $NIR){
	/**
	Suppression d'un compte où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table personne par une clé étagère.
	**/
	$supprimer = $bdd->prepare('DELETE FROM compte WHERE Personne_NIR=? AND TypeCompte_Type!="CIT"');
	$supprimer->execute(array($NIR));
	$supprimer->closeCursor();
}

