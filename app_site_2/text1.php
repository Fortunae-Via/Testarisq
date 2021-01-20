<!DOCTYPE html>
<html>
    <head>
        <title>test_accueil</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="text1.css"/>
    </head>
    <body>
        <div id="image1">
            <img src="C:\Users\khour\OneDrive\Documents\HTML-CSS\Logo Testarisq.png" alt="Logo Fortunae Via"/>
        </div>
        <br/>
        <h3 id="titre1">AUTHENTIFICATION</h3>
        <div id="frm">
            <form action="process.php" method="post"/> 
                <p>
                    <label>Identifiant:</label>
                    <br/>
                    <input type="text" id="user" name="user"/> 
                </p>
                <p>
                    <label>Mot de passe:</label>
                    <br/>
                    <input type="password" id="pass" name="pass"/> 
                </p>
                <br/>
                <p>
                    <button type="submit" id="btn">SE CONNECTER</button>
                </p>           
            </form>
            
        </div>
    </body>
</html>