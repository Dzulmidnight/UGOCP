<?php 
    require('../conexion/conexion.php');
    require('../conexion/sesion.php');
    require_once('../funciones/funciones.php');
    require_once('mpdf/mpdf.php');

    date_default_timezone_set('America/Mexico_City');
    $fecha_actual = time();
    $idadministrador = $_SESSION['administrador']['idadministrador'];

      $ruta_img = 'img/fotos_afiliados/';

      if(!empty($_FILES['foto_afiliado']['name'])){
          //unlink($foto_actual);
          $_FILES["foto_afiliado"]["name"];
            move_uploaded_file($_FILES["foto_afiliado"]["tmp_name"], $ruta_img.$_FILES["foto_afiliado"]["name"]);
            $foto_afiliado = $ruta_img.basename($_FILES["foto_afiliado"]["name"]);
            //$archivo = $rutaArchivo.basename($fecha."_".$_FILES["nueva_cotizacion"]["name"]);
      }else{
        $foto_afiliado = '';
      }
      $curp = $_POST['curp'];
      $rfc = $_POST['rfc'];

      $insertSQL = sprintf("INSERT INTO afiliado (curp, clave_elector, num_ine, rfc, idadm, foto) VALUES (%s, %s, %s, %s, %s, %s)",
        GetSQLValueString($curp, "text"),
        GetSQLValueString($_POST['clave_elector'], "text"),
        GetSQLValueString($_POST['num_ine'], "text"),
        GetSQLValueString($rfc, "text"),
        GetSQLValueString($idadministrador, "text"),
        GetSQLValueString($foto_afiliado, "text"));
      $insertar = $mysqli->query($insertSQL);

      $folio = $mysqli->insert_id;

      /// INSERTARMO LA DATOS GENERALES
      $insertSQL = sprintf("INSERT INTO datos_generales(folio, nombre, ap_paterno, ap_materno, calle, numero, colonia, cp, municipio, estado, telefono, correo, celular, edad, sexo, estado_civil, fecha_nacimiento, grupo_indigena, nombre_comunidad) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString($folio, "int"),
        GetSQLValueString($_POST['nombre'], "text"),
        GetSQLValueString($_POST['ap_paterno'], "text"),
        GetSQLValueString($_POST['ap_materno'], "text"),
        GetSQLValueString($_POST['calle'], "text"),
        GetSQLValueString($_POST['numero'], "text"),
        GetSQLValueString($_POST['colonia'], "text"),
        GetSQLValueString($_POST['cp'], "text"),
        GetSQLValueString($_POST['municipio'], "text"),
        GetSQLValueString($_POST['estado'], "text"),
        GetSQLValueString($_POST['telefono'], "text"),
        GetSQLValueString($_POST['correo'], "text"),
        GetSQLValueString($_POST['celular'], "text"),
        GetSQLValueString($_POST['edad'], "text"),
        GetSQLValueString($_POST['sexo'], "text"),
        GetSQLValueString($_POST['estado_civil'], "text"),
        GetSQLValueString($_POST['fecha_nacimiento'], "text"),
        GetSQLValueString($_POST['grupo_indigena'], "text"),
        GetSQLValueString($_POST['nombre_comunidad'], "text"));
      $insertar = $mysqli->query($insertSQL);

      /// INSERTARMOS LA INFORMACIÓN LABORAL
      $insertSQL = sprintf("INSERT INTO informacion_laboral(folio, ocupacion, cargo, empresa, tel_oficina) VALUES (%s, %s, %s, %s, %s)",
        GetSQLValueString($folio, "text"),
        GetSQLValueString($_POST['ocupacion'], "text"),
        GetSQLValueString($_POST['cargo'], "text"),
        GetSQLValueString($_POST['empresa'], "text"),
        GetSQLValueString($_POST['tel_oficina'], "text"));
      $insertar = $mysqli->query($insertSQL);

echo "$('#modalAlert').modal('toggle');";

?>