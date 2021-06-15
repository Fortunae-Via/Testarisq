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
