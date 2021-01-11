<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style_commun.css" />
        <link rel="stylesheet" href="style/header.css" />
        <link rel="stylesheet" href="style/AccueilAdministrateur.css" />
        <title>TESTARISQ - Accueil</title>
    </head>

<body>

    <!--Header-->
    <?php include("php/header.php"); ?>

    <div class="div_page">
        <h2 class="bienvenue">
        	<?php
                $Prenom1=$_SESSION['Infos']['Prenom1'];
                echo 'Bienvenue ' . $Prenom1 . ' !';
            ?>
        </h2>

        <div class="Conteneur">
            <div class='contenant1'><a href="GestionUtilisateurs.php" class='bouton1'>Gestion des utilisateurs</a></div>
            <div class='contenant2'><a href="Ajout_faq.php" class='bouton2'>Gestion de la F.A.Q.</a></div>
            <div class='contenant3'><a href="#" class='bouton3'>Gestion des boîtiers Testarisq</a></div>
            <div class='contenant4'><a href="#" class='bouton4'>Test de Contrôle</a></div>
        </div>

    </div>

</body>

</html>
