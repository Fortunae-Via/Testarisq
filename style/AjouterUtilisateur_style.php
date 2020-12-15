<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


.div_page{
    width: 80%;
    margin: auto;
    margin-top: 2rem;
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


.bandeau {
	margin: 0;
    padding: 0.5rem 1rem ;
    padding-right: 0.4rem;
    background-color: white;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid black;
}

.bandeau:hover {
	background: white;
}

.bandeau:active {
    color: black;
    transform: none;
}

.bandeau h3 {
    font-size: 1.1rem;
    margin:0;
}

.bandeau h3:hover {
    color: #00A3B8;
}

.fleche_expand {
    height: 0.6rem;
}

.fleche_expand_down {
    height: 0.6rem;
    transform: rotate(180deg);
}

.bloc {
    margin-bottom: 1rem;
}

.dropdown-content {
    /**display: none;    paramètre passé dans le html pour fonctionner avec la fonction js**/
    background-color: white;
    margin:0;
    border-radius: 0 0 0.5rem 0.5rem;
    padding: 1rem;
}

.ligne {
	display: flex;
	align-items: center;
	margin-top: 0.5rem;
	margin-bottom: 0.5rem;
}

.info{
	display:block;
	float:left;
	width:14rem;
	margin-right: 0.5rem;
}

.bloc_boutons {
	width:100%;
}

.bloc_boutons button{
	margin-right: 0.5rem;
	margin-top: 0.25rem;
	margin-bottom: 0.25rem;
	font-weight: 300;
	border: 1px solid black;
	border-radius: 0.5rem;
	box-sizing: border-box;
	padding: 0.25rem;
}

.bloc_boutons button:hover, .bloc_boutons button:active {
	background-color:#B8B8B8 ;
}

input{
	box-sizing:border-box;
	padding:0.5rem;
	border:none;
	border-radius:0.25rem;
	background-color:#DDD;
	margin-top: 0.25rem;
	margin-bottom: 0.25rem;
	width: 100%;
}

.inputs_birthdate  {
	width: 100%;
}

.inputs_birthdate input[maxlength='2']{
	width: 2rem;
}

.inputs_birthdate input[maxlength='4']{
	width: 3rem;
}

.bloc_add {
	display: flex;
	justify-content: flex-end;
	margin-top: 1rem;
}

#add{
	font-size: 0.9rem;
	font-weight: 700;
	text-transform: uppercase;
	border: none;
	border-radius: 0.25rem;
	background-color: #B8B8B8;
	box-sizing: border-box;
	padding: 0.5rem 1.75rem;
}

#add:hover{
	
}

strong{
	font-size:12px;
	font-weight:normal;
}