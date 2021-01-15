<form method="post">
	<!-- Barre de recherche par nom ou identifiant -->
	<h3>Identifiant ou nom du conducteur :</h3>
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

	<div class="filtres">
		<label for="option">Filtrer par :</label>

		<div class="div_select_filtres">
			<!-- Filtrer par sexe -->
			<select name="sexe" size="1">
				<option selected value="?">Sexe</option>
				<option value="Homme">Homme</option>
				<option value="Femme">Femme</option>
				<option value="Autre">Autre</option>
				<option value="Non-précisé">Non-précisé</option>
			</select>

			<!-- Filtrer par region -->
			<select name="region">
				<option selected value="?">Région</option>
				<?php
				/**
				Appel à la fonction Region() provenant de modele/RequêteRecherche.php
				permettant l'affichage des régions sélectionnables.
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
				<option selected value="?">Année de naissance</option>
				<?php
				for($i=date("Y"); $i>=1900; $i--){
					echo'<option value="'. $i .'">'. $i .'</option>';
				}
				?>
			</select>

			<!-- Filtre par nombre de test passés -->
			<select name="test_number">
				<option selected value="?">Nombre de tests passés</option>
				<option value="0">Au moins 1 test</option>
				<?php
				for($i=2; $i<=20; $i++){
					echo"<option value=\"". $i ."\">Au moins " . $i . " tests</option>";
				}
				?>
			</select>
		</div>
	</div>
</form>

<!-- Affichage des résultats d'une recherche -->
<h3>Utilisateurs :</h3>
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
		C'est-à-dire que lorsqu'un administrateur est connecté,
		il a accès aux options alors qu'un officier ou une auto-école non.
		**/
		if(isset($_SESSION['TypeCompte'])){
			if($_SESSION['TypeCompte']=='ADM'){
				echo'<th>Options</th>';
			}
		}

		//On teste si des filtres sont sélectionnés ou si un utilisateur est recherché.
		if(isset($_POST['id_name'])){

			// Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche

			// Definition du regex pour le nom recherché
			$regex = '"%' . $_POST['id_name'] . '%"';
			
			/**
			Appel de la fonction Recherche permettant d'effectuer une recherche
			selon le nom ou identifiant entré ou les filtres sélectionnés
			**/
			Rechercher($bdd, $filtres['sexe'], $filtres['year'], $regex, $filtres['region']);
			// Fin du tableau et de la section d'affichage des résultats
		}
		?>
	</tr>
</table>
