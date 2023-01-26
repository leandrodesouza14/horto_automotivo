<?php

function dataTime($datetime){
    include_once 'function_clear.php';
	$date = clear(strtotime($datetime));
	return date('d/m/Y H:i:s', $date);
}
