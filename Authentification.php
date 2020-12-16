<!Doctype html>
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
            <img src="img/logo_testarisq_circle.png" alt="logo_testarisq_circle"/>
            <button onclick="window.location.href='#formulaire'">Authentification</button>
            <div id="formulaire">
                <form method="post" action="Accueil.php">
                    <label for="identifiant">Identifiant:</label><br/>
                    <input type="text" name="identifiant" required="required" id="identifiant"/><br/>
                    <label class="formulaire" for="mot de passe">Mot de passe:
                    </label><br/>
                    <input type="password" name="mot de passe" required="required" id="mot de passe">
                    <button type="submit">Se connecter</button>
                </form>
            </div>
        
    </body>

<html/>   
