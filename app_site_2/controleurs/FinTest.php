<?php


unset($_SESSION['IdTest']);
unset($_SESSION['IdBoitier']);
unset($_SESSION['NumeroTest']);
unset($_SESSION['EtapeTest']);
unset($_SESSION['MesureEnCours']);

//Calculer le "score" total et l'ajouter dans la bdd

header('Location: ../Accueil.php');