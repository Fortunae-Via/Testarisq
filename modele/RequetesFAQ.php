<?php


function RecupFAQ(PDO $bdd): array {
	$query = "SELECT * FROM ElementFAQ";
    return $bdd->query($query)->fetchAll();
}

function AjouterQuestion(PDO $bdd, string $Question, string $Reponse) {
	$Reponse = nl2br(strip_tags($Reponse));
	$add_question = $bdd->prepare("INSERT INTO ElementFAQ(question, reponse) VALUES (?, ?)");
	$add_question->execute(array($Question, $Reponse));
}
