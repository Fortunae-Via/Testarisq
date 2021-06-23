<?php

function EtapeSuivante($NumeroTest,$EtapeTest)
{
	if ($EtapeTest==1 OR $EtapeTest==2) {
		return array($NumeroTest,$EtapeTest+1);
	}
	else if ($EtapeTest==3) {
		return array($NumeroTest+1,1);
	}
}

function GetLastLogIndexForObject(string $object): int
{
	$data_tab = GetLogsForObject($object);
	return count($data_tab)-1;
}


function Score($NumeroTest, $ResultatMesure)
{
	$score = 20;
	switch($NumeroTest){
		case 3:
			$e = ($ResultatMesure - 70)/70; // incertitude mathématique
			$e = 10; // incertitude cas réel
			// 70 pour adulte
			if($ResultatMesure == 70 + e || $ResultatMesure == 70 - e){
				$score -= abs($ResultatMesure - 70) % 2;
			}
			break;
		case 4:
			if($ResultatMesure < 36.1 || $ResultatMesure > 37.8){
				$score -= (abs($ResultatMesure - (36.1 + 37.8)/2) % 2;
			}
			break;
		case 5:
			$score = $ResultatMesure;
			break;
		default: // test 1 et 2
			if($ResultatMesure > 75){
				$score -= $ResultatMesure % 60;
			}
			break;
	}

	$score = ($score < 0) ? 0 : $score;
	return $score;
}
