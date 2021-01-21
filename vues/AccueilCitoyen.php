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

        <section>
            <div class="Test">
                <header>
                    <h3 class='DernierResultat'><?php echo 'Vos derniers résultats : '; ?></h3><br>
                    
                        <?php 
                        $requete = AfficherTest($bdd,$_SESSION['NIR']);
                        while ($resultat = $requete->fetch())
                        {
                            echo '<p class="bouton"> Test du '.$resultat["DateDebut"].' : <a href="resultat_test_1.php?NIR='.$resultat["NIR"].'&Id_Resultat='.$resultat['Id'].'">Détail résultats </a></p></br></br></br>';
                        }
                        ?>
                    
    <?php }?>
</body>
