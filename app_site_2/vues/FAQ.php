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
            $Modifications = false;
            require("vues/admin/QuestionsFAQ.php");
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
