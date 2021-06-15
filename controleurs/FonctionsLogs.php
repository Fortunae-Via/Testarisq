<?php 

function GetLogsForObject(string $object) : array
{
	# On récupère les logs depuis le serveur
	$url = "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=" . $object;
	$data = file_get_contents($url);
	
	# On met en forme en tableau
	$data_tab = str_split($data,33);
	array_pop($data_tab);

	return $data_tab;
}

function DecodeLogLine(string $trame): array
{
	list($tra, $obj, $req, $typ, $num, $val, $tim, $chk, $year, $month, $day, $hour, $min, $sec) = sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");

	$dict = array (
    'TypeTrame' => $tra,
    'NumObjet' => $obj,
    'TypeReq' => $req,
    'TypeCapteur' => $typ,
    'NumCapteur' => $num,
    'Valeur' => $val,
    'TimeStamp' => $tim,
    'Cheksum' => $chk,
    'Annee' => $year,
    'Mois' => $month,
    'Jour' => $day,
    'Heure' => $hour,
    'Minutes' => $min,
    'Secondes' => $sec);

    return $dict;
}