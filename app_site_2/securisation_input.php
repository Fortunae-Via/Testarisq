<?php
            
function securisation($donnees){
    $donnees=trim($donnees);
    $donnees=stripslashes($donnees);
    $donnees=strip_tags($donnees);
    return $donnees;
}

