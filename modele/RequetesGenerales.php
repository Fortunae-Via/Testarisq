<?php


function InfosPersonne(PDO $bdd, string $NIR): array
{
	$requete = $bdd->prepare("SELECT * FROM Personne WHERE NIR = ? ");
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





