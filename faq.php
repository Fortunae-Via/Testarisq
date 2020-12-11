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
            <p1><b>Les questions qui reviennent souvent :</b></p1>
        </header>

        <div class="bloc_questions">
            <div class="question 1">
                <div onClick="AfficherQuestion(q1)" class="bandeau_question">
                    <button onClick="AfficherQuestion(q1)">
                        <img class="expand_button" src="img/expand.png" alt="expand_button"/>
                    </button>
                    <h2>Première Question ?</h2>
                </div>
                <p class="dropdown-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed malesuada massa, at accumsan justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse tempor est erat, bibendum pretium sapien efficitur id. Curabitur nec quam nec enim semper euismod. Fusce cursus vulputate fringilla.<br>
                    Vivamus nec facilisis ex, egestas luctus arcu. Mauris vitae porttitor sem. Nam semper turpis at molestie scelerisque.
                </p>
            </div>
            <div class="question 2">
                <div onClick="AfficherQuestion(q2)" class="bandeau_question">
                    <button onClick="AfficherQuestion(q2)">
                        <img class="expand_button" src="img/expand.png" alt="expand_button"/>
                    </button>
                    <h2>Deuxième Question ?</h2>
                </div>
                <p class="dropdown-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed malesuada massa, at accumsan justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse tempor est erat, bibendum pretium sapien efficitur id. Curabitur nec quam nec enim semper euismod. Fusce cursus vulputate fringilla.<br>
                    Vivamus nec facilisis ex, egestas luctus arcu. Mauris vitae porttitor sem. Nam semper turpis at molestie scelerisque.
                </p>
            </div>
            <div class="question 3">
                <div onClick="AfficherQuestion(q3)" class="bandeau_question">
                    <button onClick="AfficherQuestion(q3)">
                        <img class="expand_button" src="img/expand.png" alt="expand_button"/>
                    </button>
                    <h2>Troisième Question ?</h2>
                </div>
                <p class="dropdown-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed malesuada massa, at accumsan justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse tempor est erat, bibendum pretium sapien efficitur id. Curabitur nec quam nec enim semper euismod. Fusce cursus vulputate fringilla.<br>
                    Vivamus nec facilisis ex, egestas luctus arcu. Mauris vitae porttitor sem. Nam semper turpis at molestie scelerisque.
                </p>
            </div>
        </div>

        <footer>
            <p1>Vous ne trouvez pas de réponse à votre question?</p1>
            <br>
            <p1>Posez là directement à un administrateur via <a href="#site d'un administrateur"><p2>ce formulaire</p2></a></p1>
        </footer>

    </div>

</body>
</html>
