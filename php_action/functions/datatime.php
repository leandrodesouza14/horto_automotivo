<?php

function dataTime($datetime)
{
	include_once 'function_clear.php';
	$date = clear(strtotime($datetime));
	if ($date === false) {
		echo "Data Inválida";
	} else {
		$t = strlen($date);
		if ($t === 10) {
			return date('d/m/Y', $date);
		}
	}
}
