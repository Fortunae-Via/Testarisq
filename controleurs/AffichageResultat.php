<?php

require 'modele/RequetesTest.php';
require 'modele/connexionbdd.php';

require_once("include_path_inc.php");
require_once("jpgraph.php");
require_once("jpgraph_line.php");

$apte = Apte($bdd,$_SESSION['NIR']);
$ResultatReactivite = AfficherRéactivité($bdd,$_GET['Id_Resultat']);

require '../resultat_test_1.php';