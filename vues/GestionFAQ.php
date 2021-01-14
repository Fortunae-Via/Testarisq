<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - Gestion F.A.Q.</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/header.css" />
<link rel="stylesheet" href="style/FAQ.css" />
<link rel="stylesheet" href="style/GestionFAQ.css" />
</head>

<body>
    <!-- Header -->
    <?php include("vues/Header.php"); ?>

    <div class="div_page">

        <div class="bloc_questions">

            <h2>Gestion de la F.A.Q. :</h2>

            <?php 

                if ($message_ajout == true){
                    echo"<h3 id='message_ajout'>Le nouvel élément a bien été ajouté</h3>";
                }

            ?>


            <!-- Premier bloc : ajout d'élément à la FAQ -->

            <div class="question 0" id="bloc_ajout">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep0'); BasculerClasse('fleche0','fleche_expand','fleche_expand_down') ">
                    <h3>Ajouter une question et une réponse à la F.A.Q.</h3>
                    <img id='fleche0' class="fleche_expand_down" src="vues/img/expand.png" alt="fleche_expand"/>
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

    </div>

    <script type="text/javascript" src="js/fonctions_generiques.js"></script>

</body>
</html>
