<?php
//On teste si des filtres sont sélectionnés ou si un utilisateur est recherché.
if(isset($_POST['id_name'])||isset($_POST['sexe'])||isset($_POST['region'])||isset($_POST['year'])||isset($_POST['test_number'])){

	// Dans ce cas on laisse le formulaire affiché de manière à pouvoir refaire une recherche
	// Affichage de la structure HTML
	include("vues/VuesRecherche.php");

	// Definition du regex pour le nom recherché
	$regex = '"%' . $_POST['id_name'] . '%"';

	/**
	Appel de la fonction Recherche permettant d'effectuer une recherche
	selon le nom ou identifiant entré ou les filtres sélectionnés
	**/
	Rechercher($bdd, $_POST['sexe'], $_POST['year'], $regex, $_POST['region']);
	// Fin du tableaux et de la section d'affichage des résultats

}else{
	/**
	Cas où aucun des filtres n'a été utilisé et qu'aucun utilisateur n'a été 
	recherché (cas par défaut, ie. arrivé sur la page)
	**/

	// Affichage de la structure HTML
	include("vues/VuesRecherche.php");
}
?>