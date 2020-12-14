<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


.div_page{
    width: 80%;
    margin: auto;
    margin-top: 2rem;
}

section{
	border-radius: 0.5rem;
    background-color: white;
    padding: 1rem;
    padding-bottom: 0.25rem;
    margin-bottom: 2rem;
}

h3{
	font-weight: bold;
	margin: 0;
	margin-bottom: 0.5rem;
}

input{
	box-sizing:border-box;
	padding: 0.5rem;
	border:none;
	border-radius:0.25rem;
	background-color:#DDD;
	width:100%;
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


button[type="submit"] {
	float:right;
}

button[type="submit"] img {
	width:1rem;
	padding-left: 0.5rem;
	position: relative;
	bottom: 1.5rem;
}

.barre_recherche {
	margin-bottom: 1rem;
} 

label{
	font-weight: bold;
	margin-right: 1rem;
}

select{
	background-color: #B8B8B8;
	box-sizing: border-box;
	border:none;
	padding: 0.25rem;
	font-size: 1rem;
	font-weight: 200;
}

.fitres {
	margin-bottom: 1rem;
}

#test_number{
	width:10%;
}

/*#add{
	margin-left:35%;
	font-size: 0.9rem;
	font-weight: 700;
	text-transform: uppercase;
	border: none;
	border-radius: 0.25rem;
	background-color: #B8B8B8;
	box-sizing: border-box;
	padding: 0.5rem 2rem;
}*/
