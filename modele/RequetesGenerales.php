<?php

function TailleTable(PDO $bdd, string $Table) : int {
	$query = 'SELECT COUNT(*) as Taille FROM ' . $Table;
	$result = $bdd->query($query)->fetch();
	return $result['Taille'];
}

function InfosPersonne(PDO $bdd, string $NIR): array
{
	$requete = $bdd->prepare("SELECT NIR, Prenom1, Prenom2, Prenom3, NomDeFamille, NomDUsage, Sexe, DATE_FORMAT(DateNaissance, '%d/%m/%Y') AS DateNaissance, Courriel, Portable, Adresse_Id FROM Personne WHERE NIR = ? ");
	$requete->execute(array($NIR));
	$InfosPersonne = $requete->fetch();
	return $InfosPersonne;
}

function InfosAdresse(PDO $bdd, int $id): array
{
	$requete = $bdd->prepare("SELECT * FROM Adresse WHERE Id = ? ");
	$requete->execute(array($id));
	$InfosAdresse = $requete->fetch();
	return $InfosAdresse;
}

function ListeComptesPersonne(PDO $bdd, string $NIR) : array
{
	$query = $bdd->prepare("SELECT * FROM Compte WHERE Personne_NIR = ?");
	$query->execute(array($NIR));
	return $query->fetchAll();
}

function TypeComptePersonne(PDO $bdd, string $NIR) : string
{	
	//On cherche le compte pro d'une personne
	$query = $bdd->prepare("SELECT * FROM Compte WHERE Personne_NIR=? AND TypeCompte_Type!='CIT'");
	$query->execute(array($NIR));
	//S'il n'y en a pas c'est un citoyen, sinon on donne son type de compte pro
	$count = $query->rowCount();
	if($count!=0) {
		$ligne = $query->fetch();
		return $ligne['TypeCompte_Type'];
	}
	else {
		return 'CIT';
	}
}

function AutResCompte(PDO $bdd, string $NIR, string $TypeCompte) : string
{
	$query = $bdd->prepare("SELECT * FROM Compte WHERE Personne_NIR = ? AND TypeCompte_Type=?");
	$query->execute(array($NIR,$TypeCompte));
	$ligne = $query->fetch();
	$AutRes =$ligne['AutoriteResponsable_Id'];
	if (empty($AutRes)) {
		return "0";
	}
	else {
		return $AutRes;
	}
}

function ListeAutoritesResponsables(PDO $bdd, string $Type): array {
	$query = $bdd->prepare("SELECT id, nom FROM AutoriteResponsable WHERE Type = ? ORDER BY nom");
	$query->execute(array($Type));
	return $query->fetchAll();
}

function ListeRegionsFR(PDO $bdd): array {
	$query = $bdd->prepare("SELECT Region FROM RegionFR ORDER BY Region");
	$query->execute();
	return $query->fetchAll();
}
