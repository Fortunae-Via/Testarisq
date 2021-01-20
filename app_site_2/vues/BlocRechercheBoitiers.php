<form method="post">
	<!-- Barre de recherche par nom ou identifiant -->
	<h3>Numéro du boitier ou nom de l'autorité responsable :</h3>
	<div class="barre_recherche">
		<?php
			if(isset($_POST['id_name'])){
				echo "<input id=\"id_name\" name=\"id_name\" value=\"". $_POST['id_name'] ."\"/>";
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

		<?php RechercheBoitiers($bdd, $regex); ?>
	</tr>
</table>
