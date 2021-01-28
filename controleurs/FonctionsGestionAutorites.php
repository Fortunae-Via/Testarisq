<?php

function CreatePreRempAutRes(array $InfosPersosAutRes, array $AdresseAutRes) {
	//Liste des placeholders pour les champs potentiellement vides
	$Placeholders = array(
        'NumeroRue' => "N°",
        'Rue' => "Rue",					'CodePostal' => "Code Postal",
        'Ville' => "Ville",				'Pays' => "Pays"
    );
	//On crée tous les préremplissages, et si c'est vide on note juste le placeholder
	$ListeChampsAutRes = array('Nom','Type','NumeroRue','Rue','CodePostal','Ville','Pays');
	$PreRemp = array_merge($InfosPersosAutRes,$AdresseAutRes);

	foreach ($ListeChampsAutRes as $champ) {
		if(empty($PreRemp[$champ])) { //donne if(empty($InfosPersosAutRes['Nom'])) etc
			$PreRemp[$champ]="placeholder=\"".$Placeholders[$champ]. "\"";
		}else {
			$PreRemp[$champ]="value=\"".$PreRemp[$champ]. "\"";
		}
	}

	return $PreRemp;
}

function AfficherRechercheAutRes(array $ListeAutRes){

	$ListeTypesFR=array('AUE'=>'Auto-école','POL'=>'Police');

	foreach ($ListeAutRes as $AutRes) {
		echo'<tr><td>'. $ListeTypesFR[$AutRes['Type']] . '</td><td>' . $AutRes['Nom'] . '</td><td>'. $AutRes['NbBoitier'] . '</td>';

		/** Affiche les boutons permettant la modification ou la suppression de l'autres **/
		echo'<td id="OptionsAutRes'. $AutRes['Id'] .'"><a onclick="TransformerChamp('. $AutRes['Id'] .')"><img src="vues/img/edit.png" title="Modifier le nom de l\'autorité responsable"/></a><a href="controleurs/SupprimerBoitier-IdB'. $AutRes['Id'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer cette autorité responsable ?\');"><img src="vues/img/remove.png" title="Supprimer l\'autorité responsable"/></a></td></tr>';
	}
}


function GestionFiltresAutRes() {

	$ListeNomsFiltres = array('Type', 'region', 'nb_boitiers');
	$ListeFiltres = array();
	$ConditionsSQL = "";
	$ConditionsSQLNbBoitiers = "";
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
		if (isset($ListeFiltres['Type'])) {
			$ConditionsSQL .= "AND AR.Type='" . $ListeFiltres['Type'] . "' ";
			$lien .= "&Type=" . $ListeFiltres['Type']; 
		}
		if (isset($ListeFiltres['region'])) {
			$ConditionsSQL .= "AND Adresse.Region='" . $ListeFiltres['region'] . "' "; 
			$lien .= "&region=" . $ListeFiltres['region'];
		}
		if (isset($ListeFiltres['nb_boitiers'])) {
			$ConditionsSQLNbBoitiers .= "HAVING NbBoitier >=" . $ListeFiltres['nb_boitiers'] . " "; 
			$lien .= "&nb_boitiers=" . $ListeFiltres['nb_boitiers'];
		}
	}

	return array($ListeFiltres,$ConditionsSQL,$ConditionsSQLNbBoitiers,$lien);

}