<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/AccueilAdministrateur_style.php" />
        <title>TESTARISQ - Accueil</title>
    </head>

<body>

    <!--Header-->
    <?php include("php/header.php"); ?>

    <div class="div_page">
        <h2 class="bienvenue">
        	<?php
        	$Personne_Prenom = 'Utilisateur' ;
        	echo 'Bienvenue ' . $Personne_Prenom . ' !';
        	?>
        </h2>

        <div class="Conteneur">
            <div class='contenant1'><a href="#" class='bouton1'>Gestion des utilisateurs</a></div>
            <div class='contenant2'><a href="#" class='bouton2'>Gestion de la F.A.Q.</a></div>
            <div class='contenant3'><a href="#" class='bouton3'>Test de Contrôle</a></div>
        </div>

    </div>

</body>
