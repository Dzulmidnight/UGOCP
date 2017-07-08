<?php 
//$mysqli = new mysqli('localhost','iotechda_kapital',',xE{JANzV)pE','iotechda_maskapital');
$mysqli = new mysqli('localhost','root','','ugocp');
	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}
/*
$mysqli = new mysqli('localhost','usuario','password','bd');

	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}

*/

?>
