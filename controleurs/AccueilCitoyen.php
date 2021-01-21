<?php

$Prenom1=$_SESSION['Infos']['Prenom1'];

require 'modele/RequetesTest.php';
require 'modele/connexionbdd.php';

$requete = RequeteDerniersTestsPersonne($bdd,$_SESSION['NIR']);


//Récupérer les infos sur les derniers tests passés etc
require 'vues/AccueilCitoyen.php'; 
