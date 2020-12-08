@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap');


<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


/*Accueil*/

body
{
	background-color: #383838;
 	font-family: 'Nunito Sans', sans-serif; 
}

.Bienvenue {
  color: #FFFFFF;
  text-align: center;
  font-weight: normal;
  font-weight: 200;
  font-size: 170%;
  margin-bottom: 10%;
}

.Conteneur {
  text-align: center;
}	

a.bouton1,a.bouton3, a.bouton2
{ 
padding: 1% 10%;
width: 70%;
display: inline-block;
border-radius: 25px 25px 25px 25px;
margin-top: 1%;
background: #FFFFFF; 
color: #383838;
text-decoration:none;
}