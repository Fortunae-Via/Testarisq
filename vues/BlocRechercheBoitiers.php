<form method="post" action="GestionBoitiers">
	<!-- Barre de recherche par nom ou identifiant -->
	<h3>Numéro du boitier ou nom de l'autorité responsable :</h3>
	<div class="barre_recherche">
		<?php
			if(!(empty($ChampRecherche))){
				echo "<input id=\"id_name\" name=\"id_name\" value=\"". $ChampRecherche ."\"/>";
			}
			else {
				echo "<input id=\"id_name\" name=\"id_name\"/>";
			}
		?>
		<button type="submit"><img class="search_icon" src="vues/img/search_icon.png" alt="search_icon"/></button>
	</div>

</form>

<!-- Affichage des résultats d'une recherche -->
<h3>Boitiers :</h3>
<!-- L'Affichage des résultats se trouve sous forme de tableaux -->
<table>
	<tr>
		<!-- Nom des colonnes -->
		<th>N° de boitier</th>
		<th>Autorité Responsable</th>
		<th>Options</th>

		<?php AfficherRechercheBoitiers($ResultatsRecherche); ?>
	</tr>
</table>

<div class="nav_pages">
    <?php AffichageNavigationPages ('GestionBoitiers', $PageAffichage, $PageMaximum, $ChampRecherche);?>
</div>
