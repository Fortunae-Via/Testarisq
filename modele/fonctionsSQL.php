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


?>