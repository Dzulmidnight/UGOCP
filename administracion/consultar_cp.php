<?php
# Esta página recibe por post el id del formulario.
#
# Para nuestro ejemplo, devolvemos un valor para el id 10, pero aqui se tendria
# que realizar la busqueda en la base de datos en busca del registro.
#

require('../conexion/conexion.php');
$cp = $_POST['cp'];

$query = "SELECT estado, municipio, ciudad FROM codigo WHERE cp = $cp";
$consultar = $mysqli->query($query);

$detalle = $consultar->fetch_assoc();
$estado = utf8_encode($detalle['estado']);
$municipio = utf8_encode($detalle['municipio']);
$ciudad = utf8_encode($detalle['ciudad']);


//$colonia = utf8_decode($detalle['asentamiento']);

/*
$sth = mysqli_query("SELECT ...");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);*/

print json_encode(array("estado" => ''.$estado.'', "municipio" => ''.$municipio.'', "ciudad" => ''.$ciudad.''));


?>
