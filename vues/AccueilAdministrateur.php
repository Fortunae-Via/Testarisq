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
                //Si on a déjà noté les infos dans la session
                if (isset($_SESSION['Infos'])) {
                    $Prenom1=$_SESSION['Infos']['Prenom1'];
                }
                else {
                    $Infos=InfosPersonne($bdd,$_SESSION['NIR']);
                    $_SESSION['Infos'] = $Infos;
                    $Prenom1=$Infos['Prenom1'];
                    
                }
                echo 'Bienvenue ' . $Prenom1 . ' !';
            ?>
        </h2>

        <div class="Conteneur">
            <div class='contenant1'><a href="GestionUtilisateurs.php" class='bouton1'>Gestion des utilisateurs</a></div>
            <div class='contenant2'><a href="#" class='bouton2'>Gestion de la F.A.Q.</a></div>
            <div class='contenant3'><a href="#" class='bouton3'>Gestion des boîtiers Testarisq</a></div>
            <div class='contenant4'><a href="#" class='bouton4'>Test de Contrôle</a></div>
        </div>

    </div>

</body>

</html>
