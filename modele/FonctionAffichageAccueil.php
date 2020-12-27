<?php

function AffichageAccueil($TypeCompte) 
{
	switch($TypeCompte) {

		case 'CIT':		//Citoyen
			require 'vues/AccueilCitoyen.php'; 
			break;

		case 'AUE':		//Auto-école
			require 'vues/AccueilAutorite.php'; 
			break;

		case 'POL':		//Police
			require 'vues/AccueilAutorite.php'; 
			break;

		case 'ADM':		//Admin
			require 'vues/AccueilAdministrateur.php'; 
			break;
	}
}