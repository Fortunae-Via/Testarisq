<?php

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

function BoitierExiste(PDO $bdd, int $IdBoitier) : bool
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

function NouveauTest(PDO $bdd, string $Coordonnees, string $NIRConducteur, int $IdBoitier) : int 
{
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

function IdCapteur(PDO $bdd, int $IdBoitier, int $IdTypeCapteur) : int
{
	$requete = $bdd->prepare("SELECT Id FROM Capteur WHERE Boitier_Id = ? AND TypeCapteur_Id = ?");
	$requete->execute(array($IdBoitier,$IdTypeCapteur));
	$IdCapteur = $requete->fetch();
	return $IdCapteur['Id'];
}

function NouvelleMesure(PDO $bdd, int $IdTest, int $IdCapteur, float $Valeur) : int
{
	$requete = $bdd->prepare("
	INSERT INTO Mesure (DateHeure, Valeur, Test_Id, Capteur_Id) 
	VALUES (NOW(), :valeur, :test_id, :capteur_id) 
	");
	$requete->execute(array(
		'valeur' => $Valeur,
		'test_id' => $IdTest, 
		'capteur_id' => $IdCapteur
	));
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id de la mesure créée
	return ($IdInsert);
}

function UniteMesure($bdd, $TypeCapteur) {
	$requete = $bdd->prepare("SELECT UniteMesure FROM TypeCapteur WHERE Id = ? ");
	$requete->execute(array($TypeCapteur));
	$donnees = $requete->fetch();
	return $donnees["UniteMesure"];

}

function TroisDerniersTestsPersonne($bdd,$NIR) //Rends les 3 derniers tests de la bdd
{
	$requete = $bdd->prepare("
		SELECT DATE_FORMAT(DateDebut, '%d/%m/%Y') AS DateDebut, test.Id, personne.NIR 
		FROM test 
		INNER JOIN personne 
		ON test.Personne_NIR = personne.NIR 
		WHERE personne.NIR = ? 
		ORDER BY Id DESC 
		LIMIT 0,3");
    $requete->execute(array($NIR));
	return $requete->fetchAll();                  	
}

function TestVide($bdd,$NIR)
{
	$requete = $bdd->prepare("SELECT Id from test where Personne_NIR=?");
	$requete->execute(array());
}

function DateTest($bdd,$NIR) //Affiche la date du test
{
	$requete = $bdd->prepare("SELECT DateDebut FROM test INNER JOIN personne ON (test.Personne_NIR = personne.NIR AND personne.NIR = ? AND )");

}

function Apte($bdd,$NIR) //si 1 -> apte à conduire, sinon non
{
	$requete=$bdd->prepare("SELECT Resultat FROM test");
	$requete->execute(array());
	if ($requete)
	{
		echo 'Félicitations, vous êtes apte à conduire !';
	}
	else 
	{
		echo 'Vous n\'êtes pas apte à conduire';
	}
}


//Afficher les résultats en fonction du type de capteur
function AfficherRéactivité($bdd,$Id_Resultat)
{
$requete = $bdd->prepare("
	SELECT Valeur 
	FROM mesure 
	INNER JOIN test ON test.Id=mesure.Test_Id 
	INNER JOIN Capteur ON Capteur.Id= Mesure.Capteur_Id
	WHERE test.Id=? AND TypeCapteur_Id=1");
	$requete->execute(array($Id_Resultat));
	while ($donnees=$requete->fetch())
	{
		echo round($donnees['Valeur'],2).' ms. </br>';
	}
	
}

function AfficherFrequenceCard($bdd,$Id_Resultat)
{
$requete = $bdd->prepare("
	SELECT Valeur 
	FROM mesure 
	INNER JOIN test ON test.Id=mesure.Test_Id 
	INNER JOIN Capteur ON Capteur.Id= Mesure.Capteur_Id
	WHERE test.Id=? AND TypeCapteur_Id=2");
	$requete->execute(array($Id_Resultat));
	$donnees=$requete->fetch();
	echo round($donnees['Valeur'],2);
}

function AfficherTemperature($bdd,$Id_Resultat)
{
$requete = $bdd->prepare("
	SELECT Valeur 
	FROM mesure 
	INNER JOIN test ON test.Id=mesure.Test_Id 
	INNER JOIN Capteur ON Capteur.Id= Mesure.Capteur_Id
	WHERE test.Id=? AND TypeCapteur_Id=3");
	$requete->execute(array($Id_Resultat));
	$donnees=$requete->fetch();
	echo round($donnees['Valeur'],2);
}

function AfficherTonalite($bdd,$Id_Resultat)
{
$requete = $bdd->prepare("
	SELECT Valeur 
	FROM mesure 
	INNER JOIN test ON test.Id=mesure.Test_Id 
	INNER JOIN Capteur ON Capteur.Id= Mesure.Capteur_Id
	WHERE test.Id=? AND TypeCapteur_Id=4");
	$requete->execute(array($Id_Resultat));
	$donnees=$requete->fetch();
	echo round($donnees['Valeur'],2);
}
