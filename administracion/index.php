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

      $insertSQL = "INSERT INTO afiliado (organizacion, curp, clave_elector, num_ine, rfc, idadm, foto) VALUES ('$organizacion', '$curp', '$_POST[clave_elector]', '$_POST[num_ine]', '$rfc', $idadministrador, '$foto_afiliado')";
      $insertar = $mysqli->query($insertSQL);


      $folio = $mysqli->insert_id;

      if(empty($_POST['colonia_diferente'])){
        $colonia = $_POST['colonia'];
      }else{
        $colonia = $_POST['colonia_diferente'];
      }

      $dia = $_POST['dia'];
      $mes = $_POST['mes'];
      $anio = $_POST['anio'];

      $fecha_nacimiento = $dia.'/'.$mes.'/'.$anio;

      $insertSQL = "INSERT INTO datos_generales(folio, nombre, ap_paterno, ap_materno, calle, numero, colonia, cp, municipio, num_municipio, estado, num_estado, ciudad, telefono, correo, celular, edad, sexo, estado_civil, dia, mes, anio, fecha_nacimiento, grupo_indigena, nombre_comunidad) VALUES ($folio, '$_POST[nombre]', '$_POST[ap_paterno]', '$_POST[ap_materno]', '$_POST[calle]', '$_POST[numero]', '$colonia', '$_POST[cp]', '$_POST[municipio]', $_POST[num_municipio], '$_POST[estado]', $_POST[num_estado], '$_POST[ciudad]', '$_POST[telefono]', '$_POST[correo]', '$_POST[celular]', '$_POST[edad]', '$_POST[select_sexo]', '$_POST[estado_civil]', '$_POST[dia]', '$_POST[mes]', '$_POST[anio]', '$_POST[fecha_nacimiento]', '$_POST[grupo_indigena]', '$_POST[nombre_comunidad]')";
      $insertar = $mysqli->query($insertSQL);


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
        $direccion = $detalle['calle'].' #'.$detalle['numero'].', COL. '.$detalle['colonia'].', C.P. '.$detalle['cp'].', MUNICIPIO '.$detalle['municipio'].', CIUDAD '.$detalle['ciudad'].','.$detalle['estado'];

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
      $rfc = strtoupper($_POST['rfc']);

      $updateSQL = "UPDATE afiliado SET curp = '$curp', clave_elector = '$_POST[clave_elector]', num_ine = '$_POST[num_ine]', rfc = '$rfc', foto = '$foto_afiliado', idadm = $idadministrador WHERE folio = $folio";
      $actualizar = $mysqli->query($updateSQL);

      /// actualizamos los datos_generales

      $updateSQL = "UPDATE datos_generales SET nombre = '$_POST[nombre]', ap_paterno = '$_POST[ap_paterno]', ap_materno = '$_POST[ap_materno]', calle = '$_POST[calle]', numero = '$_POST[numero]', colonia = '$_POST[colonia]', cp = '$_POST[cp]', municipio = '$_POST[municipio]', estado = '$_POST[estado]', ciudad = '$_POST[ciudad]', telefono = '$_POST[telefono]', correo = '$_POST[correo]', celular = '$_POST[celular]', edad = '$_POST[edad]', sexo = '$_POST[sexo]', estado_civil = '$_POST[estado_civil]', dia = '$_POST[dia]', mes = '$_POST[mes]', anio = '$_POST[anio]', fecha_nacimiento = '$_POST[fecha_nacimiento]', grupo_indigena = '$_POST[grupo_indigena]', nombre_comunidad = '$_POST[nombre_comunidad]' WHERE folio = $folio";
      $actualizar = $mysqli->query($updateSQL);

      /// actualizamos la información laboral

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
    <meta name="author" content="Inforganic technologies">
    <meta name="keyword" content="UGOCP, ugocp, obrero campesina, union general obrero campeasin, sindicato ugocp, ugocp oaxaca">
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
    }
    function mostrar_colonia(){
      document.getElementById('colonia_diferente').style.display = 'block';
    }

    function consultarFolio(numFolio){
      var numFolio = numFolio;
      //ya
      calcularEdad(numFolio);
      otra_consulta(numFolio);

    }

    ///FUNCION QUE SE LLAMA PARA EL FORMULARIO DE EDITAR AFILIADO //////////////////
    function editarFolio(numFolio){
      var numFolio = numFolio;
      //ya
      calcularEdad(numFolio);
      /// mostramos las organizaciones en caso de que sea mujer
      //no aplica consultar_organizacion(numFolio);
      //consultamos el grupo indigena
      //consultar_grupo();
      otra_consulta(numFolio);
      //// INICIAN FUNCIONES DE CODIGO POSTAL ////
      /// FUNCIÓN PARA CONSULTAR LA INFORMACION RELACIONADA AL CP
      var idcp = '#cp'+numFolio;
      var idestado = '#estado'+numFolio;
      var idnum_estado = '#num_estado'+numFolio;
      var idmunicipio = '#municipio'+numFolio;
      var idnum_municipio = '#num_municipio'+numFolio;
      var idciudad = '#ciudad'+numFolio;
      var idfrm_editar_afiliado = '#frm_editar_afiliado'+numFolio
      var idcolonia = '#colonia'+numFolio;

      $(document).ready(function(){
        // generamos un evento cada vez que se pulse una tecla
        $(idcp).keyup(function(){

          // enviamos una petición al servidor mediante AJAX enviando el id
          // introducido por el usuario mediante POST
          $.post("consultar_cp.php", {"cp":$('#cp'+numFolio).val()}, function(data){

            // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
            if(data.estado){
              $('#estado'+numFolio).val(data.estado);
              $('#num_estado'+numFolio).val(data.num_estado);
            }
            else{
              $('#estado'+numFolio).val("");
            }

            // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
            if(data.municipio){
              $('#municipio'+numFolio).val(data.municipio);
              $('#num_municipio'+numFolio).val(data.num_municipio);
            }
            else{
              $('#municipio'+numFolio).val("");
            }

            if(data.ciudad){
              $('#ciudad'+numFolio).val(data.ciudad);
            }
            else{
              $('#ciudad'+numFolio).val("");
            }

          },"json");
        });
      });
      ///FUNCIÓN PARA CREAR UN SELECT DE LAS COLONIAS DE UN CP
      $(document).on('ready',function(){

        $('#cp'+numFolio).keyup(function(){
          var url = 'select_colonia2.php';

          $.ajax({
             type: 'POST',
             url: url,
             data: $('#frm_editar_afiliado'+numFolio).serialize(),
             success: function(data)
             {
               $('#colonia'+numFolio).html(data);
             }
           });
        });
      });

      ///// TERMINAN FUNCIONES DE CODIGO POSTAL ///
    }


    function otra_consulta(numFolio){
      nombre = document.getElementById("nombre"+numFolio).value;
      ap_paterno = document.getElementById("ap_paterno"+numFolio).value;
      ap_materno = document.getElementById("ap_materno"+numFolio).value;

      dia = document.getElementById("dia"+numFolio).value;
      mes = document.getElementById("mes"+numFolio).value;
      anio = document.getElementById("anio"+numFolio).value;

      sexo = document.getElementById("select_sexo"+numFolio).value;
      estado = 'estado'+numFolio;
      idestado = '#estado'+numFolio;

       estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
        var abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

      prueba_estado = abreviacion[estados.indexOf($('#estado'+numFolio).val().toLowerCase())];

      var curp = generaCurp({
        nombre            : nombre,
        apellido_paterno  : ap_paterno,
        apellido_materno  : ap_materno,
        sexo              : sexo,
        estado            : prueba_estado,
        fecha_nacimiento  : [dia, mes, anio]
      });
      document.getElementById("curp"+numFolio).value = curp;
      calculaRFC(numFolio);
    }

    /// INICIA funciones para consultar el codigo postal ///
    /// FUNCIÓN PARA CONSULTAR LA INFORMACION RELACIONADA AL CP
    $(document).ready(function(){
      // generamos un evento cada vez que se pulse una tecla
      $("#cp_add").keyup(function(){

        // enviamos una petición al servidor mediante AJAX enviando el id
        // introducido por el usuario mediante POST
        $.post("consultar_cp.php", {"cp":$("#cp_add").val()}, function(data){

          // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          if(data.estado){
            $("#estado_add").val(data.estado);
            $("#num_estado_add").val(data.num_estado);
          }
          else{
            $("#estado_add").val("");
          }

          // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
          if(data.municipio){
            $("#municipio_add").val(data.municipio);
            $("#num_municipio_add").val(data.num_municipio);
          }
          else{
            $("#municipio_add").val("");
          }

          if(data.ciudad){
            $("#ciudad_add").val(data.ciudad);
          }
          else{
            $("#ciudad_add").val("");
          }

        },"json");
      });
    });
    ///FUNCIÓN PARA CREAR UN SELECT DE LAS COLONIAS DE UN CP
    $(document).on('ready',function(){

      $('#cp_add').keyup(function(){
        var url = 'select_colonia.php';

        $.ajax({
           type: 'POST',
           url: url,
           data: $('#frm_afiliacion').serialize(),
           success: function(data)
           {
             $('#colonia_add').html(data);
           }
         });
      });
    });
    /// TERMINA funciones para consular el codigo postal //
    /// FUNCIÓN PARA CALCULAR LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
    function calcularEdad(numFolio) {
        dia = document.getElementById("dia"+numFolio).value;
        mes = document.getElementById("mes"+numFolio).value;
        anio = document.getElementById("anio"+numFolio).value;
        fecha = anio+'/'+mes+"/"+dia;
        console.log('dia: '+dia);
        console.log('mes: '+mes);
        console.log('anio: '+anio);
        console.log('fecha: '+fecha);

        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
        if(edad){
          document.getElementById("edad"+numFolio).value = edad;
          document.getElementById("fecha_nacimiento"+numFolio).value = fecha;
        }else{
          document.getElementById("edad"+numFolio).value = '';
        }
    }

    function consultar_organizacion(numFolio){
      var pregunta = document.getElementById('select_sexo'+numFolio).value;
      if(pregunta == 'M'){
        document.getElementById('div_organizacion').style.display = 'block';
        document.getElementById("organizacion").focus();
      }else{
        document.getElementById('div_organizacion').style.display = 'none';
      }
    }

    function consultar_grupo(numFolio){
      var pregunta = document.getElementById('grupo_indigena'+numFolio).value;

      if(pregunta == 'SI'){
        document.getElementById('campo_oculto').style.display = 'block';
        document.getElementById("nombre_comunidad_add").focus();
      }else{
        document.getElementById('campo_oculto').style.display = 'none';
      }
    }

    function calculaRFC(numFolio) {
      dia = document.getElementById("dia"+numFolio).value;
      mes = document.getElementById("mes"+numFolio).value;
      anio = document.getElementById("anio"+numFolio).value;
      var idNombre = '#nombre'+numFolio;
      var idApPaterno = '#ap_paterno'+numFolio;
      var idApMaterno = '#ap_materno'+numFolio;
      var idFechaNacimiento = '#fecha_nacimiento'+numFolio;

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
      nombre = $(idNombre).val();
      apellidoPaterno = $(idApPaterno).val();
      apellidoMaterno = $(idApMaterno).val();
      //fecha = $(idFechaNacimiento).val();
      fecha = dia+'/'+mes+'/'+anio;
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
      $("#rfc"+numFolio).val(rfc);
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
      //FUNCIÓN PARA CAMBIAR A MAYUSCULAS EL TEXTO DE UN CAMPO
      function ponerMayusculas(nombre)
      {
          nombre.value=nombre.value.toUpperCase();
      }
      function ponerMayusculas2(nombre)
      {
          nombre.value=nombre.value.toUpperCase();
      }


      /// FUNCIÓN PARA VALIDAR LOS CAMPOS OBLIGATORIOS
      function validar() {
          ap_paterno = document.getElementById("ap_paterno_add").value;
          if ( ap_paterno == null || ap_paterno.length == 0 || /^\s+$/.test(ap_paterno)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL APELLIDO PATERNO');
              document.getElementById("ap_paterno_add").focus();
              return false;
          }
          ap_materno = document.getElementById("ap_materno_add").value;
          if ( ap_materno == null || ap_materno.length == 0 || /^\s+$/.test(ap_materno)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL APELLIDO MATERNO');
              document.getElementById("ap_materno_add").focus();
              return false;
          }
          nombre = document.getElementById("nombre_add").value;
          if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL NOMBRE');
              document.getElementById("nombre_add").focus();
              return false;
          }
          foto_afiliado = document.getElementById("foto_afiliado").value;
          if ( foto_afiliado == null || foto_afiliado.length == 0 || /^\s+$/.test(foto_afiliado)) {
          // Si no se cumple la condicion...
              alert('DEBES SELECCIONAR UNA FOTO DEL AFILIADO');
              document.getElementById("foto_afiliado").focus();
              return false;
          }

          dia = document.getElementById("dia_add").selectedIndex;
          if( dia == null || dia == 0 ) {
              alert('DEBES SELECCIONAR EL DÍA DE NACIMIENTO');
              document.getElementById("dia_add").focus();
              return false;
          }
          mes = document.getElementById("mes_add").selectedIndex;
          if( mes == null || mes == 0 ) {
              alert('DEBES SELECCIONAR EL MES DE NACIMIENTO');
              document.getElementById("mes_add").focus();
              return false;
          }

          anio = document.getElementById("anio_add").value;
          if ( anio == null || anio.length == 0 || /^\s+$/.test(anio)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL AÑO DE NACIMIENTO');
              document.getElementById("anio_add").focus();
              return false;

          }

          select_sexo = document.getElementById("select_sexo_add").selectedIndex;
          if( select_sexo == null || select_sexo == 0 ) {
              alert('DEBES SELECCIONAR EL SEXO');
              document.getElementById("select_sexo_add").focus();
              return false;
          }
          edad = document.getElementById("edad_add").value;
          if ( edad == null || edad.length == 0 || /^\s+$/.test(edad)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR LA EDAD');
              document.getElementById("edad_add").focus();
              return false;

          }
          estado_civil = document.getElementById("estado_civil_add").selectedIndex;
          if( estado_civil == null || estado_civil == 0 ) {
              alert('DEBES SELECCIONAR EL ESTADO CIVIL');
              document.getElementById("estado_civil_add").focus();
              return false;
          }
          grupo_indigena = document.getElementById("grupo_indigena_add").selectedIndex;
          if( grupo_indigena == null || grupo_indigena == 0 ) {
              alert('DEBES SELECCIONAR SI PERTENECE A UN GRUPO INDÍGENA');
              document.getElementById("grupo_indigena_add").focus();
              return false;
          }
          respuesta_grupo = document.getElementById('grupo_indigena_add').value;
          nombre_comunidad = document.getElementById('nombre_comunidad_add').value;
          if(respuesta_grupo == 'SI' && (nombre_comunidad == null || nombre_comunidad.length == 0 || /^\s+$/.test(nombre_comunidad))){
            alert('DEBES ESCRIBIR EL NOMBRE DEL GRUPO INDÍGENA');
            document.getElementById("nombre_comunidad_add").focus();
            return false;
          }

          cp = document.getElementById("cp_add").value;
          if ( cp == null || cp.length == 0 || /^\s+$/.test(cp)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL CODIGO POSTAL');
              document.getElementById("cp_add").focus();
              return false;
          }
          calle = document.getElementById("calle_add").value;
          if ( calle == null || calle.length == 0 || /^\s+$/.test(calle)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR LA CALLE');
              document.getElementById("calle_add").focus();
              return false;
          }
          correo = document.getElementById("correo_add").value;
          if ( correo == null || correo.length == 0 || /^\s+$/.test(correo)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR UN CORREO ELECTRONICO');
              document.getElementById("correo_add").focus();
              return false;
          }
          telefono = document.getElementById("telefono_add").value;
          if ( telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR UN TELEFONO');
              document.getElementById("telefono_add").focus();
              return false;
          }
          curp = document.getElementById("curp_add").value;
          if ( curp == null || curp.length == 0 || /^\s+$/.test(curp)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL NUMERO DE CURP');
              document.getElementById("curp_add").focus();
              return false;
          }
          rfc = document.getElementById("rfc_add").value;
          if ( rfc == null || rfc.length == 0 || /^\s+$/.test(rfc)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL RFC');
              document.getElementById("rfc_add").focus();
              return false;
          }
          clave_elector = document.getElementById("clave_elector").value;
          if ( clave_elector == null || clave_elector.length == 0 || /^\s+$/.test(clave_elector)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR LA CLAVE DE ELECTOR');
              document.getElementById("clave_elector_add").focus();
              return false;
          }
          num_ine = document.getElementById("num_ine_add").value;
          if ( num_ine == null || num_ine.length == 0 || /^\s+$/.test(num_ine)) {
          // Si no se cumple la condicion...
              alert('DEBES INGRESAR EL NUMERO DE INE');
              document.getElementById("num_ine_add").focus();
              return false;
          }

          return true;
      }


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
