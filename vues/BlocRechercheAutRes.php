<form method="post" action="GestionAutoritesResponsables">
	<!-- Barre de recherche par nom ou identifiant -->
	<h3>Identifiant ou nom du autorité :</h3>
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

	<div class="filtres">
		<label for="option">Filtrer par :</label>

		<div class="div_select_filtres">
			<!-- Filtrer par Type -->
			<select name="Type" size="1">
				<option selected value="">Type</option>
				<?php
				if (isset($ListeFiltres['Type']) AND $ListeFiltres['Type'] == 'AUE') {
					echo"<option value='AUE' selected>Auto-école</option>";
				}
				else {
					echo"<option value='AUE'>Auto-école</option>";
				}
				if (isset($ListeFiltres['Type']) AND $ListeFiltres['Type'] == 'POL') {
					echo"<option value='POL' selected>Police</option>";
				}
				else {
					echo"<option value='POL'>Police</option>";
				}
				?>
			</select>

			<!-- Filtrer par region -->
			<select name="region">
				<option selected value="">Région</option>
				<?php
				foreach ($ListeRegionFR as $Region) {
					if (isset($ListeFiltres['region']) AND $Region['Region'] == $ListeFiltres['region']) {
						echo"<option value=\"". $Region['Region'] ."\" selected>" . $Region['Region'] . "</option>";
					}
					else {
						echo"<option value=\"". $Region['Region'] ."\">" . $Region['Region'] . "</option>";
					}
				}
				?>
			</select>
			
			<!-- Filtre par nombre de boitier passés -->
			<select name="nb_boitiers">
				<option selected value="">Nombre de boîtiers possédés</option>
				<?php
				if (isset($ListeFiltres['nb_boitiers']) AND $ListeFiltres['nb_boitiers'] == 1) {
						echo"<option value=\"1\" selected>Au moins 1 boitier</option>";;
					}
					else {
						echo"<option value=\"1\">Au moins 1 boitier</option>";
					}

				for($Nbboitiers=2; $Nbboitiers<=20; $Nbboitiers++){
					if (isset($ListeFiltres['nb_boitiers']) AND $Nbboitiers == $ListeFiltres['nb_boitiers']) {
						echo"<option value=\"". $Nbboitiers ."\" selected>Au moins " . $Nbboitiers . " boîtiers</option>";
					}
					else {
						echo"<option value=\"". $Nbboitiers ."\">Au moins " . $Nbboitiers . " boîtiers</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
</form>

<!-- Affichage des résultats d'une recherche -->
<h3>Autorités :</h3>
<?php if ($Vide == false) { ?>
	<!-- L'Affichage des résultats se trouve sous forme de tableaux -->
	<table>
		<tr>
			<!-- Nom des colonnes -->
			<th>Type</th>
			<th>Nom</th>
			<th>Nombre de boîtiers possédés</th>
			<th>Options</th>
		</tr>	
		<?php AfficherRechercheAutRes($ResultatsRecherche); ?>
	</table>
<?php 
}
else {
	echo('<p style="text-align:center;">Aucun résultat.</p>');
}

if ($PageMaximum > 1) {
	echo ('<div class="nav_pages">');
	    AffichageNavigationPages ('GestionAutoritesResponsables', $PageAffichage, $PageMaximum, $ChampRecherche,$lienSQLFiltres);
	echo('</div>');
}
?>
