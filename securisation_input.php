<!DOCTYPE html>
<html>
    <head>
        <title>Sécurisation Input</title>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
            
            function securisation($donnees){
                $donnees=trim($donnees);
                $donnees=stripslashes($donnees);
                $donnees=strip_tags($donnees);
                return $donnees;
            }
                        
        ?>
    </body>
</html>