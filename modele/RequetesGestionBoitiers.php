<?php

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

function RechercherBoitierBDD(PDO $bdd, string $regex) : array {
	/**
	La requête SQL permet d'aller récuperer dans la base de donnée
	les informations concernant des utilisateurs en fonction de la
	recherche demandée
	**/
	$search = $bdd->prepare('
		SELECT B.Id as IdBoitier, AR.Nom as NomAutoriteResponsable
		FROM Boitier as B 
		LEFT JOIN AutoriteResponsable as AR
		ON B.AutoriteResponsable_Id=AR.Id
		WHERE B.Id LIKE ? OR AR.Nom LIKE ?
		ORDER BY B.Id ASC
	');
	$search->execute(array($regex,$regex));
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
	$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=?, Region=? WHERE Id=?');
	$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $region, $id));
	$update->closeCursor();
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






