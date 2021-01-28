<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil');
}

?>

<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - Qui sommes-nous ?</title> 
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style_commun.css" />
<link rel="stylesheet" href="style/header.css" />
<link rel="stylesheet" href="style/infos.css" />
</head>

<body>

    <!-- Header -->
    <?php include("vues/Header.php"); ?>

    <div class="div_page">

        <header>
            <h2>Qui sommes-nous ?</h2>
        </header>

        <div class="content">
            <img src="vues/img/FVxIM.png" alt="FortunaeVia&InfiniteMeasures">
            <h3>Nos deux entreprises :</h3>
            <p>
            Fortunae Via (pour “Voie de la Fortune”) a comme priorité de s’assurer de la fiabilité des conducteurs au volants, sur la voie routière.<br>
            <br>
            Infinite Measures fournit des solutions ayant pour but de garantir la fiabilité des pilotes, au travers de divers tests psychotechniques.</p>
            <h3>Le produit:</h3>
            <p>
            Nous vous proposons donc notre produit nommé TESTARISQ™ qui aura pour but de s’assurer du fait que les conducteurs soient toujours alertes et concentrés au volant. Notre produit effectuera donc des tests d’attention afin d’attester du temps de réaction et de la gestion du stress des conducteurs.
            </p>
            <p class="liens">Vous pouvez trouver nos CGU <a href="CGU">ici</a> et les mentions légales <a href="MentionsLegales">ici</a>.</p>
        </div>

    </div>
</body>

</html> 
