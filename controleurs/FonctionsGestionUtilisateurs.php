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

function AfficherRechercheUtilisateurs(array $ListeUtilisateurs){

	foreach ($ListeUtilisateurs as $Utilisateur) {
		echo'<tr><td>'. $Utilisateur['NIR'] . '</td><td>' . $Utilisateur['NomDeFamille'] . '</td><td>'. $Utilisateur['Prenom1'] . ' '. $Utilisateur['Prenom2'] . ' '. $Utilisateur['Prenom3'] . '</td><td>'. $Utilisateur['DateNaissance'] . '</td><td>'. $Utilisateur['Sexe'] . '</td><td>'. $Utilisateur['NbTest'] . '</td>';
		/**
		Affiche les boutons permettant la modification ou la suppression de l'utilisateur de la ligne correspondante
		à partir d'un $_GET où l'on récupère le Identifiant (NIR) de l'utilisateur.
		Cette partie est seulement accèssible aux administrateurs.
		**/
		if(isset($_SESSION['TypeCompte'])){
			if($_SESSION['TypeCompte']=='ADM'){
				echo'<td><a href="ModifierUtilisateur-NIR'. $Utilisateur['NIR'] .'"><img src="vues/img/edit-user.png" title="Modifier l\'utilisateur"/></a><a href="controleurs/SupprimerUtilisateur-NIR'. $Utilisateur['NIR'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer cet utilisateur ?\');"><img src="vues/img/remove-user.png" title="Supprimer l\'utilisateur"/></a><a href="controleurs/SupprimerCompte-NIR'. $Utilisateur['NIR'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer le compte de cet utilisateur ?\');"><img src="vues/img/remove-account.png" title="Supprimer le compte pro de l\'utilisateur"/></a></td></tr>';
			}
		}
	}
}


function GestionFiltres() {

	$ListeNomsFiltres = array('sexe', 'region', 'year', 'test_number');
	$ListeFiltres = array();
	$ConditionsSQL = "";
	$ConditionsSQLNbTests = "";
	$ListeRaccourcisSexe = array('Homme'=>'H', 'Femme'=>'F', 'Autre'=>'A', 'Non-précisé'=>'N');
	$lien = "";

	foreach ($ListeNomsFiltres as $filtre) {
		//Si on a effectivement une valeur pour filtrer pour ce filtre en particulier, on la note
		if (isset($_POST[$filtre]) && (!(empty($_POST[$filtre]))) ) {
			$ListeFiltres[$filtre] = $_POST[$filtre];
		}
		else if (isset($_GET[$filtre]) && (!(empty($_GET[$filtre]))) ) {
			$ListeFiltres[$filtre] = $_GET[$filtre];
		}
	}
	//On sort avec $ListeFiltres soit vide, soit rempli d'autant qu'il y a de filtre sélectionnés

	if (count($ListeFiltres)!=0) {
		if (isset($ListeFiltres['sexe'])) {
			$ConditionsSQL .= "AND Personne.Sexe='" . $ListeFiltres['sexe'] . "' ";
			$lien .= "&sexe=" . $ListeRaccourcisSexe[$ListeFiltres['sexe']]; 
		}
		if (isset($ListeFiltres['region'])) {
			$ConditionsSQL .= "AND Adresse.Region='" . $ListeFiltres['region'] . "' "; 
			$lien .= "&region=" . $ListeFiltres['region'];
		}
		if (isset($ListeFiltres['year'])) {
			$ConditionsSQL .= "AND Personne.DateNaissance LIKE '" . $ListeFiltres['year'] . "%' ";
			$lien .= "&year=" . $ListeFiltres['year'];
		}
		if (isset($ListeFiltres['test_number'])) {
			$ConditionsSQLNbTests .= "HAVING NbTest >=" . $ListeFiltres['test_number'] . " "; 
		}
	}

	return array($ListeFiltres,$ConditionsSQL,$ConditionsSQLNbTests,$lien);

}