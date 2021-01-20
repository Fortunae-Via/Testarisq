<?php

function AffichageAccueil($TypeCompte) 
{
	switch($TypeCompte) {

		case 'CIT':		//Citoyen
			require 'controleurs/AccueilCitoyen.php'; 
			break;

		case 'AUE':		//Auto-école
			require 'controleurs/AccueilAutorite.php'; 
			break;

		case 'POL':		//Police
			require 'controleurs/AccueilAutorite.php'; 
			break;

		case 'ADM':		//Admin
			require 'controleurs/AccueilAdministrateur.php'; 
			break;
	}
}