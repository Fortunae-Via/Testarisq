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

    <!--Header-->
    <?php include("vues/Header.php");?>

    <div class="div_page">
        <h2 class="bienvenue">
            <?php echo 'Bienvenue ' . $Prenom1 . ' !'; ?>
        </h2>

        <p class='PasTest'><?php 
        echo TestVide($bdd,$_SESSION['NIR']); 
        if ($requete->fetch())
        { ?>
        </p>

        <section>
            <header>
                <h3 class='DerniersResultats'>Vos derniers résultats :</h3>
             </header>
                    
            <div class="graph">
                <h4>Temps de réaction aux sons et lumières des derniers tests (en secondes)</h4>
                <?php

                echo "<img src='controleurs/graph.php?Id=".$_SESSION['NIR']."'>";
                ?> 
            </div>

            <div class="tests">

                <?php // TestVide($bdd,$_SESSION['NIR']) ?>


                <?php 
                while ($Test = $requete->fetch())
                {
                    echo '<a class="bouton" href="ResultatTest-t'.$Test['Id'].'">Test du '.$Test["DateDebut"].'</a>';
                }
                ?>
            </div>
        </section>
    </div>

    <?php
    }
    else
    {
        echo 'Veuillez vous rapprochez d\'une auto-école pour passer un test.';
    }?>

</body>
</html>