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
    <?php include("php/header.php"); ?>

    <div class="div_page">
        <h2 class="bienvenue">
            <?php
                //Si on a déjà noté le Prénom1 dans la session
                if (isset($_SESSION['Prenom1'])) {
                    $Prenom1=$_SESSION['Prenom1'];
                }
                else {
                    $Infos=InfosPersonne($bdd,$_SESSION['NIR']);
                    $Prenom1=$Infos['Prenom1'];
                    $_SESSION['Prenom1'] = $Prenom1;
                }
                echo 'Bienvenue ' . $Prenom1 . ' !';
            ?>
        </h2>

        <section>
            <div class="Test1">
                <header>
                    <p>Vos derniers résultats : Test du <a href="#" class='bouton1'>xx/xx/20xx</a></p>
                </header>
                <a href="#"><img src="img/graphs.png" alt="GraphiquesDernierTest"/></a>
            </div>

        	<div class="Test2">
                <a href="#" class='bouton2'>Test du xx/xx/20xx</a>
            </div>

            <div class='Test3'>
                <a href="#" class='bouton3'>Test du xx/xx/20xx</a>
            </div>
        </section>
    
    </div>

</body>
