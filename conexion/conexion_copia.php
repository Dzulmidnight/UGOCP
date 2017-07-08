<?php 
//$mysqli = new mysqli('localhost','iotechda_kapital',',xE{JANzV)pE','iotechda_maskapital');
$mysqli = new mysqli('localhost','root','','maskapital');
	if($mysqli->connect_errno){
		echo "No se puede conectar";
		echo "Error:" .$mysqli->connect_errno()."\n";
		exit;
	}
?>