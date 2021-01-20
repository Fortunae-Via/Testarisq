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