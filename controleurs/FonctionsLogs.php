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

function SendCommand(string $object, int $NumeroTest)
{
    switch ($NumeroTest){
        case 1:
            $typeCapteur = "7";    // CAPT_SONMIC
            $ans = "0001";
            break;
        case 2:
            $typeCapteur = "7";    // CAPT_SONMIC
            $ans = "0002";
            break;
        case 3:
            $typeCapteur = "9";    // CAPT_CARDIO
            $ans = "0003";
            break;
        case 4:
            $typeCapteur = "3";    // CAPT_TEMP
            $ans = "0004";
            break;
        case 5:
            $typeCapteur = "7";    // CAPT_SONMIC
            $ans = "0005";
            break;
    }



    # On envoie la commande au serveur
    $url = "http://projets-tomcat.isep.fr:8080/appService?ACTION=COMMAND&TEAM=" . $object . "&TRAME=";
    $trame = "1" . $object . "2" . $typeCapteur . "01" . $ans . "FF";
    $url = $url . $trame;
    file_get_contents($url);
}
