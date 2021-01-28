<?php

function AjouterAdresse(PDO $bdd, array $InfosAdresse): int {
	$add_adresse = $bdd->prepare('
		INSERT INTO adresse (NumeroRue, Rue, CodePostal, Ville, Region, Pays) 
		VALUES (:numeroRue, :rue, :code, :ville, :region, :pays)');
	$add_adresse->execute($InfosAdresse);
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id de l'adresse créée
	return ($IdInsert);
}

//Ajoute une autorité
function AjouterAutRes(PDO $bdd, array $DonneesAutorite){
	$add_autorite = $bdd->prepare('
		INSERT INTO AutoriteResponsable (Type, Nom, Adresse_Id) 
		VALUES (:type, :nom, :id_adresse)');
	$add_autorite->execute($DonneesAutorite);

}

function TailleRechercheAutRes(PDO $bdd, string $regex = '%%', string $conditionsfiltres="", string $conditionsfiltrenbboitiers="") : int {
	$requete = 'SELECT COUNT(Boitier.Id) AS NbBoitier FROM AutoriteResponsable as AR JOIN Adresse ON AR.Adresse_Id=Adresse.Id LEFT JOIN Boitier ON Boitier.AutoriteResponsable_Id = AR.Id WHERE AR.Nom LIKE :regex ' . $conditionsfiltres . 'GROUP BY AR.Id '. $conditionsfiltrenbboitiers ;
	$search = $bdd->prepare($requete);
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->execute();
	$count = $search->rowCount();
	return $count;
}

function RechercherAutRes(PDO $bdd, int $page, string $regex = '%%', string $conditionsfiltres="", string $conditionsfiltrenbboitiers="") : array {
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
	$requete = 'SELECT AR.Id, Type, Nom, COUNT(Boitier.Id) AS NbBoitier FROM AutoriteResponsable as AR JOIN Adresse ON AR.Adresse_Id=Adresse.Id LEFT JOIN Boitier ON Boitier.AutoriteResponsable_Id = AR.Id WHERE AR.Nom LIKE :regex ' . $conditionsfiltres . 'GROUP BY Id ' . $conditionsfiltrenbboitiers . 'ORDER BY AR.Nom ASC LIMIT 10 OFFSET :offset' ;
	$search = $bdd->prepare($requete);
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$search->execute();
	return $search->fetchAll();
}

function ModifierNomAutRes(PDO $bdd, string $IdAutRes, string $NomAutRes) {
	$update = $bdd->prepare('
		UPDATE AutoriteResponsable 
		SET Nom = ?
		WHERE Id = ?');
	$update->execute(array($NomAutRes, $IdAutRes));
}


function MiseAJour_adresse($bdd, $numeroRue, $rue, $code, $ville, $pays, $region, $id, $NIR){
	// Mise à Jour de la table "adresse"
	if($id!=0){
		if(!empty($region)){
			$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=?, Region=? WHERE Id=?');
			$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $region, $id));
		}else{
			$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=? WHERE Id=?');
			$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $id));
		}
	}else{
		$InfosAdresse = array($numeroRue, $rue, $code, $ville, $region, $pays);
		$Id_Adresse=AjouterAdresse($bdd, $InfosAdresse);

		$update = $bdd->prepare('UPDATE autorite SET Adresse_Id=? WHERE NIR=?');
		$update->execute(array($Id_Adresse, $NIR));
	}
	$update->closeCursor();
}

//
function ListeAdresses1Autorite(PDO $bdd) {
	$select  = $bdd->prepare('
	SELECT Adresse.Id as Id, COUNT(autoriteresponsable.Id) as NombreAutorité
	FROM `Adresse` 
	JOIN autoriteresponsable on autoriteresponsable.Adresse_Id=Adresse.Id
	GROUP BY (Adresse.Id)
	HAVING NombreAutorité=1');
	$select->execute();
	$ListeAdresses =array();
	while ($adresse = $select->fetch()) {
		array_push($ListeAdresses, $adresse['Id']);
	}
	return $ListeAdresses;
}

function SupprimerUtilisateur($bdd, $NIR){
	/**
	Suppression de l'Autorité où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table autorite par une clé étagère.
	**/
	
	$requete = $bdd->prepare("SELECT Adresse_Id FROM AutoriteResponsable WHERE Id = ? ");
	$requete->execute(array($id));
	$Adresseautorite = $requete->fetch()['Adresse_Id'];

	//Si ce n'est pas l'adresse 0 qu'on attribue à tout ceux qui ne remplisse pas les champs adresse
	if ($Adresseautorite != 0){
		$ListeAdresses1autorite = ListeAdresses1autorite($bdd);
		//Si l'adresse n'appartient qu'à cette autorite, on peut la supprimer
		if (in_array($Adresseautorite, $ListeAdresses1autorite)) {
			$supprimer = $bdd->prepare('DELETE FROM Adresse WHERE Id=?');
			$supprimer->execute(array($Adresseautorite));
		}
	}

	$supprimerautorite = $bdd->prepare('DELETE FROM AutoriteResponsable WHERE Id=?');
	$supprimerautorite->execute(array($id));
}
