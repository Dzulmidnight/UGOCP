<?php
    require('../conexion/conexion.php');
    require('../conexion/sesion.php');
    require_once('../funciones/funciones.php');

    if(isset($_SESSION['administrador'])){
        if($_SESSION['administrador']['tipo'] != 'administrador'){
            header('Location: conexion/salir.php');
        }
    }
    $seccion = 'afiliacion';
    $menu = 'formato_afiliacion';

    $idadministrador = $_SESSION['administrador']['idadministrador'];

    if(isset($_POST['agregar_afiliado']) && $_POST['agregar_afiliado'] == 1){
      //$foto_actual = $_POST['foto_actual'];
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

      echo '<script>alert("Se agrego el afiliado");</script>';

    }


 ?>

<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Formato de Afiliación</title>

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->



    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <?php include('header.php'); ?>
      <!--header end-->
      <!--sidebar start-->
      <?php include('aside.php'); ?>
      <!--sidebar end-->
      <!--main content start-->

      <section id="main-content">

          <section class="wrapper">
              <!-- page start-->
              <div class="row">

                  <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="" id="frm_afiliacion">

                    <div id="" style="position:fixed;z-index: 1;right:0">
                      <div class="">
                        <button class="btn btn-warning" type="submit" name="agregar_afiliado" value="1"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> <b>Agregar</b></button>
                        <button class="btn btn-default" type="button" name="btn_limpiar" onclick="limpiar()"><i class="fa fa-eraser"></i> <b>Limpiar</b></button> 
                      </div>
                    </div>

                    <aside class="profile-nav col-lg-3">
                        <section class="panel">
                            <div class="user-heading round">
                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                  <div class="fileupload-new thumbnail" style="width: 145px; height: 170px;">
                                      <img src="http://www.placehold.it/145x170" alt="" />
                                  </div>
                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 145px; max-height: 170px; line-height: 20px;"></div>
                                  <div>
                                   <span class="btn btn-white btn-file">
                                   <span class="fileupload-new" style="color:#000"><i class="fa fa-paper-clip"></i> Agregar Foto</span>
                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                   <input type="file" id="foto_afiliado" name="foto_afiliado" class="default" />
                                   </span>
                                      <!--<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>-->
                                  </div>
                              </div>
                                <!--<h1>Jonathan Smith</h1>
                                <p>jsmith@flatlab.com</p>-->
                            </div>

                            <!--<ul class="nav nav-pills nav-stacked">
                                <li><a href="profile.html"> <i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="profile-activity.html"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>
                                <li  class="active"><a href="profile-edit.html"> <i class="fa fa-edit"></i> Edit profile</a></li>
                            </ul>-->
                            <table class="table">
                              <thead>
                                <tr class="success">
                                  <th>INFORMACIÓN COMPLEMENTARIA</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <input type="text" class="form-control" id="clave_elector" name="clave_elector" placeholder="Clave Elector" onBlur="ponerMayusculas(this)">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <input type="text" class="form-control" id="num_ine" name="num_ine" placeholder="No. Credencial del INE" onBlur="ponerMayusculas(this)">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <input type="text" class="form-control" id="curp" name="curp" placeholder="CURP" onBlur="ponerMayusculas(this)">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" onBlur="ponerMayusculas(this)">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </section>

                    </aside>
                    <aside class="profile-info col-lg-9">
                        <section class="panel">
                            <div class="bio-graph-heading" style="padding:.5em;">
                                <h2>Formato de Afiliación</h2>
                            </div>
                            <div class="panel-body bio-graph-info">
                                <h1>DATOS GENERALES</h1>
                              
                                    <table class="table">
                                      <tr>
                                        <td>
                                          <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="ap_materno" name="ap_materno" placeholder="Apellido Materno" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)" onBlur="ponerMayusculas(this)">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <input type="text" class="form-control" id="cp" name="cp" placeholder="Código Postal" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td style="background: #95a5a6;">
                                          <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td style="background: #95a5a6;">
                                          <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad, Población o Localidad" onBlur="ponerMayusculas(this)">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="background: #95a5a6;">
                                          <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td colspan="2" style="background: #95a5a6;">
                                          <select class="form-control" name="colonia" id="colonia">
                                            <option value="">Colonia</option>
                                          </select>

                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                          <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" onBlur="ponerMayusculas(this)">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <p>Fecha de Nacimiento</p>
                                          <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" onchange="calcularEdad()" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td style="background: #95a5a6;">
                                          <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <select class="form-control" name="estado_civil" id="estado_civil">
                                            <option value="">Estado Civil</option>
                                            <option value="Soltero">Soltero</option>
                                            <option value="Casado">Casado</option>
                                            <option value="Divorciado">Divorciado</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <select class="form-control" name="sexo" id="sexo">
                                            <option value="">Sexo</option>
                                            <option value="H">Hombre</option>
                                            <option value="M">Mujer</option>
                                          </select>
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="grupo_indigena" name="grupo_indigena" placeholder="Grupo Indigena" onBlur="ponerMayusculas(this)">
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="nombre_comunidad" name="nombre_comunidad" placeholder="Nombre del Grupo, Ejido o Comunidad" onBlur="ponerMayusculas(this)">
                                        </td>
                                      </tr>
                                    </table>
                                    <table class="table">
                                      <thead>
                                        <tr class="info">
                                          <th colspan="2">INFORMACIÓN PROFESIONAL O LABORAL</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>
                                            <input type="text" class="form-control" id="ocupacion" name="ocupacion" placeholder="Ocupación" onBlur="ponerMayusculas(this)">
                                          </td>
                                          <td>
                                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo o Puesto que desempeña" onBlur="ponerMayusculas(this)">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre de la Empresa" onBlur="ponerMayusculas(this)">
                                          </td>
                                          <td>
                                            <input type="text" class="form-control" id="tel_oficina" name="tel_oficina" placeholder="Tels de Oficina" onBlur="ponerMayusculas(this)">
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                            </div>
                        </section>


                    </aside>                    
                  </form>

              </div>


              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!-- Right Slidebar start -->

      <!-- Right Slidebar end -->
      <!--footer start-->
      <?php include('footer.php'); ?>
      <!--footer end-->
  </section>

    <script>
      // cuando se muestre la página
      function limpiar(){
          // borra el formulario (asumiendo que sólo hay uno; si hay más, especifica su Id)
          document.getElementById("frm_afiliacion").reset();
          //document.querySelector("form").reset();
      }
    </script>
    <script>
      $(document).ready(function(){

        // generamos un evento cada vez que se pulse una tecla
        $("#cp").keyup(function(){
        
          // enviamos una petición al servidor mediante AJAX enviando el id
          // introducido por el usuario mediante POST
          $.post("consultar_cp.php", {"cp":$("#cp").val()}, function(data){
          
            // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
            if(data.estado)
              $("#estado").val(data.estado);
            else
              $("#estado").val("");
              
            // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
            if(data.municipio)
              $("#municipio").val(data.municipio);
            else
              $("#municipio").val("");

            if(data.ciudad)
              $("#ciudad").val(data.ciudad);
            else
              $("#ciudad").val("");

            /* SE GENERAN LAS OPCIONES DEL SELECT COLONIA
            if(data.colonia)
              $('#colonia').append($('<option>', {
                  value: data.colonia,
                  text: data.colonia
              }));
              //$("#colonia").val(data.innerHTML = "<option>data</option>");
            else
              $("#colonia").val("");

            */

          },"json");
        });
      });
    </script>
    <script>
      function ponerMayusculas(nombre) 
      { 
          nombre.value=nombre.value.toUpperCase(); 
      } 

      function calcularEdad() {
          fecha = document.getElementById("fecha_nacimiento").value;
          edad = '24'
          
          var hoy = new Date();
          var cumpleanos = new Date(fecha);
          var edad = hoy.getFullYear() - cumpleanos.getFullYear();
          var m = hoy.getMonth() - cumpleanos.getMonth();

          if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
              edad--;
          }
          if(edad){
            document.getElementById("edad").value = edad;
          }else{
            document.getElementById("edad").value = '';
          }
          
      }
    </script>
  
    <script>
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
    </script>



    <!-- js placed at the end of the document so the pages load faster -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>
  
    <!--this page plugins-->

  <script type="text/javascript" src="assets/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>



  <!--right slidebar-->
  <script src="js/slidebars.min.js"></script>

  <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <!--this page  script only-->




  </body>
</html>
