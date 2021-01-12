<!DOCTYPE html>
<html>
    <head>
        <title>Sécurisation Input</title>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
            $identifiant=$_POST['user'];
            $password=$_POST['pass'];
            function securisation($donnees){
                $donnees=trim($donnees);
                $donnees=stripslashes($donnees);
                $donnees=strip_tags($donnees);
                return $donnees;
            }
            $identifiant= securisation($identifiant);
            $password= securisation($password);            
        ?>
    </body>
</html>