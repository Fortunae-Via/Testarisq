<?php


require_once("../include_path_inc.php");
require_once("jpgraph.php");
require_once("jpgraph_line.php");
require_once("jpgraph_bar.php");

include ('connexionbdd.php');


$requete = $bdd->prepare("
	SELECT valeur, 
	DATE_FORMAT(DateDebut, '%d/%m/%Y') AS DateDebut
	FROM mesure 
	INNER JOIN test ON (test.Id=mesure.Test_Id
	AND Personne_NIR=?) 
	INNER JOIN Capteur ON Capteur.Id= Mesure.Capteur_Id
	WHERE TypeCapteur_Id=1");
	$requete->execute(array($_GET['Id']));
	while ($donnees=$requete->fetch())
	{
		$Test[]=$donnees['DateDebut'];
		$TempsReac[]=round($donnees['valeur'],2);
	}


$largeur = 600;
$hauteur = 300;

// Initialisation du graphique
$graphe = new Graph($largeur, $hauteur);
// Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
// Valeurs min et max seront determinees automatiquement
$graphe->setScale("textlin");

// Creation de l'histogramme
$bplot = new BarPlot($TempsReac);
// Ajout de l'histogramme au graphique
$graphe->add($bplot);

//Couleur des barres
$bplot->SetFillColor('#3388BB');

// Ajout du titre du graphique
$graphe->title->set("Temps de réactions aux sons et lumières des derniers tests");

$graphe->xaxis->SetTickLabels($Test);

//Donner des titres aux axes
$graphe->xaxis->title->Set('Date des tests','middle');
$graphe->yaxis->title->Set('Temps de réaction en secondes','middle');

//Espace des titres
//$graphe->xaxis->title->SetMargin(7);
//$graphe->yaxis->title->SetMargin(6);

// Affichage du graphique
$graphe->stroke();
?>