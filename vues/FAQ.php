<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - F.A.Q.</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/header.css" />
<link rel="stylesheet" href="style/faq.css" />
</head>

<body>
    <!-- Header -->
    <?php include("vues/Header.php"); ?>

    <div class="div_page">

        <header>
            <h2>Les questions qui reviennent souvent :</h2>
        </header>

        <div class="bloc_questions">

            <?php

                foreach ($faq as $key) {

                    $id = $key['Id'];
                    $rep = "rep".$id;
                    $fleche = "fleche".$id;
                    $classequestion = "class=\""."question ".$id."\"";
            ?>
                    
                    <div <?=$classequestion?> >
                        <button class="bandeau_question" onClick=" BasculerAffichage('<?=$rep?>'); BasculerClasse(<?=$fleche?>,'fleche_expand','fleche_expand_down') ">
                            <h3><?=$key['Question']?></h3>
                            <img id=<?=$fleche?> class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
                        </button>
                        <p id='<?=$rep?>' class="dropdown-content" style="display: none;">
                            <?=$key['Reponse']?>
                        </p>
                    </div>
                                   
            <?php 
                }
            ?>

        </div>

        <footer>
            <p1>Vous ne trouvez pas de réponse à votre question?</p1>
            <br>
            <p1>Posez là directement à un administrateur via <a href="PoserQuestion.php"><p2>ce formulaire</p2></a>.</p1>
        </footer>

    </div>

    <script type="text/javascript" src="js/fonctions_generiques.js"></script>

</body>
</html>
