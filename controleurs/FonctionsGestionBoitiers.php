<?php

require('modele/RequetesGestionBoitiers.php');


function RechercheBoitiers(PDO $bdd, string $regex){

	$ListeBoitiers = RechercherBoitierBDD($bdd, $regex);

	foreach ($ListeBoitiers as $Boitier) {
		echo'<tr><td>'. $Boitier['IdBoitier'] . '</td><td>' . $Boitier['NomAutoriteResponsable'] . '</td>';

		/** Affiche les boutons permettant la modification ou la suppression du boitier **/
		echo'<td><a href="ModifierBoitier.php?IdBoitier='. $Boitier['IdBoitier'] .'"><img src="vues/img/modif.png"/></a><a href="controleurs/SupprimerBoitier.php?NIR='. $Boitier['IdBoitier'] .'"><img src="vues/img/suppr.png"/></a></td></tr>';
	}
}