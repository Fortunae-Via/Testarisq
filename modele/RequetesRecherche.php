<?php
function Region($bdd){
	$region = $bdd->query('SELECT Region FROM regionfr');
	while($display = $region->fetch()){
		echo'<option value="'. $display['Region'] .'">'. $display['Region'] .'</option>';
	}
	$region->closeCursor();
}



?>