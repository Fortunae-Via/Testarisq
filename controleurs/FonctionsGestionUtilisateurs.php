<?php

function CreatePreRemp(array $InfosPersosUser, array $AdresseUser) {
	//Liste des placeholders pour les champs potentiellement vides
	$Placeholders = array(
		'NomDUsage' => "Nom d'usage",	'Prenom2' => "2ème Prénom",
		'Prenom3' => "3ème Prénom",		'NumeroRue' => "N°",
		'Rue' => "Rue",					'CodePostal' => "Code Postal",
		'Ville' => "Ville",				'Pays' => "Pays",						
		'Portable' => "xxxxxxxxxx");
	//On crée tous les préremplissages, et si c'est vide on note juste le placeholder
	$ListeChamps = array('NomDeFamille','NomDUsage','Prenom1','Prenom2','Prenom3','Courriel','NumeroRue','Rue','CodePostal','Ville','Pays','Portable');
	$PreRemp = array_merge($InfosPersosUser,$AdresseUser);

	foreach ($ListeChamps as $champ) {
		if(empty($PreRemp[$champ])) { //donne if(empty($InfosPersosUser['NomDUsage'])) etc
			$PreRemp[$champ]="placeholder=\"".$Placeholders[$champ]. "\"";
		}else {
			$PreRemp[$champ]="value=\"".$PreRemp[$champ]. "\"";
		}
	}

	return $PreRemp;
}