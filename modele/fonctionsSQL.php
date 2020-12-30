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

function NouveauTest($bdd,$Coordonnees,$NIRConducteur,$IdBoitier) {
	$requete = $bdd->prepare("
	INSERT INTO Test (DateDebut, Position, Personne_NIR, Boitier_Id) 
	VALUES (CURDATE(), :position, :personne_nir, :boitier_id) 
	");
	$requete->execute(array(
		'position' => $Coordonnees, 
		'personne_nir' => $NIRConducteur, 
		'boitier_id' => $IdBoitier
	));
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id du test créé
	return ($IdInsert);
}

function IdCapteur($bdd,$IdBoitier,$IdTypeCapteur)
{
	$requete = $bdd->prepare("SELECT Id FROM Capteur WHERE Boitier_Id = ? AND TypeCapteur_Id = ?");
	$requete->execute(array($IdBoitier,$IdTypeCapteur));
	$IdCapteur = $requete->fetch();
	return $IdCapteur['Id'];
}

function NouvelleMesure($bdd,$IdTest,$IdCapteur) {
	$requete = $bdd->prepare("
	INSERT INTO Mesure (DateHeure, Test_Id, Capteur_Id) 
	VALUES (NOW(), :test_id, :capteur_id) 
	");
	$requete->execute(array(
		'test_id' => $IdTest, 
		'capteur_id' => $IdCapteur
	));
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id de la mesure créée
	return ($IdInsert);
}

function ResultatMesure($bdd,$IdMesure) {
	$requete = $bdd->prepare("
		SELECT M.Valeur, T.UniteMesure 
		FROM Mesure as M
		INNER JOIN Capteur as C ON M.Capteur_Id = C.Id  
		INNER JOIN TypeCapteur AS T ON C.TypeCapteur_Id = T.Id
		WHERE M.Id = ? ");
	$requete->execute(array($IdMesure));
	$donnees = $requete->fetch();
	$ResultatFR = round($donnees['Valeur'],6) . $donnees['UniteMesure'];
	return $ResultatFR;

}

function ValeurRentree($bdd,$IdMesure)
{

	$requete = $bdd->prepare("SELECT Valeur FROM Mesure WHERE Id = ? ");
	$requete->execute(array($IdMesure));
	$resultat = $requete->fetch();
	if(is_null($resultat['Valeur'])) {
		return false;
	}
	else {
		return true;
	}

}


