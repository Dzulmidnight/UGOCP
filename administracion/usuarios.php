<?php 
  require('../conexion/conexion.php');
  require('../conexion/sesion.php');
  $idadministrador = $_SESSION['administrador']['idadministrador'];

  $query_admin = "SELECT root FROM administradores WHERE idadministrador = $idadministrador";
  $ejecutar = $mysqli->query($query_admin);
  $permisos = $ejecutar->fetch_assoc();
  $root = $permisos['root'];

  if($root != 1){
    header('Location: index.php');
  }


  if(isset($_POST['guardar_usuario']) && $_POST['guardar_usuario'] == 1){
    $nombre01 = $_POST['nombre01'];
    $ap_paterno01 = $_POST['ap_paterno01'];
    $ap_materno01 = $_POST['ap_materno01'];
    $telefono01 = $_POST['telefono01'];
    $correo01 = $_POST['correo01'];
    $usuario01 = $_POST['usuario01'];
    $password01 = $_POST['password01'];

    if(isset($_POST['agregar01'])){
      $agregar = 1;
    }else{
      $agregar = 0;
    }
    if(isset($_POST['editar01'])){
      $editar = 1;
    }else{
      $editar = 0;
    }
    if(isset($_POST['eliminar01'])){
      $eliminar = 1;
    }else{
      $eliminar = 0;
    }
    if(isset($_POST['root01'])){
      $root = 1;
    }else{
      $root = 0;
    }


    if(($agregar == 1) && ($editar == 1) && ($eliminar == 1)){
      $tipo01 = 'administrador';
    }else{
      $tipo01 = 'usuario';
    }

    $sql = "INSERT INTO administradores(nombre, ap_paterno, ap_materno, telefono, correo, username, password, agregar, editar, eliminar, root, tipo) VALUES ('$nombre01', '$ap_paterno01', '$ap_materno01', '$telefono01', '$correo01', '$usuario01', '$agregar', '$editar', '$eliminar', '$password01', '$root01', '$tipo01')";
    $mysqli->query($sql);

  }
  if(isset($_POST['eliminar_usuario'])){
    $idadministrador = $_POST['eliminar_usuario'];
    $sql = "DELETE FROM administradores WHERE idadministrador = $idadministrador";
    $mysqli->query($sql);
  }
  if(isset($_POST['guardar_cambios'])){
    $idadministrador = $_POST['guardar_cambios'];

    $nombre = $_POST['nombre'.$idadministrador];
    $ap_paterno = $_POST['ap_paterno'.$idadministrador];
    $ap_materno = $_POST['ap_materno'.$idadministrador];
    $telefono = $_POST['telefono'.$idadministrador];
    $correo = $_POST['correo'.$idadministrador];
    $usuario = $_POST['usuario'.$idadministrador];
    $password = $_POST['password'.$idadministrador];
    if(isset($_POST['agregar'.$idadministrador])){
      $agregar = 1;
    }else{
      $agregar = 0;
    }
    if(isset($_POST['editar'.$idadministrador])){
      $editar = 1;
    }else{
      $editar = 0;
    }
    if(isset($_POST['eliminar'.$idadministrador])){
      $eliminar = 1;
    }else{
      $eliminar = 0;
    }
    if(isset($_POST['root'.$idadministrador])){
      $root = 1;
    }else{
      $root = 0;
    }

    $sql = "UPDATE administradores SET nombre = '$nombre', ap_paterno = '$ap_paterno', ap_materno = '$ap_materno', telefono = '$telefono', correo = '$correo', username = '$usuario', password = '$password', agregar = '$agregar', editar = '$editar', eliminar = '$eliminar', root = '$root' WHERE idadministrador = $idadministrador";
    $mysqli->query($sql);
  }

  $menu = 'usuarios';



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

    <title>Administración - Usuarios</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />

      <!--right slidebar-->
      <link href="css/slidebars.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="full-width">

  <section id="container" class="">

      <!--header end-->
      <!--sidebar start-->
      <?php 
      include('aside.php'); 
      ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">
          <!-- page start-->
          <section class="panel">
            <header class="panel-heading">
              Usuarios Registrados
            </header>
            <div class="panel-body">
              <div class="adv-table editable-table">
                <div class="clearfix">
                  <div class="btn-group">
                    <button id="" class="btn green" onclick="nuevo_registro()">
                      Nuevo Registro <i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>

                <div class="space15"></div>



                <div class="table-responsive">
                  <form action="" method="POST">
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                          <tr>
                              <th>Permisos</th>
                              <th>Nombre</th>
                              <th>Ap Paterno</th>
                              <th>Ap Materno</th>
                              <th>Telefono</th>
                              <th>Correo</th>
                              <th>Usuario</th>
                              <th>Contraseña</th>
                              <th>Editar</th>
                              <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $query = "SELECT * FROM administradores";
                          $ejecutar = $mysqli->query($query);
                          
                          while($registros = $ejecutar->fetch_assoc()){
                          ?>
                            <tr id="<?php echo 'row_info'.$registros['idadministrador']; ?>" class="">
                                <td style="font-size: 10px;">
                                  <div class="checkbox">
                                    <label>
                                      <input id="agregar" name="<?php echo 'agregar'.$registros['idadministrador']; ?>" type="checkbox" <?php if($registros['agregar']){ echo 'checked'; } ?> value="1"> Agregar
                                    </label>
                                  </div>
                                  <div class="checkbox">
                                    <label>
                                      <input id="editar" name="<?php echo 'editar'.$registros['idadministrador']; ?>" type="checkbox" <?php if($registros['editar']){ echo 'checked'; } ?> value="1"> Editar
                                    </label>
                                  </div>
                                  <div class="checkbox">
                                    <label>
                                      <input id="eliminar" name="<?php echo 'eliminar'.$registros['idadministrador']; ?>" type="checkbox" <?php if($registros['eliminar']){ echo 'checked'; } ?> value="1"> Eliminar
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'nombre'.$registros['idadministrador']; ?>" value="<?php echo $registros['nombre']; ?>" readonly>
                                  <label>
                                      <input id="root" name="<?php echo 'root'.$registros['idadministrador']; ?>" type="checkbox" <?php if($registros['root']){ echo 'checked'; } ?> value="1">Root
                                  </label>
                                </td>
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'ap_paterno'.$registros['idadministrador']; ?>" value="<?php echo $registros['ap_paterno']; ?>" readonly>
                                  
                                </td>
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'ap_materno'.$registros['idadministrador']; ?>" value="<?php echo $registros['ap_materno']; ?>" readonly>
                                  
                                </td>
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'telefono'.$registros['idadministrador']; ?>" value="<?php echo $registros['telefono']; ?>" readonly>
                                  
                                </td>
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'correo'.$registros['idadministrador']; ?>" value="<?php echo $registros['correo']; ?>" readonly>
                                  
                                </td>

                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'usuario'.$registros['idadministrador']; ?>" value="<?php echo $registros['username']; ?>" readonly>
                                </td>
                                <td class="center">
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idadministrador']; ?> form-control" name="<?php echo 'password'.$registros['idadministrador']; ?>" value="<?php echo $registros['password']; ?>" readonly>
                                </td>
                                <td id="<?php echo 'td-editar'.$registros['idadministrador']; ?>">
                                  <!--<button type="submit" class="" name="editar_usuario" value="<?php echo $registros['idadministrador']; ?>" onclick="editar('<?php echo $registros['idadministrador']; ?>')">Editar</button>-->
                                  <a id="btn-editar" class="" href="#" onclick="editar('<?php echo $registros['idadministrador']; ?>')">Editar</a>
                                </td>
                                <td id="<?php echo 'td-eliminar'.$registros['idadministrador']; ?>">
                                  <button class="btn btn-danger btn-xs" type="submit" class="" name="eliminar_usuario" value="<?php echo $registros['idadministrador'] ?>" onclick="return confirm('¿Desea eliminar el usuario?');">Eliminar</button>
                                  <!--<a id="btn-eliminar" class="delete" href="">Eliminar</a>-->
                                </td>
                            </tr>
                          <?php  
                          }

                        ?>
                        </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </section>
          <!-- page end-->
        </section>
      </section>

  <section>
  

  </section>

      <!--main content end-->
      <!-- Right Slidebar start -->
  
      <!-- Right Slidebar end -->
      <!--footer start-->
      <?php include('footer.php'); ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="js/respond.min.js" ></script>

  <!--right slidebar-->
  <script src="js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

      <!--script for this page only-->
      <script src="js/editable-table.js"></script>

      <!-- END JAVASCRIPTS -->
      <script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });

          function nuevo_registro(){
            var table = document.getElementById("editable-sample");
            {
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                var cell9 = row.insertCell(8);
                var cell10 = row.insertCell(9);

                cell1.innerHTML = '<div style="font-size:10px;" class="checkbox"><label><input type="checkbox" name="agregar01" value="1">Agregar</label></div><div style="font-size:10px;" class="checkbox"><label><input type="checkbox" name="editar01" value="1">Editar</label></div><div style="font-size:10px;" class="checkbox"><label><input type="checkbox" name="eliminar01" value="1">Eliminar</label></div>'
                cell2.innerHTML = '<input type="text" class="form-control" name="nombre01" id="" placeholder=""><label><input type="checkbox" name="root01" value="1">Root</label>';
                cell3.innerHTML = '<input type="text" class="form-control" name="ap_paterno01" id="" placeholder="">';
                cell4.innerHTML = '<input type="text" class="form-control" name="ap_materno01" id="" placeholder="">';
                cell5.innerHTML = '<input type="text" class="form-control" name="telefono01" id="" placeholder="">';
                cell6.innerHTML = '<input type="text" class="form-control" name="correo01" id="" placeholder="">';
                cell7.innerHTML = '<input type="text" class="form-control" name="usuario01" id="" placeholder="">';
                cell8.innerHTML = '<input type="text" class="form-control" name="password01" id="" placeholder="">';
                cell9.innerHTML = '<button class="btn btn-success btn-xs" type="submit" id="btn-editar" name="guardar_usuario" class="" value="1">Guardar</button>';
                //cell5.innerHTML = '<button type="submit" class="" value="1" >Guardar</button><a id="btn-editar" class="" href="#" onclick="editar()">Guardar</a>';
                cell10.innerHTML = '<a id="btn-eliminar" class="delete" href="#" onclick="quitar_registro()">Cancelar</a>';
            }
          }
          function quitar_registro(){
            var table = document.getElementById("editable-sample");
            {
                var row = table.deleteRow(1);
            }
          }

          function editar(id){
            var x = 'frm-usuario'+id;
            var td_editar = 'td-editar'+id;
            var td_eliminar = 'td-eliminar'+id;
            /*var elements = document.querySelectorAll(x, '.frm-usuario');

            for(var i = 0, length = elements.length; i < length; i++) {
                elements[i].readOnly = false;
            }*/

            var elements = document.getElementsByClassName(''+x+'');
            for(var i = 0, length = elements.length; i < length; i++) {
                elements[i].readOnly = false;

            }
            //Se guardan los cambios realizados al editar el usuario
            document.getElementById(""+td_editar+"").innerHTML = "<button class='btn btn-success btn-xs' type='submit' id='btn-editar' name='guardar_cambios' class='' value='"+id+"'>Guardar</button>";
            //Se bloquean los campos del formulario
            document.getElementById(""+td_eliminar+"").innerHTML = "<a id='btn-eliminar' class='' href='#' onclick='cancelar("+id+")'>Cancelar</a>";
            /*document.getElementById("''").innerHTML = "<a id='btn-eliminar' class='' href='#' onclick='guardar()'>Guardar</a>";

            document.getElementById("td-eliminar").innerHTML = "<a id='btn-eliminar' class='' href='#' onclick='cancelar()'>Cancelar</a>";*/
          }
          function cancelar(id){
            /*var x = id;
            var td_editar = 'td-editar'+id;
            var elements = document.getElementsByClassName(''+x+'');
            for(var i = 0, length = elements.length; i < length; i++) {
                elements[i].readOnly = true;
            }
            document.getElementById("td-editar").innerHTML = "<a id='btn-editar' class=' href='#' onclick='editar()'>Editar</a>";*/
            var x = 'frm-usuario'+id;
            var td_editar = 'td-editar'+id;
            var td_eliminar = 'td-eliminar'+id;

            var elements = document.getElementsByClassName(''+x+'');
              for(var i = 0, length = elements.length; i < length; i++) {
                elements[i].readOnly = true;
            }

            document.getElementById(""+td_editar+"").innerHTML = "<a id='btn-editar"+id+"' class='' href='#' onclick='editar("+id+")'>Editar</a>";
            document.getElementById(""+td_eliminar+"").innerHTML = "<button class='btn btn-danger btn-xs' type='submit' class=' name='eliminar_usuario' value='"+id+"'>Eliminar</button>";

            
          }
          function guardar(){
            alert('Se han guardado los datos');
          }
      </script>


  </body>
</html>
