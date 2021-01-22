<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil.php');
}

?>

<!DOCTYPE html>
<html>

<head>
<title>TESTARISQ - CGU</title> 
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
            <h2>Conditions Générales d'Utilisation</h2>
        </header>
        <div class="content">
            
            <p>Avant d'utiliser ce site web, veuillez lire attentivement ce contrat de licence utilisateur final (ci-après dénommé «cet accord»). L'utilisation de ce site web indique que vous acceptez les termes de cet accord. Si vous n'acceptez pas les termes de cet accord, vous ne pourrez pas utiliser le site web.</p>
            <p>Cet accord est un accord juridique entre vous et notre entreprise (ci-après dénommée «Infinite Measures»). Cet accord stipule que vous utilisez les produits d'Infinite Measures et / ou des concédants de licence tiers (y compris les affiliés de Infinite Measures) et leurs affiliés respectifs (collectivement dénommés «fournisseurs tiers») (avec le site web fourni par Infinite Measures Droits et obligations découlant des mises à niveau et des mises à jour, documents imprimés, documents en ligne ou autres documents électroniques générés pour le site web et autres fichiers de données créés en exécutant ce produit (ci-après collectivement dénommés «le produit»).</p>
            <p>Nonobstant les dispositions ci-dessus, s'il existe un autre contrat de licence utilisateur final pour tout site web de ce produit (y compris, mais sans s'y limiter, le contrat de licence publique générale GNU et le contrat de licence publique générale Wide / Library), il sera soumis aux exigences du contrat de licence utilisateur final supplémentaire. Dans ce cadre, ce contrat de licence utilisateur final remplace les termes de cet accord (ci-après dénommé site web exclu»).</p>
            
            <p class="liens">Vous pouvez trouver des informations sur les entreprises responsables de la création et de la gestion de ce site web <a href="QuiSommesNous">ici</a> et les mentions légales <a href="MentionsLegales">ici</a>.</p> 
        </div>
    </div>
</body>

</html>    
