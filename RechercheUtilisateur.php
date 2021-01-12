<!-- Division principale de la page -->
<div class="div_page">
	<?php
	// Appel de la base de donnée bdd_testarisq
	require("modele/connexionbdd.php");
	// Appel des fonctions de requête SQL
	include('modele/RequetesRecherche.php');

	//On teste si des filtres sont sélectionnés ou si un utilisateur est recherché.
	if(isset($_POST['id_name'])||isset($_POST['sexe'])||isset($_POST['region'])||isset($_POST['year'])||isset($_POST['test_number'])){
	?>
	<!-- Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche-->
		<section>
			<?php 
				include("vues/VuesRecherche.php");

				// Definition des regex pour le nom recherché.
				$regex = '"%' . $_POST['id_name'] . '%"';

				/**
					La requête SQL permet d'aller récuperer dans la base de donnée
					les informations concernant des utilisateurs en fonction des différents
					choix fait dans le formulaire (et donc les filtres).
					
					A faire : Nombre de tests
				**/
				$recherche = $bdd->query('SELECT * FROM personne INNER JOIN adresse ON personne.Adresse_Id=adresse.Id WHERE personne.Sexe="'. $_POST['sexe'] .'" OR personne.DateNaissance LIKE "'. $_POST['year'] .'%" OR personne.NIR LIKE '. $regex .' OR personne.NomDeFamille LIKE '. $regex .' OR adresse.Region="'. $_POST['region'] .'"');
				/*$recherche = $bdd->query('SELECT *, COUNT(*) AS count_test FROM personne INNER JOIN adresse ON personne.Adresse_Id=adresse.Id INNER JOIN test ON personne.NIR=test.Personne_NIR WHERE personne.Sexe="'. $_POST['sexe'] .'" OR personne.DateNaissance LIKE "'. $_POST['year'] .'%" OR personne.NIR LIKE '. $regex .' OR personne.NomDeFamille LIKE '. $regex .' OR adresse.Region="'. $_POST['region'] .'"');*/
				include("vues/RechercheTableau.php");
			?>	
		</section>

	<?php
	}else{
		/**
			Cas où aucun des filtres n'a été utilisé et qu'aucun utilisateur n'a été 
			rechercher (cas par défaut, ie. arriver sur la page)
		**/
		include("vues/VuesRecherche.php");
	?>
			</table>
		</section>
	<?php
	}
	?>
</div>