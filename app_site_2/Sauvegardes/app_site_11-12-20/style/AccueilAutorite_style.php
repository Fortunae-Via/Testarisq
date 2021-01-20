<?php header("Content-type: text/css"); ?>


/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


.bienvenue{
	margin-top: 2em;
	color: white; 
	text-align: center;
	font-weight: 300;
	font-size: 1rem
}

.heurelieu{
	display:flex;
	justify-content: space-between;
}

.heurelieu h1 {
	color: white;
	font-weight: 200;
	font-size: 2rem;
	margin-top: 1rem;
	margin-bottom: 1.5rem;
}

.modes {
	width: 25rem;
	margin: 2rem auto ;
}

.mode {
	width: 21rem;
	padding: 0 2rem 0rem 2rem ;
	background-color: white;
	border-radius: 1rem;
	margin: 2rem 0;
}

.modes header {
	padding: 1rem;
	text-align: center;
}

/* On enlève tout le style par défaut des boutons */
button {
    display: inline-block;
    border: none;
    text-decoration: none;
    background: none;
   	font: inherit;
    cursor: pointer;
    text-align: center;
}
button:hover,button:focus {
    background: none;
    outline: none
}
button:active {
    transform: scale(0.99);
}
/* On enlève tout le style par défaut des boutons */


.modes header button {
	font-size: 1.2rem;
	font-weight: 700;
	text-transform: uppercase;
	color: black;
}

.modes header button img {
	width:1rem;
	padding-left: 0.5rem;
	position: relative;
	top: 0.1rem;
}

.modes form label {
	font-weight: 600;
	font-size: 0.9rem;
	display : inline-block;
	margin-bottom: 0.25rem;
}

.modes form input[type="text"] {
	font-size: 0.75rem;
	box-sizing: border-box;
	padding: 0.5rem;
	border: none;
	border-radius: 0.25rem;
	background-color: #DDD;
	width: 100%;
	margin-bottom:0.5rem;
}

.champ input {
	margin-bottom:0.5rem;
}

.bouton{
	text-align: center;
}

.modes form input[type="submit"] {
	font-family: 'Nunito Sans', sans-serif;
	font-size: 0.9rem;
	font-weight: 700;
	text-transform: uppercase;
	border: none;
	border-radius: 0.25rem;
	background-color: #B8B8B8;
	box-sizing: border-box;
	padding: 0.5rem 2rem;
	margin: 1.5rem 0;
	cursor: pointer;
}

.mode.recherche {
	display: none;
}



