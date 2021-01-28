<?php

function CreatePreRemp(array $InfosPersosAuto, array $AdresseAuto) {
	//Liste des placeholders pour les champs potentiellement vides
	$Placeholders = array(
		'Nom' => "Nom d'autorité",	'Type' => "Type du compte",
        'NumeroRue' => "N°",
        'Rue' => "Rue",					'CodePostal' => "Code Postal",
        'Ville' => "Ville",				'Pays' => "Pays"
    );
	//On crée tous les préremplissages, et si c'est vide on note juste le placeholder
	$ListeChampsAuto = array('Nom','Type','NumeroRue','Rue','CodePostal','Ville','Pays');
	$PreRemp = array_merge($InfosPersosAuto,$AdresseAuto);

	foreach ($ListeChampsAuto as $champ) {
		if(empty($PreRemp[$champ])) { //donne if(empty($InfosPersosAuto['Nom'])) etc
			$PreRemp[$champ]="placeholder=\"".$Placeholders[$champ]. "\"";
		}else {
			$PreRemp[$champ]="value=\"".$PreRemp[$champ]. "\"";
		}
	}

	return $PreRemp;
}

function AfficherRechercheAutorites(array $ListeAutorites){

	foreach ($ListeAutorites as $Autorite) {
		//$ListePrenoms=implode(", ", (array_filter(array($Autorite['Prenom1'], $Autorite['Prenom2'], $Autorite['Prenom3']))));
		$Nom='<strong>'.$Autorite['Nom'];
		echo'<tr><td>' . $Nom . '</td><td>'. $Autorite['Type'] . '</td><td>'. $Autorite['NbBoitier'] . '</td>';
		/**
		Affiche les boutons permettant la modification ou la suppression de l'Autorite de la ligne correspondante
		à partir d'un $_GET où l'on récupère le Identifiant (NIR) de l'Autorite.
		Cette partie est seulement accèssible aux administrateurs.
		**/
		if(isset($_SESSION['TypeCompte'])){
			if($_SESSION['TypeCompte']=='ADM'){
				echo'<td><a href="ModifierAutorite-NIR'. $Autorite['NIR'] .'"><img src="vues/img/edit-Auto.png" title="Modifier l\'Autorite"/></a><a href="controleurs/SupprimerAutorite-NIR'. $Autorite['NIR'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer cet Autorite ?\');"><img src="vues/img/remove-Auto.png" title="Supprimer l\'Autorite"/></a><a href="controleurs/SupprimerCompte-NIR'. $Autorite['NIR'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer le compte de cet Autorite ?\');"><img src="vues/img/remove-account.png" title="Supprimer le compte pro de l\'Autorite"/></a></td></tr>';
			}
		}
	}
}


function GestionFiltres() {

	$ListeAutoFiltres = array('Type', 'region', 'boitier_number');
	$ListeFiltres = array();
	$ConditionsSQL = "";
	$ConditionsSQLNbBoitiers = "";
	$ListeRaccourcisType = array('Agence de Police'=>'POL', 'Auto-école'=>'AUE');
	$InvListeRaccourcisType = array_flip($ListeRaccourcisType);
	$lien = "";


	//On sort avec $ListeFiltres soit vide, soit rempli d'autant qu'il y a de filtre sélectionnés

	if (count($ListeFiltres)!=0) {
		if (isset($ListeFiltres['Type'])) {
			$ConditionsSQL .= "AND autoriteresponsable.Type='" . $ListeFiltres['Type'] . "' ";
			$lien .= "&Type=" . $ListeRaccourcisType[$ListeFiltres['Type']]; 
		}
		if (isset($ListeFiltres['region'])) {
			$ConditionsSQL .= "AND Adresse.Region='" . $ListeFiltres['region'] . "' "; 
			$lien .= "&region=" . $ListeFiltres['region'];
		}
		
		if (isset($ListeFiltres['boitier_number'])) {
			$ConditionsSQLNbBoitiers .= "HAVING NbBoitier >=" . $ListeFiltres['boitier_number'] . " "; 
		}
	}

	return array($ListeFiltres,$ConditionsSQL,$ConditionsSQLNbBoitiers,$lien);

}