<?php 
/*
$mysqli = new mysqli('localhost','inforganic_ugocp', 'I87$T5w9e2l]', 'inforganic_ugocp');
	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}*/
/*$mysqli = new mysqli('localhost','iotechda_ugocp','De8Rps%beWZp','iotechda_ugocp');
	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}*/
/*
$mysqli = new mysqli('localhost','usuario','password','bd');

	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}*/

$mysqli = new mysqli('localhost','root','','ugocp');
	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}
?>
