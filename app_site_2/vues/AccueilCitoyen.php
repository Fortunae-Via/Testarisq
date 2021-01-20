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
    <?php include("vues/Header.php"); ?>

    <div class="div_page">
        <h2 class="bienvenue">
            <?php echo 'Bienvenue ' . $Prenom1 . ' !'; ?>
        </h2>

        <section>
            <div class="Test1">
                <header>
                    <p>Vos derniers résultats : Test du <a href="resultat_test_3.php" class='bouton1'>10/12/2020</a></p>
                </header>
                <a href="#"><img src="vues/img/graphs.png" alt="GraphiquesDernierTest"/></a>
            </div>

        	<div class="Test2">
                <a href="resultat_test_2.php" class='bouton2'>Test du 14/11/2020</a>
            </div>

            <div class='Test3'>
                <a href="resultat_test_1.php" class='bouton3'>Test du 01/10/2020</a>
            </div>
        </section>
    
    </div>

</body>
