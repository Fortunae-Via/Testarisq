<?php

function PageMaximum (PDO $bdd, string $Table) : int {
	$TailleTable = TailleTable($bdd, $Table);
	return (ceil($TailleTable/10));
} 

function AffichageNavigationPages (string $LienPage, int $PageActuelle, int $PageMaximum) {
	
	//On crée la liste des pages à afficher
	$ListePages = array();
	//S'il y a moins de 5 pages on affiche toutes les pages
	if ($PageMaximum<=5) {
		for ($i=1; $i <= $PageMaximum ; $i++) { 
			$ListePages[]=$i;
		}
	}
	//Si on est dans les 3 premères
	else if ($PageActuelle<=3) {
		for ($i=1; $i <=5 ; $i++) { 
			$ListePages[]=$i;
		}
	}
	//Si on est dans les 3 dernières pages
	else if ($PageActuelle>$PageMaximum-3) {
		for ($i=$PageMaximum-4; $i <= $PageMaximum ; $i++) { 
			$ListePages[]=$i;
		}
	}
	//Sinon on prend les 2 avant et les 2 d'après
	else {
		for ($i=$PageActuelle-2; $i <= $PageActuelle+2 ; $i++) { 
			$ListePages[]=$i;
		}
	}

	//On affiche
	if ($PageActuelle == 1) {
		echo '<a class="desac">&#60; Précédent</a>';
	}
	else {
		echo '<a href="'.$LienPage.'?page='.($PageActuelle-1).'">&#60; Précédent</a>';
	}
	
	foreach ($ListePages as $page) {
		if ($page == $PageActuelle) {
			echo '<a class="active">'.$page.'</a>';
		}
		else {
			echo '<a href="'.$LienPage.'?page='.($page).'">'.$page.'</a>' ;
		}   
	}
	if ($PageActuelle == $PageMaximum) {
		echo '<a class="desac">Suivant &#62;</a>';
	}
	else {
		echo '<a href="'.$LienPage.'?page='.($PageActuelle+1).'">Suivant &#62;</a>';
	}
	
}