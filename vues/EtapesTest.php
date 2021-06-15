<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - <?=$nom_test?></title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/EtapesTest.css" />
</head>

<body>

    <header class="main-head">
        <img id="logo_header" src="vues/img/logo_testarisq.png"/>
    </header>

    <div class="div_page">

        
        <header class=<?php echo("\"header_corps"." ".$classeheader."\"") ?> >
            <h2><?=$NumeroTestFR?></h2>
            <h1><?=$nom_test?></h1>
        </header>

        <?php 
        switch($EtapeTest) {

            case 1 :        // Étape 1

                echo ("<div class='infostest'>\r");
                echo ($infostest . "\r");
                echo ("</div>\r");
                break;

            case 2 :        // Étape 2
                echo ("<h3>Mesure en cours ...</h3>\r");

                echo ("<div class='infostest'>\r");
                if (isset($MessageErreurValeurRentree)) {
                    if ($MessageErreurValeurRentree == true) {
                        echo ("<p>La valeur n'est pas encore enregistrée. Merci de cliquer sur le bouton ci-dessous lorsque la mesure a bien été prise par le boîtier.</p>\r");
                    } 
                }

                else {
                    echo ("<p>Merci de cliquer sur le bouton ci-dessous lorsque la mesure a bien été prise par le boîtier.</p>\r");
                }
                echo ("</div>\r");
                break;

            case 3 :        // Étape 3
                echo ("<h3>Mesure effectuée.</h3>\r");

                echo ("<div class='infostest'>\r");
                echo ("<p>Le résultat est de ". $Resultat .".</p>\r");
                echo ("</div>\r");
                break;

        }

        ?>

        <footer>

            <form method="post" action="controleurs/ChangementEtape.php"> 
                <div>
                    <?php 
                        echo("<input type=\"hidden\" name=\"NumeroTest\" id=\"NumeroTest\" value=\"".$NumeroTest."\"/>\r");
                        echo("<input type=\"hidden\" name=\"EtapeTest\" id=\"EtapeTest\" value=\"".$EtapeTest."\"/>\r");
                    ?>
                </div>
                <div class="bouton">
                    <button type="submit">

                    <?php 

                        switch($EtapeTest) {

                            case 1 :        // Étape 1 
                                echo("Démarrer le test");
                                break;

                            case 2 :        // Étape 2
                                echo("Mesure effectuée");
                                break;

                            case 3 :        // Étape 3

                                if ($NumeroTest>=5) {
                                    echo("Finir le test");
                                }
                                else {
                                    echo("Test suivant");
                                }
                                break;

                        }

                    ?>

                   </button>
                </div>
            <form>

        </footer>

    </div>

</body>
</html>
