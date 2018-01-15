<?php
require('../conexion/conexion.php');
$cp = $_POST['cp2'];

$query = "SELECT asentamiento FROM codigo WHERE cp = '$cp'";
$consultar = $mysqli->query($query);

//echo "<select class='form-control' name='sucursal'>";
  while($colonia = $consultar->fetch_assoc()){
    echo "<option value='".utf8_encode($colonia['asentamiento'])."'>".utf8_encode($colonia['asentamiento'])."</option>";
  }
//echo "</select>";
?>

