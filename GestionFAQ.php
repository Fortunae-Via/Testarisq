<?php 

//Partie traitement de l'ajout de question :
if (isset($_POST['question']) && isset($_POST['reponse'])){
		
	require 'modele/connexionbdd.php';

	$add_question = $bdd->prepare("INSERT INTO ElementFAQ(question, reponse) VALUES (?, ?)");
	$question=$_POST['question'];
	$reponse=$_POST['reponse'];
	$add_question->execute(array($question, $reponse));

	$message_ajout = true;
	
}

else {
	$message_ajout = false;
}


//On prépare la FAQ
require 'controleurs/FAQ.php';

//On affiche la page
require 'vues/GestionFAQ.php';



