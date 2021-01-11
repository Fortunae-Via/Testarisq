<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil.php');
}



        try
        {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=bdd_testarisq;charset=utf8', 'root', '');
        /*$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);*/
        
        }
        catch(Exception $e)
        {
            
        // En cas d'erreur, on affiche un message et on arrête tout
           die('Erreur : '.$e->getMessage());
        }
                /*$req = $bdd->prepare("INSERT INTO 'nom de la bdd' SET username = ?, password = ?, email = ?");
                 --> dans la page register */

?>


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
    <?php include("php/header.php"); ?>

    <div class="div_page">

        <header>
            <h2>Les questions qui reviennent souvent :</h2>
        </header>

        <div class="bloc_questions">
            <!--<div class="question 1">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
                    <h3>Pourquoi n'ai-je pas reçu les résultats de mes tests ?</h3>
                    <img id='fleche1' class="fleche_expand_down" src="img/expand.png" alt="fleche_expand"/>
                </button>
                <p id="rep1" class="dropdown-content" style="display: block;">
                    Bonjour, dans ce cas, il se peut que le résultat soit toujours en cours de traitement et qu'il n'ait pas été téléchargé. Veuillez patienter. <br>
                    Si vous ne recevez pas le message pendant une longue période, veuillez consulter notre service technique compétent:<br>
                    Email:fortunae.via@fortunaevia.fr ;<br> 
                    numéro de téléphone:0607080910 
                </p>
            </div>
            <div class="question 2">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
                    <h3>Comment vérifier mes résultats de tests antérieurs?</h3>
                    <img id='fleche2' class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
                </button>
                <p id="rep2" class="dropdown-content" style="display: none;">
                   Vous pouvez vous connecter à «Mon compte» et rechercher «Enregistrements antérieurs» pour voir.
                </p>
            </div>
            <div class="question 3">
                <button class="bandeau_question" onClick=" BasculerAffichage('rep3'); BasculerClasse('fleche3','fleche_expand','fleche_expand_down') ">
                    <h3>Que faire si j'oublie mon mot de passe?</h3>
                    <img id='fleche3' class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
                </button>
                <p id="rep3" class="dropdown-content" style="display: none;">
                    Si vous perdez votre mot de passe, vous pouvez suivre les étapes ci-dessous pour créer un nouveau mot de passe:<br>
                    1. De notre site Web<br>
                    Allez dans la section «Connexion»<br>
                    Cliquez sur «Mot de passe oublié? »<br>
                    Entrez votre adresse e-mail et cliquez sur «Confirmer»<br>
                    2.Depuis notre site Web mobile / application mobile<br>
                    Cliquez sur «Mon compte»<br>
                    Entrez votre profil<br>
                    Cliquez sur «Mot de passe oublié? »<br>
                    Vous recevrez un email automatisé vous permettant de créer un nouveau mot de passe
                </p>
            </div>-->
            
               <?php            $reponse = $bdd->prepare('select * from elementfaq');  
                                $execute = $reponse->execute();
                                $faq = $reponse->fetchAll();
                                foreach ($faq as $key) {?>
                                    <?php $id = $key['Id'];
                                    $rep = "rep".$id;
                                    $fleche = "fleche".$id;
                                    $question = "question ".$id;?>
                                    
                                    <div class=<?=$question?>>
                                        <button class="bandeau_question" onClick=" BasculerAffichage('<?=$rep?>'); BasculerClasse(<?=$fleche?>,'fleche_expand','fleche_expand_down') ">
                                            <h3><?=$key['Question']?></h3>
                                            <img id=<?=$fleche?> class="fleche_expand" src="img/expand.png" alt="fleche_expand"/>
                                        </button>
                                        <p id='<?=$rep?>' class="dropdown-content" style="display: none;">
                    <?=$key['Reponse']?>
                </p></div>
                                   
                               <?php }
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
