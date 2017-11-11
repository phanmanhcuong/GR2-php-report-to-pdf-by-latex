<?php
	header('Content-type: text/html; charset=utf-8');
	$array = array("phan", "mạnh", "cường");
	echo $array[1];
	echo mb_detect_encoding($array[1]);
?>