<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style_commun.css" />
        <link rel="stylesheet" href="style/header.css" />
        <link rel="stylesheet" href="style/AccueilCitoyen.css" />
        <title>TESTARISQ - Accueil</title>
    </head>

<body>

<?php

require 'modele/connexionbdd.php';
include('modele/RequetesTest.php');
include("vues/Header.php");
    if (isset ($_SESSION['NIR']))
    {
?>

    <div class="div_page">
        <h2 class="bienvenue">
            <?php echo 'Bienvenue ' . $Prenom1 . ' !'; ?>
        </h2>

        <div>
            <header>
                <h3 class='DernierResultat'>Vos derniers résultats :</h3>
            </header>
                
            <?php 
            $requete = RequeteDerniersTestsPersonne($bdd,$_SESSION['NIR']);
            while ($resultat = $requete->fetch())
            {
                echo '<a class="bouton" href="resultat_test_1.php?NIR='.$resultat["NIR"].'&Id_Resultat='.$resultat['Id'].'">Test du '.$resultat["DateDebut"].'</a>';
            }
            ?>
        </div>
    </div>
            
    <?php }?>
</body>
</html>
