<?php
require('../conexion/conexion.php');
require('../conexion/sesion.php');
    //require_once('../funciones/funciones.php');
require_once('mpdf/mpdf.php');
date_default_timezone_set('America/Mexico_City');


if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;    
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}


    $fecha_actual = time();

    if(isset($_SESSION['administrador'])){
        if($_SESSION['administrador']['tipo'] != 'administrador'){
            header('Location: ../conexion/salir.php');
        }
    }
    $menu = 'inicio';

    $idadministrador = $_SESSION['administrador']['idadministrador'];

    $query_admin = "SELECT agregar, editar, eliminar, root FROM administradores WHERE idadministrador = $idadministrador";
    $ejecutar = $mysqli->query($query_admin);
    $permisos = $ejecutar->fetch_assoc();

    $permiso_agregar = $permisos['agregar'];
    $permiso_editar = $permisos['editar'];
    $permiso_eliminar = $permisos['eliminar'];
    $root = $permisos['root'];

    if(isset($_POST['agregar_afiliado']) && $_POST['agregar_afiliado'] == 1){
      //$foto_actual = $_POST['foto_actual'];
      $ruta_img = 'img/fotos_afiliados/';

      if(!empty($_FILES['foto_afiliado']['name'])){
        if(file_exists($foto_actual)){
          unlink($foto_actual);
        }
            
            $_FILES["foto_afiliado"]["name"];
            move_uploaded_file($_FILES["foto_afiliado"]["tmp_name"], $ruta_img.$_FILES["foto_afiliado"]["name"]);
            $foto_afiliado = $ruta_img.basename($_FILES["foto_afiliado"]["name"]);
            $archivo = $rutaArchivo.basename($fecha."_".$_FILES["nueva_cotizacion"]["name"]);

      }else{
        $foto_afiliado = '';
      }
      $curp = $_POST['curp'];
      $rfc = $_POST['rfc'];
      if($_POST['select_sexo'] == 'H'){
        $organizacion = 'UGOCP';
      }else{
        $organizacion = $_POST['organizacion'];
      }

      /*$insertSQL = sprintf("INSERT INTO afiliado (curp, clave_elector, num_ine, rfc, idadm, foto) VALUES (%s, %s, %s, %s, %s, %s)",
        GetSQLValueString($curp, "text"),
        GetSQLValueString($_POST['clave_elector'], "text"),
        GetSQLValueString($_POST['num_ine'], "text"),
        GetSQLValueString($rfc, "text"),
        GetSQLValueString($idadministrador, "int"),
        GetSQLValueString($foto_afiliado, "text"));
      $insertar = $mysqli->query($insertSQL);*/


      $insertSQL = "INSERT INTO afiliado (organizacion, curp, clave_elector, num_ine, rfc, idadm, foto) VALUES ('$organizacion', '$curp', '$_POST[clave_elector]', '$_POST[num_ine]', '$rfc', $idadministrador, '$foto_afiliado')";
      $insertar = $mysqli->query($insertSQL);


      $folio = $mysqli->insert_id;

      if(empty($_POST['colonia_diferente'])){
        $colonia = $_POST['colonia'];
      }else{
        $colonia = $_POST['colonia_diferente'];
      }

      /// INSERTARMO LA DATOS GENERALES
      /*$insertSQL = sprintf("INSERT INTO datos_generales(folio, nombre, ap_paterno, ap_materno, calle, numero, colonia, cp, municipio, estado, telefono, correo, celular, edad, sexo, estado_civil, fecha_nacimiento, grupo_indigena, nombre_comunidad) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString($folio, "int"),
        GetSQLValueString($_POST['nombre'], "text"),
        GetSQLValueString($_POST['ap_paterno'], "text"),
        GetSQLValueString($_POST['ap_materno'], "text"),
        GetSQLValueString($_POST['calle'], "text"),
        GetSQLValueString($_POST['numero'], "text"),
        GetSQLValueString($colonia, "text"),
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
      $insertar = $mysqli->query($insertSQL);*/

      /*$insertSQL = sprintf("INSERT INTO datos_generales(folio, nombre, ap_paterno, ap_materno, calle, numero, colonia, cp, municipio, estado, telefono, correo, celular, edad, sexo, estado_civil, fecha_nacimiento, grupo_indigena, nombre_comunidad) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString($folio, "int"),
        GetSQLValueString($_POST['nombre'], "text"),
        GetSQLValueString($_POST['ap_paterno'], "text"),
        GetSQLValueString($_POST['ap_materno'], "text"),
        GetSQLValueString($_POST['calle'], "text"),
        GetSQLValueString($_POST['numero'], "text"),
        GetSQLValueString($colonia, "text"),
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
      $insertar = $mysqli->query($insertSQL);*/
      $dia = $_POST['dia'];
      $mes = $_POST['mes'];
      $anio = $_POST['anio'];

      $fecha_nacimiento = $dia.'/'.$mes.'/'.$anio;

      $insertSQL = "INSERT INTO datos_generales(folio, nombre, ap_paterno, ap_materno, calle, numero, colonia, cp, municipio, num_municipio, estado, num_estado, telefono, correo, celular, edad, sexo, estado_civil, fecha_nacimiento, grupo_indigena, nombre_comunidad) VALUES ($folio, '$_POST[nombre]', '$_POST[ap_paterno]', '$_POST[ap_materno]', '$_POST[calle]', '$_POST[numero]', '$colonia', '$_POST[cp]', '$_POST[municipio]', $_POST[num_municipio], '$_POST[estado]', $_POST[num_estado], '$_POST[telefono]', '$_POST[correo]', '$_POST[celular]', '$_POST[edad]', '$_POST[select_sexo]', '$_POST[estado_civil]', '$_POST[fecha_nacimiento]', '$_POST[grupo_indigena]', '$_POST[nombre_comunidad]')";
      $insertar = $mysqli->query($insertSQL);

      /// INSERTARMOS LA INFORMACIÓN LABORAL
      /*$insertSQL = sprintf("INSERT INTO informacion_laboral(folio, ocupacion, cargo, empresa, tel_oficina) VALUES (%s, %s, %s, %s, %s)",
        GetSQLValueString($folio, "text"),
        GetSQLValueString($_POST['ocupacion'], "text"),
        GetSQLValueString($_POST['cargo'], "text"),
        GetSQLValueString($_POST['empresa'], "text"),
        GetSQLValueString($_POST['tel_oficina'], "text"));
      $insertar = $mysqli->query($insertSQL);*/

      $insertSQL = "INSERT INTO informacion_laboral(folio, ocupacion, cargo, empresa, tel_oficina) VALUES ($folio, '$_POST[ocupacion]', '$_POST[cargo]', '$_POST[empresa]', '$_POST[tel_oficina]')";
      $insertar = $mysqli->query($insertSQL);

        $query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio INNER JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio WHERE afiliado.folio = $folio";
        $ejecutar = $mysqli->query($query);
        $detalle = $ejecutar->fetch_assoc();
        $num_folio = str_pad($detalle['folio'], 6, '0', STR_PAD_LEFT);
        //$fecha_nacimiento = date('d/m/Y', $detalle['fecha_nacimiento']);
        $formato_fecha = date("d/m/Y:h:i:sa", time());

        $sexo = '';
        if($detalle['sexo'] = 'H'){
          $sexo = 'HOMBRE';
        }else{
          $sexo = 'MUJER';
        }
        $nombre = $detalle['nombre'].' '.$detalle['ap_paterno'].' '.$detalle['ap_materno'];
        $direccion = $detalle['calle'].' #'.$detalle['numero'].', COL. '.$detalle['colonia'].', C.P. '.$detalle['cp'].', MUNICIPIO '.$detalle['municipio'].', '.$detalle['estado'];

        header('Location: index.php?folio='.$folio);


    }
    /// TERMINA AGREGAR AFILIADO


    /// MODIFICAMOS LA INFORMACIÓN DEL AFILIADO
    if(isset($_POST['modificar_afiliado'])){
      $folio = $_POST['modificar_afiliado'];

      $foto_actual = $_POST['foto_actual'];
      $ruta_img = 'img/fotos_afiliados/';

      if(!empty($_FILES['foto_afiliado']['name'])){
        if(file_exists($foto_actual)){
          unlink($foto_actual);
        }
          $_FILES["foto_afiliado"]["name"];
            move_uploaded_file($_FILES["foto_afiliado"]["tmp_name"], $ruta_img.$_FILES["foto_afiliado"]["name"]);
            $foto_afiliado = $ruta_img.basename($_FILES["foto_afiliado"]["name"]);
            //$archivo = $rutaArchivo.basename($fecha."_".$_FILES["nueva_cotizacion"]["name"]);
      }else{
        $foto_afiliado = $foto_actual;
      }

      $curp = $_POST['curp'];
      $rfc = $_POST['rfc'];
      /// actualizamos la tabla afiliado
      /*$updateSQL = sprintf("UPDATE afiliado SET curp = %s, clave_elector = %s, num_ine = %s, rfc = %s, foto = %s, idadm = %s WHERE folio = %s",
        GetSQLValueString($curp, "text"),
        GetSQLValueString($_POST['clave_elector'], "text"),
        GetSQLValueString($_POST['num_ine'], "text"),
        GetSQLValueString($rfc, "text"),
        GetSQLValueString($foto_afiliado, "text"),
        GetSQLValueString($idadministrador, "text"),
        GetSQLValueString($folio, "text"));
      $actualizar = $mysqli->query($updateSQL);*/
      $updateSQL = "UPDATE afiliado SET curp = '$curp', clave_elector = '$_POST[clave_elector]', num_ine = '$_POST[num_ine]', rfc = '$rfc', foto = '$foto_afiliado', idadm = $idadministrador WHERE folio = $folio";
      $actualizar = $mysqli->query($updateSQL);

      /// actualizamos los datos_generales
      /*$updateSQL = sprintf("UPDATE datos_generales SET nombre = %s, ap_paterno = %s, ap_materno = %s, calle = %s, numero = %s, colonia = %s, cp = %s, municipio = %s, estado = %s, telefono = %s, correo = %s, celular = %s, edad = %s, sexo = %s, estado_civil = %s, fecha_nacimiento = %s, grupo_indigena = %s, nombre_comunidad = %s WHERE folio = %s",

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
        GetSQLValueString($_POST['nombre_comunidad'], "text"),
        GetSQLValueString($folio, "int"));*/
      $updateSQL = "UPDATE datos_generales SET nombre = '$_POST[nombre]', ap_paterno = '$_POST[ap_paterno]', ap_materno = '$_POST[ap_materno]', calle = '$_POST[calle]', numero = '$_POST[numero]', colonia = '$_POST[colonia]', cp = '$_POST[cp]', municipio = '$_POST[municipio]', estado = '$_POST[estado]', telefono = '$_POST[telefono]', correo = '$_POST[correo]', celular = '$_POST[celular]', edad = '$_POST[edad]', sexo = '$_POST[sexo]', estado_civil = '$_POST[estado_civil]', fecha_nacimiento = '$_POST[fecha_nacimiento]', grupo_indigena = '$_POST[grupo_indigena]', nombre_comunidad = '$_POST[nombre_comunidad]' WHERE folio = $folio";
      $actualizar = $mysqli->query($updateSQL);

      /// actualizamos la información laboral
      /*$updateSQL = sprintf("UPDATE informacion_laboral SET ocupacion = %s, cargo = %s, empresa = %s, tel_oficina = %s WHERE folio = %s",
        GetSQLValueString($_POST['ocupacion'], "text"),
        GetSQLValueString($_POST['cargo'], "text"),
        GetSQLValueString($_POST['empresa'], "text"),
        GetSQLValueString($_POST['tel_oficina'], "text"),
        GetSQLValueString($folio, "int"));*/
      $updateSQL = "UPDATE informacion_laboral SET ocupacion = '$_POST[ocupacion]', cargo = '$_POST[cargo]', empresa = '$_POST[empresa]', tel_oficina = '$_POST[tel_oficina]' WHERE folio = $folio";
      $actualizar = $mysqli->query($updateSQL);
    }
 

    /// TERMINA INSERTAR AFILIADO

    /// INICIA ELIMINAR AFILIADO
    if(isset($_POST['eliminar_afiliado']) && !empty($_POST['eliminar_afiliado'])){
        $folio = $_POST['eliminar_afiliado'];
        if(file_exists($_POST['foto_afiliado'])){
            unlink($_POST['foto_afiliado']);
        }

        /*$deleteSQL = sprintf("DELETE FROM afiliado WHERE folio = %s",
            GetSQLValueString($folio, "int"));
        $eliminar = $mysqli->query($deleteSQL);

        $deleteSQL = sprintf("DELETE FROM datos_generales WHERE folio = %s",
            GetSQLValueString($folio, "int"));
        $eliminar = $mysqli->query($deleteSQL);

        $deleteSQL = sprintf("DELETE FROM informacion_laboral WHERE folio = %s",
            GetSQLValueString($folio, "int"));
        $eliminar = $mysqli->query($deleteSQL);

        $deleteSQL = sprintf("DELETE FROM documentacion WHERE folio = %s",
            GetSQLValueString($folio, "int"));
        $eliminar = $mysqli->query($deleteSQL);*/

        $deleteSQL = "DELETE FROM afiliado WHERE folio = $folio";
        $eliminar = $mysqli->query($deleteSQL);

        $deleteSQL = "DELETE FROM datos_generales WHERE folio = $folio";
        $eliminar = $mysqli->query($deleteSQL);

        $deleteSQL = "DELETE FROM informacion_laboral WHERE folio = $folio";
        $eliminar = $mysqli->query($deleteSQL);

        $deleteSQL = "DELETE FROM documentacion WHERE folio = $folio";
        $eliminar = $mysqli->query($deleteSQL);



        header('Location: index.php');
    }
    /// TERMINA ELIMINAR AFILIADO

 ?>



<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="../img/logo_ugocp_xs.png">

    <title>Administración - UGOCP</title>

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--dynamic table-->
    <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
      <!--right slidebar-->
      <link href="css/slidebars.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <script src="js/jquery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/curp.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="full-width">

  <section id="container" >
      <!--header start-->

      <!--header end-->
      <!--sidebar start-->
      <?php 
      include('aside.php');
       ?>
      <!--sidebar end-->
      <section id="main-content">

          <section class="wrapper">

              <div class="row">
                <div class="col-sm-12">
                  <div id="desplegar"></div>
                  <section class="panel">
                    <header class="panel-heading">
                        Afiliados Registrados
                         <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>

                         </span>
                    </header>
                    <div class="panel-body">

                      <div class="clearfix">
                          <?php 
                          if($permiso_agregar == 1){
                          ?>
                            <div class="btn-group">
                              <button id="" class="btn btn-default" data-toggle="modal" href="#modal_frm_afiliado">Nuevo Registro <i class="fa fa-plus"></i></button>
                            </div>
                          <?php
                          }
                           ?>
                          <!--<div class="btn-group pull-right">
                              <button class="btn dropdown-toggle" data-toggle="dropdown">Herramientas <i class="fa fa-angle-down"></i>
                              </button>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="#">Imprimir</a></li>
                                  <li><a href="#">Generar Credenciales</a></li>
                              </ul>
                          </div>-->
                      </div>
                      <div class="adv-table">

                        <table style="font-size: 12px;" class="display table table-bordered table-striped table-condensed" id="dynamic-table">
                          <thead>
                            <tr>
                                <td colspan="2">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="marcar" value="" onclick="marcar_desmarcar();" /> Marcar/Desmarcar
                                    </label>
                                  </div>
                                  <form name="formulario2" action="" method="POST" id="frm_checkbox">
                                    <!-- solo sirve en chrome <a href="#" target="" onclick="consultar_check()"><img src="img/pdf.png"> Crendial(es)</a>-->
                                    <button type="button" class="btn btn-default" name="btn_checkbox" id="btn_checkbox" onclick="consultar_check()"><img src="img/pdf.png"> Crendial(es)</button>
                                  </form>
                                </td>

                                <form name="formulario2" action="" method="POST" id="frm_checkbox">
                                    <td>
                                      <a href="generar_excel.php" target="_new"><img src="img/excel.png"> Base de datos</a>
                                      <!--<button type="button" class="btn btn-primary" name="btn_checkbox" id="btn_checkbox" onclick="consultar_check()">Generar<br>Credenciales</button>-->
                                    </td>
                                </form>

                                  <!--<td>Generar Excel</td>-->
                                  <td colspan="3">
                                    <p>Simbologia:</p>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Archivos</button>
                                      <button id="" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar</button>
                                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar</button>                                   
                                  </td>
                                
                            </tr>
                            <tr>
                                <th>Folio</th>
                                <th>Foto</th>
                                <th>Organización</th>
                                <th>Nombre</th>
                                <th>CURP</th>
                                <th>Clave Elector</th>
                                <th>Num INE</th>
                                <th>RFC</th>
                                <th>Estado</th>
                                <th>PDFs</th>
                                <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="f1" name="f1">
                            <?php 
                            $query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio LEFT JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio";
                            $consultar = $mysqli->query($query);

                            while($registros = $consultar->fetch_assoc()){
                              $folio = str_pad($registros['folio'], 6, '0', STR_PAD_LEFT);
                              if($registros['organizacion'] == 'FENAM'){
                                $clase = 'style="color:#de0c77"';
                              }else{
                                $clase = 'style="color:#2c3e50"';
                              }
                            ?>
                              <tr class="">
                                <td>
                                  <div class="checkbox">
                                    <label>
                                      <input class="micheckbox" type="checkbox" name="folios[]" value="<?php echo $registros['folio']; ?>"> <span style="color:red"><?php echo $folio; ?></span>
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <?php 
                                  if(!empty($registros['foto'])){
                                  ?>
                                    <img class="img-responsive" src="<?php echo $registros['foto']; ?>" alt="" width="40px;">
                                  <?php
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo '<b '.$clase.'>'.$registros['organizacion'].'</b>'; ?>
                                </td>
                                <td>
                                  <?php echo $registros['nombre']; ?>
                                </td>
                                <td><?php echo $registros['curp']; ?></td>
                                <td><?php echo $registros['clave_elector']; ?></td>
                                <td><?php echo $registros['num_ine']; ?></td>
                                <td><?php echo $registros['rfc']; ?></td>
                                <td><?php echo $registros['estado']; ?></td>

                                <td>
                                    <form action="generar_pdf.php" method="POST" target="_new">
                                        <button class="btn btn-xs btn-info" data-toggle="tooltip" title="Descargar Credencial" target="_new" type="submit" name="credencial" value="2"><i class="fa fa-credit-card" aria-hidden="true"></i> Credencial</button>
                                        <button class="btn btn-xs btn-info" data-toggle="tooltip" title="Descargar Formato" target="_new" type="submit" name="formato_afiliacion" value="1" ><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Formato</button>
                                        <input type="hidden" name="idsolicitud_certificacion" value="<?php echo $solicitud['idsolicitud']; ?>">
                                        <input type="hidden" name="folio" value="<?php echo $registros['folio']; ?>">
                                        <input type="hidden" name="generar_formato" value="1">
                                    </form>
                                </td>
                                
                                <td>
                                  <!-- INICIAN BOTONES DE ACCIONES -->
                                  <form action="" method="POST">
                                    <input type="hidden" name="foto_afiliado" value="<?php echo $registros['foto']; ?>">
                                    <a href="<?php echo 'detalle_afiliado.php?folio='.$registros['folio']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a>
                                    <!-- boton editar -->
                                    <?php 
                                    if($permiso_editar == 1){
                                    ?>
                                      <button id="" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="<?php echo '#modalAfiliado'.$registros['folio']; ?>"><i class="fa fa-pencil"></i></i></button>
                                    <?php
                                    }
                                     ?>
                                    <!-- boton eliminar -->
                                    <?php 
                                    if($permiso_eliminar == 1){
                                    ?>
                                      <button type="submit" name="eliminar_afiliado" class="btn btn-danger btn-xs" value="<?php echo $registros['folio']; ?>" onclick="return confirm('¿Desea eliminar la información?');"><i class="fa fa-trash-o"></i></i></button>
                                    <?php
                                    }
                                     ?>
                                                                      
                                  </form>
                                  <!-- TERMINAN BOTONES DE ACCIONES -->
                                <!-- Modal Editar Afiliado - Folio -->
                                  
                                  <?php include('editarAfiliado.php'); ?>
                                  <!-- modal -->

                                <!-- Termina Modal Editar -->
                                </td>

                              </tr>


                            <?php
                            }
                             ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
          </section>

      </section>



      <!--footer start-->
        <?php //include('footer.php'); ?>
      <!--footer end-->

    <!-- Modal Formato de Afiliación -->
    <?php include('agregarAfiliado.php'); ?>
    <!-- modal -->

<div id="modalDescargar" name="modalDescargar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="generar_pdf.php" target="_new" method="POST">
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body text-center">
          <div class="row">
            <h3>Se ha agreado un nuevo afiliado</h3>
            <h3 style="color:#e67e22">¿DESEA DESCARGAR EL FORMATO DE AFILIACIÓN Y LA CREDENCIAL?</h3> 
            <div class="col-md-6">
              <button type="button" style="width:70%" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            <div class="col-md-6">
              <button type="submit" id="btn_descargar" style="width:70%" class="btn btn-success">Descargar</button>
              <input type="hidden" name="folio_primera_vez" value="<?php echo $_GET['folio']; ?>">
            </div>            
          </div>
        </div>
      </div>
    </form>
  </div>
</div>



  </section>


<?php 
  if(isset($_GET['folio']) && $_GET['folio'] != 0){
  ?>
  <script>
    $(document).ready(function() {
      $('#modalDescargar').modal('show');
    });
  </script>
  <?php
  }
 ?>

<script>
    function consultar_check(){
        var seleccionados = ''
        $('.micheckbox:checked').each(
            function() {
                seleccionados += $(this).val() + ",";
                //alert("El checkbox con valor " + $(this).val() + " está seleccionado");
            }

        );
        if(seleccionados.length == 0){
          alert('Debes seleccionar el folio del afiliado');
        }else{
          function abrirEnPestana(url) {
              var a = document.createElement("a");
              a.target = "_new";
              a.href = url;
              a.click();
          }
          var url="generar_pdf.php?lista="+seleccionados;
          abrirEnPestana(url);
        }
        //return alert("EL ARRAY ES: "+seleccionados);
    }

    function mostrar_colonia(){
      document.getElementById('colonia_diferente').style.display = 'block';
    }
    /// GENERAR LOS DIGITOS DE LA CURP
    /*24_07_2017 function generarCURP(){
      abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      random09a = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
      random09b = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
      randomAZ = Math.floor(Math.random() * (26 - 0 + 1)) + 0;

      //var date= document.getElementById('fecha_nacimiento').value;

      /*var d = new Date(date.split("-").reverse().join("-"));
      var dd=d.getDate();
      var mm=d.getMonth()+1;
      var yy=d.getFullYear();
      var newdate = yy+"/"+mm+"/"+dd;*/

      /*24_07_2017 ano = Number($("#fecha_nacimiento").val().slice(6, 10));

      var CURP = [];
      CURP[0] = $("#ap_paterno").val().charAt(0).toUpperCase();
      CURP[1] = $("#ap_paterno").val().slice(1).replace(/\a\e\i\o\u/gi, "").charAt(0).toUpperCase();
      CURP[2] = $("#ap_materno").val().charAt(0).toUpperCase();
      CURP[3] = $("#nombre").val().charAt(0).toUpperCase();
      CURP[4] = ano.toString().slice(2);
      CURP[5] = $("#fecha_nacimiento").val().slice(3, 5);
      CURP[6] = $("#fecha_nacimiento").val().slice(0, 2);
      CURP[7] = $("#sexo").val().toUpperCase();
      CURP[8] = abreviacion[estados.indexOf($("#estado").val().toLowerCase())];
      CURP[9] = $("#ap_paterno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
      CURP[10] = $("#ap_materno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
      CURP[11] = $("#nombre").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();;
      CURP[12] = ano < 2000 ? random09a : abc[randomAZ];
      CURP[13] = random09b;
      return CURP.join("");
    }

    var estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
    var abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

    /*$("#grupo_indigena").keyup(function(){
      //alert(generarCURP());
      //$("#curp").text('ASDF');
      alert(generarCURP());
    });*/

    /*$(document).ready(function() {
      $("#sexo").change(function() {
        document.getElementById("curp_otra").value = 'asdfasd';
        //alert(generarCURP());
      });
    });*/


  function otra_consulta(){

        dia = document.getElementById("dia").value;
        mes = document.getElementById("mes").value;
        anio = document.getElementById("anio").value;
        nombre1 = document.getElementById('nombre').value;
        ap_paterno1 = document.getElementById('ap_paterno').value;
        ap_materno1 = document.getElementById('ap_materno').value;
        sexo1 = document.getElementById('select_sexo').value;


        var estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
        var abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

        prueba_estado = abreviacion[estados.indexOf($("#estado").val().toLowerCase())];

        var curp = generaCurp({
          nombre            : nombre1,
          apellido_paterno  : ap_paterno1,
          apellido_materno  : ap_materno1,
          sexo              : sexo1,
          estado            : prueba_estado,
          fecha_nacimiento  : [dia, mes, anio]
        });
        
        document.getElementById("curp_otra").value = curp;

        calculaRFC();
  }
  function otra_consulta2(){

        dia2 = document.getElementById("dia2").value;
        mes2 = document.getElementById("mes2").value;
        anio2 = document.getElementById("anio2").value;
        nombre2 = document.getElementById('nombre2').value;
        ap_paterno2 = document.getElementById('ap_paterno2').value;
        ap_materno2 = document.getElementById('ap_materno2').value;
        sexo2 = document.getElementById('sexo2').value;


        var estados2 = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
        var abreviacion2 = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

        prueba_estado2 = abreviacion2[estados2.indexOf($("#estado2").val().toLowerCase())];

        var curp2 = generaCurp({
          nombre            : nombre2,
          apellido_paterno  : ap_paterno2,
          apellido_materno  : ap_materno2,
          sexo              : sexo2,
          estado            : prueba_estado2,
          fecha_nacimiento  : [dia2, mes2, anio2]
        });
        
        document.getElementById("curp2").value = curp2;

        calculaRFC2();
  }



  //FUNCIÓN PARA GENERAR EL RFC
  function consultar_organizacion(){
    var pregunta = document.getElementById('select_sexo').value;
    if(pregunta == 'M'){
      document.getElementById('div_organizacion').style.display = 'block';
      document.getElementById("organizacion").focus();
    }else{
      document.getElementById('div_organizacion').style.display = 'none';
    }
  }


  function consultar_grupo(){
    var pregunta = document.getElementById('grupo_indigena').value;

    if(pregunta == 'SI'){
      document.getElementById('campo_oculto').style.display = 'block';
      document.getElementById("nombre_comunidad").focus();
    }else{
      document.getElementById('campo_oculto').style.display = 'none';
    }
  }

  function calculaRFC() {
    function quitaArticulos(palabra) {
      return palabra.replace("DEL ", "").replace("LAS ", "").replace("DE ",
          "").replace("LA ", "").replace("Y ", "").replace("A ", "");
    }
    function esVocal(letra) {
      if (letra == 'A' || letra == 'E' || letra == 'I' || letra == 'O'
          || letra == 'U' || letra == 'a' || letra == 'e' || letra == 'i'
          || letra == 'o' || letra == 'u')
        return true;
      else
        return false;
    }
    nombre = $("#nombre").val();
    apellidoPaterno = $("#ap_paterno").val();
    apellidoMaterno = $("#ap_materno").val();
    fecha = $("#fecha_nacimiento").val();
    var rfc = "";
    apellidoPaterno = quitaArticulos(apellidoPaterno);
    apellidoMaterno = quitaArticulos(apellidoMaterno);
    rfc += apellidoPaterno.substr(0, 1);
    var l = apellidoPaterno.length;
    var c;
    for (i = 0; i < l; i++) {
      c = apellidoPaterno.charAt(i);
      if (esVocal(c)) {
        rfc += c;
        break;
      }
    }
    rfc += apellidoMaterno.substr(0, 1);
    rfc += nombre.substr(0, 1);
    rfc += fecha.substr(8, 10);
    rfc += fecha.substr(3, 5).substr(0, 2);
    rfc += fecha.substr(0, 2);
    // rfc += "-" + homclave;
    $("#rfc2").val(rfc);
    //alert(rfc);
    //document.getElementById("rfc").value = rfc;
  }

  function calculaRFC2() {
    function quitaArticulos(palabra) {
      return palabra.replace("DEL ", "").replace("LAS ", "").replace("DE ",
          "").replace("LA ", "").replace("Y ", "").replace("A ", "");
    }
    function esVocal(letra) {
      if (letra == 'A' || letra == 'E' || letra == 'I' || letra == 'O'
          || letra == 'U' || letra == 'a' || letra == 'e' || letra == 'i'
          || letra == 'o' || letra == 'u')
        return true;
      else
        return false;
    }
    nombre2 = $("#nombre2").val();
    apellidoPaterno2 = $("#ap_paterno2").val();
    apellidoMaterno2 = $("#ap_materno2").val();
    fecha2 = $("#fecha_nacimiento2").val();
    var rfc2 = "";
    apellidoPaterno2 = quitaArticulos(apellidoPaterno2);
    apellidoMaterno2 = quitaArticulos(apellidoMaterno2);
    rfc2 += apellidoPaterno2.substr(0, 1);
    var l = apellidoPaterno2.length;
    var c;
    for (i = 0; i < l; i++) {
      c = apellidoPaterno2.charAt(i);
      if (esVocal(c)) {
        rfc2 += c;
        break;
      }
    }
    rfc2 += apellidoMaterno2.substr(0, 1);
    rfc2 += nombre2.substr(0, 1);
    rfc2 += fecha2.substr(8, 10);
    rfc2 += fecha2.substr(3, 5).substr(0, 2);
    rfc2 += fecha2.substr(0, 2);
    // rfc += "-" + homclave;
    $("#rfc3").val(rfc2);
    //alert(rfc);
    //document.getElementById("rfc").value = rfc;
  }


    function marcar_desmarcar(){
        var marca = document.getElementById('marcar');
        var cb = document.getElementsByName('folios[]');

        for (i=0; i<cb.length; i++){
            if(marca.checked == true){
              cb[i].checked = true
            }else{
              cb[i].checked = false;
            }
        }
     
    }

    ///OCULTAMOS EL MODAL_DESCARGAR DESPUES DE DAR CLIC EN DESCARGAR
    $(document).ready(function() {
      $("#btn_descargar").click(function() {
        $('#modalDescargar').modal('hide');
      });
    });

    ///funciones de bootstrap para mostrar los tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    //FUNCIÓN PARA LIMPIAR EL FORMUARLIO FRM_AFILIACION
    function limpiar(){
      // borra el formulario (asumiendo que sólo hay uno; si hay más, especifica su Id)
      document.getElementById("frm_afiliacion").reset();
    }

    /// FUNCIÓN PARA CONSULTAR LA INFORMACION RELACIONADA AL CP
    $(document).ready(function(){
      // generamos un evento cada vez que se pulse una tecla
      $("#cp").keyup(function(){
      
        // enviamos una petición al servidor mediante AJAX enviando el id
        // introducido por el usuario mediante POST
        $.post("consultar_cp.php", {"cp":$("#cp").val()}, function(data){
        
          // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          if(data.estado){
            $("#estado").val(data.estado);
            $("#num_estado").val(data.num_estado);
          }
          else{
            $("#estado").val("");
          }
            
          // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
          if(data.municipio){
            $("#municipio").val(data.municipio);
            $("#num_municipio").val(data.num_municipio);
          }
          else{
            $("#municipio").val("");
          }

          if(data.ciudad){
            $("#ciudad").val(data.ciudad);
          }
          else{
            $("#ciudad").val("");
          }

        },"json");
      });
    });

    /// FUNCIÓN PARA CONSULTAR LA INFORMACION RELACIONADA AL CP (FORM-EDITAR)
    $(document).ready(function(){
      // generamos un evento cada vez que se pulse una tecla
      $("#cp2").keyup(function(){
      
        // enviamos una petición al servidor mediante AJAX enviando el id
        // introducido por el usuario mediante POST
        $.post("consultar_cp.php", {"cp2":$("#cp2").val()}, function(data2){
        
          // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          if(data2.estado){
            $("#estado2").val(data2.estado);
            $("#num_estado2").val(data2.num_estado2);
          }
          else{
            $("#estado2").val("");
          }
            
          // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
          if(data2.municipio){
            $("#municipio2").val(data2.municipio);
            $("#num_municipio2").val(data2.num_municipio2);
          }
          else{
            $("#municipio2").val("");
          }
          if(data2.ciudad){
            $("#ciudad2").val(data2.ciudad);
          }
          else{
            $("#ciudad2").val("");
          }

        },"json");
      });
    });


    //FUNCIÓN PARA CAMBIAR A MAYUSCULAS EL TEXTO DE UN CAMPO
    function ponerMayusculas(nombre) 
    { 
        nombre.value=nombre.value.toUpperCase(); 
    } 
    function ponerMayusculas2(nombre) 
    { 
        nombre.value=nombre.value.toUpperCase(); 
    } 


    /// FUNCIÓN PARA CALCULAR LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
    function calcularEdad() {
        dia = document.getElementById("dia").value;
        mes = document.getElementById("mes").value;
        anio = document.getElementById("anio").value;
        fecha = anio+'/'+mes+"/"+dia;

        //alert("la fecha es: "+fecha);
      
        //var date= document.getElementById('fecha_nacimiento').value;

        /*var d = new Date(date.split("-").reverse().join("-"));
        var dd=d.getDate();
        var mm=d.getMonth()+1;
        var yy=d.getFullYear();
        var newdate = yy+"/"+mm+"/"+dd;*/

        
        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
        if(edad){
          document.getElementById("edad").value = edad;
          document.getElementById("fecha_nacimiento").value = dia+'/'+mes+"/"+anio;
        }else{
          document.getElementById("edad").value = '';
        }
    }

    function calcularEdad2() {
        dia2 = document.getElementById("dia2").value;
        mes2 = document.getElementById("mes2").value;
        anio2 = document.getElementById("anio2").value;
        fecha2 = anio2+'/'+mes2+"/"+dia2;

        //alert("la fecha es: "+fecha);
      
        //var date= document.getElementById('fecha_nacimiento').value;

        /*var d = new Date(date.split("-").reverse().join("-"));
        var dd=d.getDate();
        var mm=d.getMonth()+1;
        var yy=d.getFullYear();
        var newdate = yy+"/"+mm+"/"+dd;*/

        
        var hoy2 = new Date();
        var cumpleanos2 = new Date(fecha2);
        var edad2 = hoy2.getFullYear() - cumpleanos2.getFullYear();
        var m2 = hoy2.getMonth() - cumpleanos2.getMonth();

        if (m2 < 0 || (m2 === 0 && hoy2.getDate() < cumpleanos2.getDate())) {
            edad2--;
        }
        if(edad2){
          document.getElementById("edad2").value = edad2;
          document.getElementById("fecha_nacimiento2").value = dia2+'/'+mes2+"/"+anio2;
        }else{
          document.getElementById("edad2").value = '';
        }
    }


    ///FUNCIÓN PARA CREAR UN SELECT DE LAS COLONIAS DE UN CP
    $(document).on('ready',function(){

      $('#cp').keyup(function(){
        var url = 'select_colonia.php';                                   

        $.ajax({                        
           type: 'POST',                 
           url: url,                    
           data: $('#frm_afiliacion').serialize(),
           success: function(data)           
           {
             $('#colonia').html(data);          
           }
         });
      });
    });

    ///FUNCIÓN PARA CREAR UN SELECT DE LAS COLONIAS DE UN CP
    $(document).on('ready',function(){

      $('#cp2').keyup(function(){
        var url = 'select_colonia2.php';                                   

        $.ajax({                        
           type: 'POST',                 
           url: url,                    
           data2: $('#editar_afiliacion').serialize(),
           success: function(data2)           
           {
             $('#colonia2').html(data2);          
           }
         });
      });
    });



    /// FUNCIÓN PARA VALIDAR LOS CAMPOS OBLIGATORIOS
    function validar() {
        ap_paterno = document.getElementById("ap_paterno").value;
        if ( ap_paterno == null || ap_paterno.length == 0 || /^\s+$/.test(ap_paterno)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL APELLIDO PATERNO');
            document.getElementById("ap_paterno").focus();
            return false;
        }
        ap_materno = document.getElementById("ap_materno").value;
        if ( ap_materno == null || ap_materno.length == 0 || /^\s+$/.test(ap_materno)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL APELLIDO MATERNO');
            document.getElementById("ap_materno").focus();
            return false;
        }
        nombre = document.getElementById("nombre").value;
        if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NOMBRE');
            document.getElementById("nombre").focus();
            return false;
        }
        foto_afiliado = document.getElementById("foto_afiliado").value;
        if ( foto_afiliado == null || foto_afiliado.length == 0 || /^\s+$/.test(foto_afiliado)) {
        // Si no se cumple la condicion...
            alert('DEBES SELECCIONAR UNA FOTO DEL AFILIADO');
            document.getElementById("foto_afiliado").focus();
            return false;
        }

        dia = document.getElementById("dia").selectedIndex;
        if( dia == null || dia == 0 ) {
            alert('DEBES SELECCIONAR EL DÍA DE NACIMIENTO');
            document.getElementById("dia").focus();
            return false;
        }
        mes = document.getElementById("mes").selectedIndex;
        if( mes == null || mes == 0 ) {
            alert('DEBES SELECCIONAR EL MES DE NACIMIENTO');
            document.getElementById("mes").focus();
            return false;
        }

        anio = document.getElementById("anio").value;
        if ( anio == null || anio.length == 0 || /^\s+$/.test(anio)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL AÑO DE NACIMIENTO');
            document.getElementById("anio").focus();
            return false;

        }
        /*fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
        if ( fecha_nacimiento == null || fecha_nacimiento.length == 0 || /^\s+$/.test(fecha_nacimiento)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA FECHA DE NACIMIENTO');
            document.getElementById("fecha_nacimiento").focus();
            return false;
        }*/
        select_sexo = document.getElementById("select_sexo").selectedIndex;
        if( select_sexo == null || select_sexo == 0 ) {
            alert('DEBES SELECCIONAR EL SEXO');
            document.getElementById("select_sexo").focus();
            return false;
        }
        edad = document.getElementById("edad").value;
        if ( edad == null || edad.length == 0 || /^\s+$/.test(edad)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA EDAD');
            document.getElementById("edad").focus();
            return false;

        }
        estado_civil = document.getElementById("estado_civil").selectedIndex;
        if( estado_civil == null || estado_civil == 0 ) {
            alert('DEBES SELECCIONAR EL ESTADO CIVIL');
            document.getElementById("estado_civil").focus();
            return false;
        }
        grupo_indigena = document.getElementById("grupo_indigena").selectedIndex;
        if( grupo_indigena == null || grupo_indigena == 0 ) {
            alert('DEBES SELECCIONAR SI PERTENECE A UN GRUPO INDÍGENA');
            document.getElementById("grupo_indigena").focus();
            return false;
        }
        respuesta_grupo = document.getElementById('grupo_indigena').value;
        nombre_comunidad = document.getElementById('nombre_comunidad').value;
        if(respuesta_grupo == 'SI' && (nombre_comunidad == null || nombre_comunidad.length == 0 || /^\s+$/.test(nombre_comunidad))){
          alert('DEBES ESCRIBIR EL NOMBRE DEL GRUPO INDÍGENA');
          document.getElementById("nombre_comunidad").focus();
          return false;
        }

        cp = document.getElementById("cp").value;
        if ( cp == null || cp.length == 0 || /^\s+$/.test(cp)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL CODIGO POSTAL');
            document.getElementById("cp").focus();
            return false;
        }
        calle = document.getElementById("calle").value;
        if ( calle == null || calle.length == 0 || /^\s+$/.test(calle)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA CALLE');
            document.getElementById("calle").focus();
            return false;
        }
        correo = document.getElementById("correo").value;
        if ( correo == null || correo.length == 0 || /^\s+$/.test(correo)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR UN CORREO ELECTRONICO');
            document.getElementById("correo").focus();
            return false;
        }
        telefono = document.getElementById("telefono").value;
        if ( telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR UN TELEFONO');
            document.getElementById("telefono").focus();
            return false;
        }
        curp = document.getElementById("curp").value;
        if ( curp == null || curp.length == 0 || /^\s+$/.test(curp)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NUMERO DE CURP');
            document.getElementById("curp").focus();
            return false;
        }
        rfc = document.getElementById("rfc").value;
        if ( rfc == null || rfc.length == 0 || /^\s+$/.test(rfc)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL RFC');
            document.getElementById("rfc").focus();
            return false;
        }
        clave_elector = document.getElementById("clave_elector").value;
        if ( clave_elector == null || clave_elector.length == 0 || /^\s+$/.test(clave_elector)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA CLAVE DE ELECTOR');
            document.getElementById("clave_elector").focus();
            return false;
        }
        num_ine = document.getElementById("num_ine").value;
        if ( num_ine == null || num_ine.length == 0 || /^\s+$/.test(num_ine)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NUMERO DE INE');
            document.getElementById("num_ine").focus();
            return false;
        }
       
        return true;
    }


  </script>

<script type="text/javascript">


      /*$(document).ready(function() {

        $("#agregar_afiliado").click(function() {
          var ruta = 'prueba_ajax.php';    
           var formData = new FormData(('#frm_afiliacion').serialize());                               

          $.ajax({                        
             url: ruta,
                type: "POST",
                data: formData,
              
             success: function(data)           
             {
               $('#desplegar').html(data);
               $('#modal_frm_afiliado').modal('hide');
               document.getElementById("frm_afiliacion").reset();
             }
           });
        });
      });*/

    /*17_07_2017
        $(function(){
            $("#frm_afiliacion").on("submit", function(e){
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("frm_afiliacion"));
                formData.append("dato", "valor");
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                $.ajax({
                    url: "prueba_ajax.php",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function(res){
                        $('#modal_frm_afiliado').modal('hide');
                        document.getElementById("frm_afiliacion").reset();
                        //$("#desplegar").html("Respuesta: " + res);
                        location.reload(true);
                    });
            });
        });
        17_07_2017*/

</script>


    <script src="js/jquery.js"></script>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="js/respond.min.js" ></script>
  <!--<script type="text/javascript" src="assets/fuelux/js/spinner.min.js"></script>-->
  <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <!--right slidebar-->
    <script src="js/slidebars.min.js"></script>

    <!--dynamic table initialization -->
    <script src="js/dynamic_table_init.js"></script>


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

  </body>
</html>
