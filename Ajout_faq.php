<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil.php');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Ajout d'éléments à la FAQ</title>
	<meta charset="ytf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/Ajout_faq.css" />
</head>
<body>

		<?php

		include("php/header.php");
		if(isset($_POST['question']) && isset($_POST['reponse'])){
		
			try{
				$bdd = new PDO('mysql:host=localhost; dbname=bdd_testarisq', 'root', '');
			}catch(Exception $e){
				die('Erreur : '. $e->getMessage());
			}

			
			$add_question = $bdd->prepare("INSERT INTO elementfaq(question, reponse) VALUES (?, ?)");			
			$question=$_POST['question'];
			$reponse=$_POST['reponse'];
			$add_question->execute(array($question, $reponse));
			
		}
			
		?>
			<h2> Ajout d'éléments à la FAQ </h2>;
			<div class="div_page">
				<div id="ajout" class="bloc">
        		    <div id="dropdown1" class="dropdown-content" style="display: block;">
	            		<form method="post">
	            			
	            			<div class="ligne">
								<div class="info">
	            					<label for="question">Question :</label>
	            				</div>
								<input name="question"/>
							</div>
							<div class="ligne2">
								<div class="info">
	            					<label for="reponse" >Réponse :</label>
	            				</div>
								<textarea name="reponse"></textarea>
							</div>		
						
							<div class="bloc_add"> 
								<button id="add" type="submit">Ajouter Question à la FAQ </button>
							</div>
						</form>
					</div>
        		</div>
       	
			</div>
		
		
		
 		 			
 		</body>
</html>
