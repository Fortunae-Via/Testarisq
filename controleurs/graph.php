<?php


require_once("../include_path_inc.php");
require_once("../jpgraph/jpgraph.php");
require_once("../jpgraph/jpgraph_line.php");
require_once("../jpgraph/jpgraph_bar.php");

include ('../modele/connexionbdd.php');


require ('../modele/RequeteGraph.php');


$largeur = 1200;
$hauteur = 600;

// Initialisation du graphique
$graphe = new Graph($largeur, $hauteur);
// Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
// Valeurs min et max seront determinees automatiquement
$graphe->setScale("textlin");

//Couleur de fond Testarisq
$graphe->SetBackgroundGradient('#383838','#383838');

//Marges (gauche, droite,haut,bas)
$graphe->SetMargin(100,20,20,70);

// Creation de l'histogramme
$bplot = new BarPlot($TempsReac);

// Ajout de l'histogramme au graphique
$graphe->add($bplot);

$graphe->ygrid->SetFill(false);

//Couleur des barres
$bplot->SetFillColor('#00A3B8');

$graphe->xaxis->SetTickLabels($Test);
$graphe->xaxis->SetColor("white");
$graphe->xaxis->SetFont(FF_ARIAL,FS_NORMAL,20);
$graphe->yaxis->SetColor("white");
$graphe->yaxis->SetFont(FF_ARIAL,FS_NORMAL,20);

//Donner des titres aux axes
$graphe->xaxis->title->Set('Date des tests','middle');
$graphe->xaxis->title->SetColor("white");
$graphe->xaxis->title->SetFont(FF_ARIAL,FS_NORMAL,20);
$graphe->yaxis->title->Set('Temps de réaction en secondes','middle');
$graphe->yaxis->title->SetColor("white");
$graphe->yaxis->title->SetFont(FF_ARIAL,FS_NORMAL,20);
$graphe->yaxis->title->SetMargin(40);

//Espace des titres
//$graphe->xaxis->title->SetMargin(7);
//$graphe->yaxis->title->SetMargin(6);

// Affichage du graphique
$graphe->stroke();
?>