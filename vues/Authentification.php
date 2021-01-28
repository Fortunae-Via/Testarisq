<!DOCTYPE html>
<html>
    <head>
        <title>TESTARISQ</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style/style_commun.css" />
        <link rel="stylesheet" href="style/header.css" />
        <link rel="stylesheet" href="style/Authentification.css" />
    </head>
    <body>
        <div class="div_page">
            <img src="vues/img/logo_testarisq_circle.png" alt="logo_testarisq_circle"/>
            <button onclick="window.location.href='#connexion'">Authentification</button>
            <div id="connexion">
                <?php
                    if ($mdp_incorrect==true) {
                ?>
                <h3>Identifiant ou mot de passe incorrect.</h3> 

                <?php
                    }
                ?>
                <form method="post" action="Accueil.php">
                    <label id="labelid" for="identifiant">Identifiant :</label><br/>
                    <input type="text" name="identifiant" required="required" id="identifiant"/><br/>
                    <label class="formulaire" for="mdp">Mot de passe :
                    </label><br/>
                    <input type="password" name="mdp" required="required" id="mdp">
                    <button type="submit">Se connecter</button>
                </form>
            </div>
        
    </body>

<html/>   
