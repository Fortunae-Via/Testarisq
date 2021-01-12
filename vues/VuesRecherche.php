<form method="post">
	<!-- Barre de recherche input="id_name"-->
	<h3>Identifiant ou nom du conducteur :</h3>
	<div class="barre_recherche">
		<input id="id_name" name="id_name"/>
			<button type="submit"><img class="search_icon" src="vues/img/search_icon.png" alt="search_icon"/></button>
	</div>

	<div class="fitres">
		<label for="option">Filtrer par :</label>

		<!-- Filtrer par sexe -->
		<select name="sexe" size="1">
			<option selected hidden>Sexe</option>
			<option value="Homme">Homme</option>
			<option value="Femme">Femme</option>
			<option value="Autre">Autre</option>
			<option value="Non-précisé">Non-précisé</option>
		</select>

		<!-- Filtrer par region -->
		<select name="region">
			<option selected hidden>Région</option>
			<?php
			/**
				On affiche les différents départements dans notre select en tant que option,
				ainsi ils peuvent être selectionnés et envoyer par formulaire
				sous $_POST['region'].
				On fait alors appel à la fonction Region() provenant de modele/RequêteRecherche
			**/
			Region($bdd);
			?>
		</select>

		<!-- Filtrer par Année (de Naissance) -->
		<!--
			On aurait pu penser à un filtrage par tranche d'âge
			Pour l'instant le choix à été fait de garder le choix d'une année
			précise. La base de donnée étant sensé recenser un nombre important
			de citoyens.
		-->
		<select name="year">
			<option selected hidden>Année</option>
				<?php
					for($i=date("Y"); $i>=1900; $i--){
						echo'<option value="'. $i .'">'. $i .'</option>';
					}
				?>
		</select>

		<!-- Filtre par nombre de test passés -->
		<label for="test_number">Nombre de tests passés : </label><input id="test_number" name="test_number"/>	
	</div>
</form>

<!-- Affichage des résultats d'une recherche -->
<h3>Utilisateur :</h3>
<!-- L'Affichage des résultats se trouve sous forme de tableaux -->
<table>
	<tr>
		<!-- Nom des colonnes -->
		<th>Id</th>
		<th>Nom de famille</th>
		<th>Nom d'usage</th>
		<th>Prénom</th>
		<th>Date de naissance</th>
		<th>Sexe</th>
		<th>Courriel</th>
		<th>Téléphone</th>
		<th>Adresse</th>
		<th>Nombre de test<span style="font-size:11px;">(s)</span> passé<span style="font-size:11px;">(s)</span></th>
		<?php
			/**
				Affichage des options de modification ou de suppression
				d'un compte en fonction du type de compte de
				la session de l'utilisateur.
				C'est-à-dire que lorsqu'un administrateur est connecté
				il a accès au options alors qu'un officier ou une auto-école non.
			**/
			if(isset($_SESSION['TypeCompte'])){
				if($_SESSION['TypeCompte']=='ADM'){
					echo'<th>Options</th>';
				}
			}
			?>
	</tr>
