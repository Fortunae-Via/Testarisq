<?php

function TypeComptePersonneFR(string $Abreviation) : string {
	switch($Abreviation) {

		case 'CIT':		//Citoyen
			return 'Citoyen';

		case 'AUE':		//Auto-école
			return 'Auto-école'; 

		case 'POL':		//Police
			return 'Agent de Police'; 

		case 'ADM':		//Admin
			return 'Administrateur'; 
	}
}
            
function securisation_totale($donnees){
    $donnees=trim($donnees);
    $donnees=stripslashes($donnees);
    $donnees=strip_tags($donnees);
    return $donnees;
}
       
function securisation_partielle($donnees){
    $donnees=stripslashes($donnees);
    $donnees=strip_tags($donnees);
    return $donnees;
}

