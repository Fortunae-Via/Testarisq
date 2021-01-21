<?php


function RecupFAQ(PDO $bdd, int $page): array {
	$offset = $page * 10 - 10;
	$query = 'SELECT * FROM ElementFAQ LIMIT 10 OFFSET ' . $offset;
	return $bdd->query($query)->fetchAll();
}

function AjouterQuestion(PDO $bdd, string $Question, string $Reponse) {
	$Question = strip_tags($Question);
	$Reponse = nl2br(strip_tags($Reponse));
	$add_question = $bdd->prepare("INSERT INTO ElementFAQ(question, reponse) VALUES (?, ?)");
	$add_question->execute(array($Question, $Reponse));
}

function ModifQuestion(PDO $bdd, string $IdQuestion, string $Question, string $Reponse) {
	$Question = strip_tags($Question);
	$Reponse = nl2br(strip_tags($Reponse));
	$update = $bdd->prepare("
		UPDATE ElementFAQ 
		SET Question=?,Reponse=?
		WHERE Id=?");
	$update->execute(array($Question, $Reponse, $IdQuestion));
}

function SuppQuestion(PDO $bdd, string $IdQuestion) {
	$delete = $bdd->prepare("DELETE FROM ElementFAQ WHERE Id=?");
	$delete->execute(array($IdQuestion));
}