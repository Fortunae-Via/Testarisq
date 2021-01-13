	<?php
		/**
			Affichage des résultats d'une recherche.
			On affiche les informations concernant un utilisateur
			selon les filtres utilisés et donc la requête SQL executée
			quelques lignes au-dessus.
		**/
		while($display = $recherche->fetch()){
			echo'<tr><th>'. $display['NIR'] . '</th><th>' . $display['NomDeFamille'] . '</th><th>' . $display["NomDUsage"] . '</th><th>'. $display['Prenom1'] . ' '. $display['Prenom2'] . ' '. $display['Prenom3'] . '</th><th>'. $display['DateNaissance'] . '</th><th>'. $display['Sexe'] . '</th><th>'. $display['Courriel'] . '</th><th>'. $display['Portable'] . '</th><th>' . $display['NumeroRue'] . ' ' . $display['Rue'] . ' ' . $display['CodePostal'] . ' ' . $display['Ville'] . ' ' . $display['Region'] . ' ' . $display['Pays'] . '</th><th>'. ' ' . '</th>';
			/**
				Affiche les boutons permettant la modification ou la suppression de l'utilisateur de la ligne correspondante
				à partir d'un $_GET où l'on récupère le Identifiant (NIR) de l'utilisateur.
				Cette partie est seulement accèssible aux administrateurs.
			**/
			if(isset($_SESSION['TypeCompte'])){
				if($_SESSION['TypeCompte']=='ADM'){
					echo'<th><a href="ModifierUtilisateur.php?NIR='. $display['NIR'] .'"><img src="vues/img/modif.png"/></a><a href="SupprimerUtilisateur.php?NIR='. $display['NIR'] .'"><img src="vues/img/suppr.png"/></a></th></tr>';
				}
			}
		}
		//Fermeture de la requête SQL
		$recherche->closeCursor();
	?>
</table>
<!-- Fin  du tableaux et de la section d'affichage des résultats -->