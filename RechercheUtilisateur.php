<!-- Division principale de la page -->
<div class="div_page">
	<?php
	// Appel de la base de donnée bdd_testarisq
	require("modele/connexionbdd.php");
	// Definition des fonctions de requête SQL
	include('modele/RequetesRecherche.php');

	//On teste si des filtres sont sélectionnés ou si un utilisateur est recherché.
	if(isset($_POST['id_name'])||isset($_POST['sexe'])||isset($_POST['region'])||isset($_POST['year'])||isset($_POST['test_number'])){
	?>
	<!-- Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche-->
		<section>
			<?php
			// Affichage de la structure HTML
			include("vues/VuesRecherche.php");

			// Definition du regex pour le nom recherché
			$regex = '"%' . $_POST['id_name'] . '%"';

			/**
			Appel de la fonction Recherche permettant d'effectuer une recherche
			selon le nom ou identifiant entré ou les filtres sélectionnés
			**/
			Recherche($bdd, $_POST['sexe'], $_POST['year'], $regex, $_POST['region']);
			?>
			</table>
			<!-- Fin du tableaux et de la section d'affichage des résultats -->
		</section>

	<?php
	}else{
		/**
		Cas où aucun des filtres n'a été utilisé et qu'aucun utilisateur n'a été 
		recherché (cas par défaut, ie. arrivé sur la page)
		**/

		// Affichage de la structure HTML
		include("vues/VuesRecherche.php");
	?>
			</table>
		</section>
	<?php
	}
	?>
</div>