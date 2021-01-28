<?php
function verifstring($string){
	if(!empty($string)){
		return (strlen($string) != strspn($string,"abcdefghijklmnopqrstuvwyxzABCDEFGHIJKLMNOPQRSTUVWYXZ- "));
	}else{
		return false;
	}
}

function verifnum($string){
	if(!empty($string)){
		return (strlen($string) != strspn($string,"1234567890"));
	}else{
		return false;
	}
}


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


 
//Besoin de modele/RequetesGenerales.php et controleurs/FonctionsGenerales.php

function AfficherRechercheUtilisateurs(array $ListeUtilisateurs){

	foreach ($ListeUtilisateurs as $Utilisateur) {
		$ListePrenoms=implode(", ", (array_filter(array($Utilisateur['Prenom1'], $Utilisateur['Prenom2'], $Utilisateur['Prenom3']))));
		$NomPrenoms='<strong>'.$Utilisateur['NomDeFamille'] . '</strong> ' . $ListePrenoms;
		echo'<tr><td>' . $NomPrenoms . '</td><td>'. $Utilisateur['NIR'] . '</td><td>'. $Utilisateur['Sexe'] . '</td><td>'. $Utilisateur['DateNaissance'] . '</td><td>'. $Utilisateur['NbTest'] . '</td>';
		/**
		Affiche les boutons permettant la modification ou la suppression de l'utilisateur de la ligne correspondante
		à partir d'un $_GET où l'on récupère le Identifiant (NIR) de l'utilisateur.
		Cette partie est seulement accèssible aux administrateurs.
		On affiche également le type de compte de l'utilisateur, et un bouton pour supprimer son compte pro s'il en a un.
		**/
		if(isset($_SESSION['TypeCompte']) && $_SESSION['TypeCompte']=='ADM') {
			require("modele/connexionbdd.php");
			$TypeAbr = TypeComptePersonne($bdd, $Utilisateur['NIR']);
			$Type = TypeComptePersonneFR($TypeAbr);

			echo'<td>'.$Type.'</td><td><a href="ModifierUtilisateur-NIR'. $Utilisateur['NIR'] .'"><img src="vues/img/edit-user.png" title="Modifier l\'utilisateur"/></a><a href="controleurs/SupprimerUtilisateur-NIR'. $Utilisateur['NIR'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer cet utilisateur ?\');"><img src="vues/img/remove-user.png" title="Supprimer l\'utilisateur"/></a>';

			//S'il a un compte pro on affiche le bouton pour le supprimer
			if ($TypeAbr == 'CIT') {
				echo '</td></tr>';
			}
			else {
				echo '<a href="controleurs/SupprimerCompte-NIR'. $Utilisateur['NIR'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer le compte "pro" de cet utilisateur ?\');"><img src="vues/img/remove-account.png" title="Supprimer le compte pro de l\'utilisateur"/></a></td></tr>';
			}
		}
		else {
			echo '</tr>';
		}  
	}
}


function GestionFiltres() {

	$ListeNomsFiltres = array('sexe', 'region', 'year', 'test_number');
	$ListeFiltres = array();
	$ConditionsSQL = "";
	$ConditionsSQLNbTests = "";
	$ListeRaccourcisSexe = array('Homme'=>'H', 'Femme'=>'F', 'Autre'=>'A', 'Non-précisé'=>'N');
	$InvListeRaccourcisSexe = array_flip($ListeRaccourcisSexe);
	$lien = "";

	foreach ($ListeNomsFiltres as $filtre) {
		//Si on a effectivement une valeur pour filtrer pour ce filtre en particulier, on la note
		if (isset($_POST[$filtre]) && (!(empty($_POST[$filtre]))) ) {
			$ListeFiltres[$filtre] = $_POST[$filtre];
		}
		else if (isset($_GET[$filtre]) && (!(empty($_GET[$filtre]))) ) {
			//Dans le cas ou est sur un lien avec raccourci pour le sexe
			if ($filtre=='sexe') {
				$ListeFiltres[$filtre] = $InvListeRaccourcisSexe[$_GET[$filtre]];
			}
			else {
				$ListeFiltres[$filtre] = $_GET[$filtre];
			}
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
			$lien .= "&test_number=" . $ListeFiltres['test_number']; 
		}
	}

	return array($ListeFiltres,$ConditionsSQL,$ConditionsSQLNbTests,$lien);

}