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

function ACompte($bdd,$NIR,$TypeCompteDemande)
{
	$requete = $bdd->prepare("SELECT * FROM Compte WHERE Personne_NIR = ? AND TypeCompte_Type = ?");
	$requete->execute(array($NIR,$TypeCompteDemande));
	$count = $requete->rowCount();
	if($count!=0) {
		return true;
	}
	else {
		return false;
	}
}

function AfficherTest($bdd,$DateDebut)    //Pour afficher les tests dans l'ordre du plus récent sur la page AccueilCitoyen
{
	$requete = $bdd->prepare("SELECT DateDebut FROM test INNER JOIN personne ON (test.Personne_NIR = personne.NIR) ");
	$requete->execute(array($DateDebut));
	$resultat = $requete->fetch();
	return $DateTest;
}
