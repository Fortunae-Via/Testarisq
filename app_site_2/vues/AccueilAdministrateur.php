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
    <?php include("vues/Header.php"); ?>

    <div class="div_page">
        <h2 class="bienvenue">
        	<?php
                $Prenom1=$_SESSION['Infos']['Prenom1'];
                echo 'Bienvenue ' . $Prenom1 . ' !';
            ?>
        </h2>

        <div class="Conteneur">
            <div><a href="admin/GestionUtilisateurs.php">Gestion des utilisateurs</a></div>
            <div><a href="admin/GestionFAQ.php">Gestion de la F.A.Q.</a></div>
            <div><a href="admin/GestionBoitiers.php">Gestion des boîtiers Testarisq</a></div>
            <div><a href="admin/GestionAutoritesResponsables.php">Gestion des autorités responsables</a></div>
            <div><a href="#">Test de Contrôle</a></div>
        </div>

    </div>

</body>

</html>
