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
$add_compte = $bdd->prepare("
		INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR) 
		VALUES (:id, 'AUE', :nir)");
	$add_compte->execute(array(
		'id' => $IdPersonne.'AUE',
		'nir' => $IdPersonne
		));

	<div class="filtres">
		<label for="option">Filtrer par :</label>

		<div class="div_select_filtres">
			<!-- Filtrer par Type -->
			<select name="Type" size="1">
				<option selected value="">Type</option>
				<?php
				foreach ($ListeTypes as $Type) {
					if (isset($ListeFiltres['Type']) AND $Type == $ListeFiltres['Type']) {
						echo"<option value=\"". $Type ."\" selected>" . $Type . "</option>";
					}
					else {
						echo"<option value=\"". $Type ."\">" . $Type . "</option>";
					}
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

			<!-- Filtrer par Année (de Naissance) -->
			<!--
			On aurait pu penser à un filtrage par tranche d'âge
			Pour l'instant le choix à été fait de garder le choix d'une année
			précise. La base de donnée étant sensé recenser un nombre important
			de citoyens.
			-->
			
			<!-- Filtre par nombre de boitier passés -->
			<select name="boitier_number">
				<option selected value="">Nombre de boitiers possédés</option>
				<?php
				if (isset($ListeFiltres['boitier_number']) AND $ListeFiltres['boitier_number'] == 1) {
						echo"<option value=\"1\" selected>Au moins 1 boitier</option>";;
					}
					else {
						echo"<option value=\"1\">Au moins 1 boitier</option>";
					}

				for($Nbboitiers=2; $Nbboitiers<=20; $Nbboitiers++){
					if (isset($ListeFiltres['boitier_number']) AND $Nbboitiers == $ListeFiltres['boitier_number']) {
						echo"<option value=\"". $Nbboitiers ."\" selected>Au moins " . $Nbboitiers . " boitiers</option>";
					}
					else {
						echo"<option value=\"". $Nbboitiers ."\">Au moins " . $Nbboitiers . " boitiers</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
</form>

<!-- Affichage des résultats d'une recherche -->
<h3>Autorité :</h3>
<?php if ($Vide == false) { ?>
	<!-- L'Affichage des résultats se trouve sous forme de tableaux -->
	<table>
		<tr>
			<!-- Nom des colonnes -->
			<th>Nom</th>
			<th>Type</th>
			<th>Adresse</th>
			<th>Nombre de boitier<span style="font-size:11px;">(s)</span> possédé<span style="font-size:11px;">(s)</span></th>
			<?php
			/**
			Affichage des options de modification ou de suppression
			d'un compte en fonction du type de compte de
			la session de l'utilisateur.
			C'est-à-dire que lorsqu'un administrateur est connecté,
			il a accès aux options alors qu'un officier ou une auto-école non.
			**/
			if(isset($_SESSION['TypeCompte'])){
				if($_SESSION['TypeCompte']=='ADM'){
					echo'<th>Options</th>';
				}
			}

			/**
			Appel de la fonction permettant d'effectuer une recherche
			selon le nom ou identifiant entré ou les filtres sélectionnés
			**/
			AfficherRechercheAutorites($ResultatsRecherche);
			?>
		</tr>
	</table>
<?php 
}
else {
	echo('<p style="text-align:center;">Aucun résultat.</p>');
}

?>
