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

function RechercherBoitierBDD(PDO $bdd, string $regex, int $page) : array {
	$offset = $page * 10 - 10;
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
		WHERE B.Id LIKE :regex OR AR.Nom LIKE :regex
		ORDER BY B.Id ASC
		LIMIT 10 OFFSET :offset
	');
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$search->execute();
	return $search->fetchAll();
}

function ModifierAutResBoitier(PDO $bdd, string $IdBoitier, string $IdAutRes) {
	if (empty($IdAutRes)) {
		$update = $bdd->prepare('
			UPDATE Boitier 
			SET AutoriteResponsable_Id = null
			WHERE Id = ?');
		$update->execute(array($IdBoitier));
	}
	else {
		$update = $bdd->prepare('
			UPDATE Boitier 
			SET AutoriteResponsable_Id = ?
			WHERE Id = ?');
		$update->execute(array($IdAutRes, $IdBoitier));
	}
}

function ListeTypesCapteurs(PDO $bdd): array {
	$query = $bdd->prepare("SELECT * FROM TypeCapteur");
	$query->execute(array());
	return $query->fetchAll();
}






