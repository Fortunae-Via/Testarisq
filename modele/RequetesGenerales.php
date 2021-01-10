<?php


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





