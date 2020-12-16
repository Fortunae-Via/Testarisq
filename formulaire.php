<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>TESTARISQ-formulaire</title>
<link rel="stylesheet" type="text/css" href="style/style_formulaire.php"/>
   
</head>

<body>
    <!-- Header -->
    <?php include("php/header.php"); ?>
    <section>
        <div class="container">
            <form class="contact-form" action="php/contactform.php" method="post">
                <div class="form-group">
                    <label for="name">Prénom et Nom</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Votre E-mail</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="subject">Sujet</label>
                    <input type="text" id="subject" name="subject">
                <div class="form-group">
                    <label for="massage">Message</label>
                    <textarea name="massage" id="massage" cols="30" rows="10"></textarea>
                </div>
                <button type="submit">Envoyer</button>   
            </form>
        </div>
    </section>
        

</body>
</html>
