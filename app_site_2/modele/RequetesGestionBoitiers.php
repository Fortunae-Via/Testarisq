<?php

function AjouterBoitier(PDO $bdd, string $IdAutRes) : int {
	if (empty($IdAutRes)) {
		$add_boitier = $bdd->prepare('INSERT INTO Boitier () VALUES ()');
		$add_boitier->execute();
	}
	else {
		$add_boitier = $bdd->prepare('INSERT INTO Boitier (AutoriteResponsable_Id) VALUES (?)');
		$add_boitier->execute(array($IdAutRes));	
	}
	$IdInsert = $bdd->lastInsertId();
	return ($IdInsert);
}

function AjouterCapteur(PDO $bdd, string $IdBoitier,string $IdTypeCapteur) {
	$add_capteur = $bdd->prepare('INSERT INTO Capteur (Boitier_Id, TypeCapteur_Id) VALUES (?,?)');
	$add_capteur->execute(array($IdBoitier, $IdTypeCapteur));
}

function SuppBoitier(PDO $bdd, string $IdBoitier) {
	$delete = $bdd->prepare("DELETE FROM Boitier WHERE Id=?");
	$delete->execute(array($IdBoitier));
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

function ListeTypesCapteurs(PDO $bdd): array {
	$query = $bdd->prepare("SELECT * FROM TypeCapteur");
	$query->execute(array());
	return $query->fetchAll();
}






