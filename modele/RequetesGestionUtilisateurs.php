<?php

//Copie de la fonction dans requetes test
function NIRExiste(PDO $bdd, string $NIR) : bool
{
	$requete = $bdd->prepare("SELECT * FROM Personne WHERE NIR = ? ");
	$requete->execute(array($NIR));
	$count = $requete->rowCount();
	if($count!=0) {
		return true;
	}
	else {
		return false;
	}
}

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

function UpdateCompte(PDO $bdd, string $NIR, string $TypeCompte, string $IdAutRes = null){
	if (empty($IdAutRes)) {
		$update_compte = $bdd->prepare('UPDATE compte SET Id=?, TypeCompte_Type=? WHERE Personne_NIR=?');
		$update_compte->execute(array($NIR.$TypeCompte, $TypeCompte, $NIR));
	}
	else {
		$update_compte = $bdd->prepare('UPDATE compte SET Id=?, TypeCompte_Type=?, AutoriteResponsable_Id=? WHERE Personne_NIR=?');
		$update_compte->execute(array($NIR.$TypeCompte, $TypeCompte, $IdAutRes, $NIR));
	}
}

function CompteProExistant(PDO $bdd, string $NIR){
	$exist_compte = $bdd->prepare('SELECT * FROM compte WHERE Personne_NIR=? AND TypeCompte_Type!="CIT"');
	$exist_compte->execute(array($NIR));
	$exist=$exist_compte->fetch();
	if($exist!=null){
		return true;
	}else{
		return false;
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
		$add_adresse = $bdd->prepare('INSERT INTO adresse (NumeroRue, Rue, CodePostal, Ville, Region, Pays) VALUES (?,?,?,?,?,?)');
		$add_adresse->execute($numeroRue, $rue, $code, $ville, $region, $pays);
		$IdInsert = $bdd->lastInsertId();

		$update = $bdd->prepare('UPDATE personne SET Adresse_Id=? WHERE NIR=?');
		$update->execute(array($IdInsert, $NIR));
	}
	$update->closeCursor();
}

/**function AdresseExistante($bdd, $id){
	$adresse=$bdd->prepare('SELECT * FROM adresse WHERE Id=?');
	$adresse->execute(array($id));
	$IsZero=$adresse->fetch();
	if($IsZero['Id']!=0){
		return true;
	}else{
		return false;
	}
}**/

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

//
function ListeAdresses1Personne(PDO $bdd) {
	$select  = $bdd->prepare('
	SELECT Adresse.Id as Id, COUNT(Personne.NIR) as NombreUtilisation
	FROM `Adresse` 
	JOIN Personne on Personne.Adresse_Id=Adresse.Id
	GROUP BY (Adresse.Id)
	HAVING NombreUtilisation=1');
	$select->execute();
	$ListeAdresses =array();
	while ($adresse = $select->fetch()) {
		array_push($ListeAdresses, $adresse['Id']);
	}
	return $ListeAdresses;
}

function SupprimerUtilisateur($bdd, $NIR){
	/**
	Suppression de l'utilisateur où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table personne par une clé étagère.
	**/
	$requete = $bdd->prepare("SELECT Adresse_Id FROM Personne WHERE NIR = ? ");
	$requete->execute(array($NIR));
	$AdressePersonne = $requete->fetch()['Adresse_Id'];

	//Si ce n'est pas l'adresse 0 qu'on attribue à tout ceux qui ne remplisse pas les champs adresse
	if ($AdressePersonne != 0){
		$ListeAdresses1Personne = ListeAdresses1Personne($bdd);
		//Si l'adresse n'appartient qu'à cette personne, on peut la supprimer
		if (in_array($AdressePersonne, $ListeAdresses1Personne)) {
			$supprimer = $bdd->prepare('DELETE FROM Adresse WHERE Id=?');
			$supprimer->execute(array($AdressePersonne));
		}
	}

	$supprimerpersonne = $bdd->prepare('DELETE FROM Personne WHERE NIR=?');
	$supprimerpersonne->execute(array($NIR));

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

