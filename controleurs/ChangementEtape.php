<?php

session_start(); 

// On récupère les données du formulaire
$NumeroTest = $_POST['NumeroTest'];
$EtapeTest = $_POST['EtapeTest'];

require 'FonctionsTest.php'; 

$EtapeSuivante = EtapeSuivante($NumeroTest,$EtapeTest) ;
$NumeroTestSuivant = $EtapeSuivante[0];
$EtapeTestSuivante = $EtapeSuivante[1];

// On passera à l'étape ou au test suivant sur la page Test
$_SESSION['NumeroTest'] = $NumeroTestSuivant ;
$_SESSION['EtapeTest'] = $EtapeTestSuivante ;

header('Location: ../Test.php');




