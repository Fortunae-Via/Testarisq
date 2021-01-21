<?php

require('modele/RequetesGestionBoitiers.php');


function RechercheBoitiers(PDO $bdd, string $regex){

	$ListeBoitiers = RechercherBoitierBDD($bdd, $regex);

	foreach ($ListeBoitiers as $Boitier) {
		echo'<tr><td>'. $Boitier['IdBoitier'] . '</td><td id="NomAutRes'. $Boitier['IdBoitier'] .'">' . $Boitier['NomAutoriteResponsable'] . '</td>';

		/** Affiche les boutons permettant la modification ou la suppression du boitier **/
		echo'<td id="OptionsAutRes'. $Boitier['IdBoitier'] .'"><a onclick="TransformerChamp('. $Boitier['IdBoitier'] .')"><img src="vues/img/edit.png" title="Modifier le boîtier"/></a><a href="controleurs/SupprimerBoitier.php?IdBoitier='. $Boitier['IdBoitier'] .'" onclick="return confirm(\'Voulez-vous vraiment supprimer ce boîtier ?\');"><img src="vues/img/remove.png" title="Supprimer le boîtier"/></a></td></tr>';
	}
}

function AfficherTypeCapteur(array $ligne) {

	$Id = $ligne['Id'];
	$Type = $ligne['Type'];
	$Unite = $ligne['UniteMesure'];

	echo '<div class="partie capteur '. $Id .'">';
	echo '    <h3>Capteur n°'.$Id. ' :</h3>';
	echo '    <div class="ligne">';
	echo '        <p>Type : '. $Type . '</p>';
	echo '        <p>Unité : '. $Unite . '</p>';
	echo '    </div>';
	echo '</div>';
}

function AjouterBoitierCapteurs(PDO $bdd, string $IdAutRes) {

	$IdBoitier = AjouterBoitier($bdd,$IdAutRes);

	for ($i=1; $i <= 4 ; $i++) { 
		AjouterCapteur($bdd, $IdBoitier, $i); 
	}	

	return $IdBoitier;

}