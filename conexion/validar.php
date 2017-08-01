<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
  require('conexion.php');
  sleep(1);
  session_start();
  $_SESSION['autentificado'] = false;
  $mysqli->set_charset('utf8');

  $usuario = $mysqli->real_escape_string($_POST['usuario']);
  $password = $mysqli->real_escape_string($_POST['password']);

  if($nueva_consulta = $mysqli->prepare("SELECT * FROM administradores WHERE username = ?")){
    $nueva_consulta->bind_param('s', $usuario);
    $nueva_consulta->execute();
    $resultado = $nueva_consulta->get_result();

    if($resultado->num_rows == 1){
      $datos = $resultado->fetch_assoc();
      if(strcmp($datos['password'],$password) == 0){
        $_SESSION['administrador'] = $datos;
        $_SESSION['autentificado'] = true;
        echo json_encode(array('error' => false, 'tipo' => $datos['tipo']));
      }else{
        echo json_encode(array('error' => true));
      }
    }else{
      echo json_encode(array('error' => true));
    }

    $nueva_consulta->close();
  }
}


$mysqli->close();
?>