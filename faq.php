<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - F.A.Q.</title> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style/faq_style.php"/>
</head>

<body>
    <!-- Header -->
    <?php include("php/header.php"); ?>

    <div class="div_page">

        <header>
            <h2>Les questions qui reviennent souvent :</h2>
        </header>

        <div class="bloc_questions">
            <div class="question 1">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
                    <h3>Première Question ?</h3>
                    <img id='fleche1' class="fleche_expand_down" src="img/expand.png" alt="fleche_expand"/>
                </button>
                <p id="rep1" class="dropdown-content" style="display: block;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed malesuada massa, at accumsan justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse tempor est erat, bibendum pretium sapien efficitur id. Curabitur nec quam nec enim semper euismod. Fusce cursus vulputate fringilla.<br>
                    Vivamus nec facilisis ex, egestas luctus arcu. Mauris vitae porttitor sem. Nam semper turpis at molestie scelerisque.
                </p>
            </div>
            <div class="question 2">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
                    <h3>Deuxième Question ?</h3>
                    <img id='fleche2' class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
                </button>
                <p id="rep2" class="dropdown-content" style="display: none;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed malesuada massa, at accumsan justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse tempor est erat, bibendum pretium sapien efficitur id. Curabitur nec quam nec enim semper euismod. Fusce cursus vulputate fringilla.<br>
                    Vivamus nec facilisis ex, egestas luctus arcu. Mauris vitae porttitor sem. Nam semper turpis at molestie scelerisque.
                </p>
            </div>
            <div class="question 3">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep3'); BasculerClasse('fleche3','fleche_expand','fleche_expand_down') ">
                    <h3>Troisième Question ?</h3>
                    <img id='fleche3' class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
                </button>
                <p id="rep3" class="dropdown-content" style="display: none;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed malesuada massa, at accumsan justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse tempor est erat, bibendum pretium sapien efficitur id. Curabitur nec quam nec enim semper euismod. Fusce cursus vulputate fringilla.<br>
                    Vivamus nec facilisis ex, egestas luctus arcu. Mauris vitae porttitor sem. Nam semper turpis at molestie scelerisque.
                </p>
            </div>
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
