<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>

.div_page{
    width: 80%;
    margin: auto;
}

.bienvenue{
	margin-top: 2rem;
	margin-bottom: 2rem;
	color: white; 
	text-align: center;
	font-weight: 300;
	font-size: 1rem
}

.Test1 p {    /*premier test qui apparaît, changer date en vraie date du test*/
	color: white;
	margin:0;
	font-weight: 200;
}

.Test1 a {
	color: white;
}

.Test1 img {
	max-width: 100%
}

.Test2 {
	margin-top: 2rem;
}

.Test2, .Test3 {
	text-align: center;
}

.bouton2, .bouton3 {                   /*Tests les moins récents*/
	display: inline-block;
	border-radius: 2rem;
	padding: 0.5rem 1rem;
	width: 100%;
	margin-bottom: 0.75rem;					/*Truc à changer si ça marche pas sur tout l'écran*/
	background: white; 
	color: #003845;
	text-decoration:none;
}








