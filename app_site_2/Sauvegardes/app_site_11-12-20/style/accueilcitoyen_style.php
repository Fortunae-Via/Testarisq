@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap');

*
{

 	font-family: 'Nunito Sans', sans-serif; 
}

<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


/*Accueil*/
body
{
	background-color: #383838;
}

.Bienvenue, .Test1 {
  color: #FFFFFF;
  text-align: center;
  font-weight: normal;
  font-weight: 200;
}

.Bienvenue {
	font-size: 170%;
	margin-bottom: 10%;
}

.Test2, .Test3 {
  text-align: center;
}

a.bouton1 {                   /*premier test qui apparaît, changer date en vraie date du test*/
  color : #FFFFFF;
}

a.bouton2, a.bouton3 {                   /*Tests les moins récents*/
padding: 1% 10%;
display: inline-block;
border-radius: 25px 25px 25px 25px;
margin-top: 1%;
width: 75%;					/*Truc à changer si ça marche pas sur tout l'écran*/
background: #FFFFFF; 
color: #383838;
text-decoration:none;
}