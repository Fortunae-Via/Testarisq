<?php include'controleurs/send.php';?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>TESTARISQ - <?php echo $titre_onglet; ?></title>
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/header.css" />
<link rel="stylesheet" href="style/formulaire.css" />
   
</head>

<body>
    <!-- Header -->
    <?php include("vues/Header.php"); ?>

    <div class="div_page">

        <header>
            <h2><?php echo $titre_page; ?></h2>
        </header>
          <?php echo $alert; ?>
        <section>
            <div class="container">
                <form class="contact-form" action="controleurs/send.php" method="post">
                    <div class="form-group">
                        <label for="name">Prénom et Nom : *</label>
                        <input type="text" id="name" name="name" required="required">
                    </div>
                    <div class="form-group">
                        <label for="email">Votre E-mail : *</label>
                        <input type="email" id="email" name="email" required="required">
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet : *</label>
                        <input type="text" id="subject" name="subject" required="required" 
                        value="<?php echo $sujet_defaut; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="message">Message : *</label>
                        <textarea name="message" id="message" cols="30" rows="10" required="required"></textarea>
                    </div>
                    <button type="submit">Envoyer</button>   
                </form>
            </div>
        </section>
        
    </div>
     <script type="text/javascript">
    if(window.history.replaceState){
        window.history.replaceState(null.null.window.location.href);
    }
    </script>
</body>
</html>
