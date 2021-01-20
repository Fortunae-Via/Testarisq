<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - Gestion F.A.Q.</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="../style/style_commun.css" />
<link rel="stylesheet" href="../style/header.css" />
<link rel="stylesheet" href="../style/FAQ.css" />
<link rel="stylesheet" href="../style/GestionFAQ.css" />
</head>

<body>
    <!-- Header -->
    <?php include("Header.php"); ?>

    <div class="div_page">

        <div class="bloc_questions">

            <h2>Gestion de la F.A.Q. :</h2>

            <?php 

                if ($MessageModif != false){
                    echo"<h3 id='message_ajout'>".$MessageModif."</h3>";
                }

            ?>


            <!-- Premier bloc : ajout d'élément à la FAQ -->

            <div class="question 0" id="bloc_ajout">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep0'); BasculerClasse('fleche0','fleche_expand','fleche_expand_down') ">
                    <h3>Ajouter une question et une réponse à la F.A.Q.</h3>
                    <img id='fleche0' class="fleche_expand_down" src="../vues/img/expand.png" alt="fleche_expand"/>
                </button>
                <div id="rep0" class="dropdown-content" style="display: block;">
                    <form method="post">
                        
                        <div class="ligne">
                            <div class="info">
                                <label for="question">Question :</label>
                            </div>
                            <input name="question"/>
                        </div>
                        <div class="ligne">
                            <div class="info">
                                <label for="reponse" >Réponse :</label>
                            </div>
                            <textarea name="reponse"></textarea>
                        </div>      
                    
                        <div class="bloc_add"> 
                            <button id="add" type="submit">Ajouter à la F.A.Q. </button>
                        </div>
                    </form>
                </div>
            </div>


            <h2>F.A.Q. actuelle :</h2>

            <!-- Les questions de la FAQ -->
            <?php 
            $Modifications = true;
            require("../vues/admin/QuestionsFAQ.php");
            ?>


        </div>

    </div>

    <script type="text/javascript" src="../js/fonctions_generiques.js"></script>
    <script type="text/javascript" src="../js/GestionFAQ.js"></script>

</body>
</html>
