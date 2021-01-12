<?php

try
{
	//MAMP
	//$bdd = new PDO("mysql:host=localhost;dbname=bdd_testarisq;charset=utf8", "root", "root");

	//WAMP
	$bdd = new PDO('mysql:host=localhost;dbname=bdd_testarisq;charset=utf8', 'root', '');
}

catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}