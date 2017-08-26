<?php

require('../conexion/conexion.php');
$cp = $_POST['cp'];

$query = "SELECT idEstado, estado, idMunicipio, municipio, ciudad FROM codigo WHERE cp = $cp";
$consultar = $mysqli->query($query);

$detalle = $consultar->fetch_assoc();
$estado = utf8_encode($detalle['estado']);
$num_estado = $detalle['idEstado'];
$municipio = utf8_encode($detalle['municipio']);
$num_municipio = $detalle['idMunicipio'];
$ciudad = utf8_encode($detalle['ciudad']);


print json_encode(array("estado" => ''.$estado.'', "num_estado" => ''.$num_estado.'', "municipio" => ''.$municipio.'', "num_municipio" => ''.$num_municipio.'', "ciudad" => ''.$ciudad.''));


?>
