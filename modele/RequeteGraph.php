<?php

$requete = $bdd->prepare("
	SELECT valeur, 
	DATE_FORMAT(DateDebut, '%d/%m/%Y') AS DateDebut
	FROM mesure 
	INNER JOIN test ON (test.Id=mesure.Test_Id
	AND Personne_NIR=?) 
	INNER JOIN Capteur ON Capteur.Id= Mesure.Capteur_Id
	WHERE TypeCapteur_Id=1");

$requete->execute(array($_GET['Id']));
while ($donnees=$requete->fetch()){
	$Test[]=$donnees['DateDebut'];
	$TempsReac[]=round($donnees['valeur'],2);
}

?>
