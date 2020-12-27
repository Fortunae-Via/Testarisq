<?php

function BonneCombinaison($bdd,$NIR,$mdp)
{
	$requete = $bdd->prepare("SELECT * FROM Personne WHERE NIR = ? AND MotDePasse = ? ");
	$requete->execute(array($NIR,$mdp));
	$count = $requete->rowCount();
	if($count!=0) {
		return true;
	}
	else {
		return false;
	}
}

function ListeComptes($bdd,$NIR)
{
	$requete = $bdd->prepare("SELECT TypeCompte_Type FROM Compte WHERE Personne_NIR = ? ");
	$requete->execute(array($NIR));
	$comptes = $requete->fetch();
	return $comptes;
}

function InfosPersonne($bdd,$NIR)
{
	$requete = $bdd->prepare("SELECT * FROM Personne WHERE NIR = ? ");
	$requete->execute(array($NIR));
	$InfosPersonne = $requete->fetch();
	return $InfosPersonne;
}

function InfosAdresse($bdd,$id)
{
	$requete = $bdd->prepare("SELECT * FROM Adresse WHERE Id = ? ");
	$requete->execute(array($id));
	$InfosAdresse = $requete->fetch();
	return $InfosAdresse;
}

function NIRExiste($bdd,$NIR)
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

function BoitierExiste($bdd,$IdBoitier)
{
	$requete = $bdd->prepare("SELECT * FROM Boitier WHERE Id = ? ");
	$requete->execute(array($IdBoitier));
	$count = $requete->rowCount();
	if($count!=0) {
		return true;
	}
	else {
		return false;
	}
}