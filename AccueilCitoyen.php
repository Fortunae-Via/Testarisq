<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/AccueilCitoyen_style.php" />
        <title>TESTARISQ - Accueil</title>
    </head>


<!--Header-->
<?php include("php/header.php"); ?>

<body>

  <div class="div_page">

    <h2 class="bienvenue">
      <?php
      $Personne_Prenom = 'Utilisateur' ;
      echo 'Bienvenue ' . $Personne_Prenom . ' !';
      ?>
    </h2>

    <section>
      <div class="Test1">
        <header>
          <p>Vos derniers résultats : Test du <a href="#" class='bouton1'>xx/xx/20xx</a></p>
        </header>
        <a href="#"><img src="img/graphs.png" alt="GraphiquesDernierTest"/></a>
      </div>

    	<div class="Test2">
        <a href="#" class='bouton2'>Test du xx/xx/20xx</a>
      </div>

      <div class='Test3'>
        <a href="#" class='bouton3'>Test du xx/xx/20xx</a>
      </div>
    </section>
    
  </div>

</body>
