<?php 
    require('../conexion/conexion.php');
    require('../conexion/sesion.php');

    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['tipo'] != 'administrador'){
            header('Location: conexion/salir.php');
        }
    }
/*$sql2="SELECT idSolicitante FROM Solicitante ORDER BY idSolicitante DESC LIMIT 1";
            $idsol=$mysqli->query($sql2);
            $resultado=$idsol->fetch_assoc();
*/
  if(isset($_POST['guardar_usuario']) && $_POST['guardar_usuario'] == 1){
    $nombre = $_POST['nombre1'];
    $user = $_POST['user1'];
    $tipo = $_POST['tipo1'];
    $password = $_POST['password1'];

    $sql = "INSERT INTO usuarios (nombre, user, password, tipo) VALUES ('$nombre', '$user', '$password', '$tipo')";
    $mysqli->query($sql);

  }
  if(isset($_POST['eliminar_usuario'])){
    $idusuario = $_POST['eliminar_usuario'];
    $sql = "DELETE FROM usuarios WHERE idusuario = $idusuario";
    $mysqli->query($sql);
  }
  if(isset($_POST['guardar_cambios'])){
    $idusuario = $_POST['guardar_cambios'];
    $nombre = $_POST['nombre'.$idusuario];
    $user = $_POST['user'.$idusuario];
    $tipo = $_POST['tipo'.$idusuario];
    $password = $_POST['password'.$idusuario];
    $sql = "UPDATE usuarios SET nombre = '$nombre', user = '$user', tipo = '$tipo', password = '$password' WHERE idusuario = $idusuario";
    $mysqli->query($sql);
  }

  $seccion = 'informacion';
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

  <body>

  <section id="container" class="">
      <!--header start-->
      <?php 
      include('header.php');
       ?>
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
                              <th>Nombre completo</th>
                              <th>Tipo</th>
                              <th>Usuario</th>
                              <th>Contraseña</th>
                              <th>Editar</th>
                              <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $query = "SELECT * FROM usuarios";
                          $ejecutar = $mysqli->query($query);
                          
                          while($registros = $ejecutar->fetch_assoc()){
                          ?>
                            <tr id="<?php echo 'row_info'.$registros['idusuario']; ?>" class="">
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idusuario']; ?> form-control" name="<?php echo 'nombre'.$registros['idusuario']; ?>" value="<?php echo $registros['nombre']; ?>" readonly>
                                  
                                </td>
                                <td>
                                  <select class="<?php echo 'frm-usuario'.$registros['idusuario']; ?> form-control" name="<?php echo 'tipo'.$registros['idusuario']; ?>" id="" readonly>
                                    <option value="<?php echo $registros['tipo']; ?>">Administrador</option>
                                  </select>
                                </td>
                                <td>
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idusuario']; ?> form-control" name="<?php echo 'user'.$registros['idusuario']; ?>" value="<?php echo $registros['user']; ?>" readonly>
                                </td>
                                <td class="center">
                                  <input type="text" class="<?php echo 'frm-usuario'.$registros['idusuario']; ?> form-control" name="<?php echo 'password'.$registros['idusuario']; ?>" value="<?php echo $registros['password']; ?>" readonly>
                                </td>
                                <td id="<?php echo 'td-editar'.$registros['idusuario']; ?>">
                                  <!--<button type="submit" class="" name="editar_usuario" value="<?php echo $registros['idusuario']; ?>" onclick="editar('<?php echo $registros['idusuario']; ?>')">Editar</button>-->
                                  <a id="btn-editar" class="" href="#" onclick="editar('<?php echo $registros['idusuario']; ?>')">Editar</a>
                                </td>
                                <td id="<?php echo 'td-eliminar'.$registros['idusuario']; ?>">
                                  <button class="btn btn-danger btn-xs" type="submit" class="" name="eliminar_usuario" value="<?php echo $registros['idusuario'] ?>" onclick="return confirm('¿Desea eliminar el usuario?');">Eliminar</button>
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

                cell1.innerHTML = '<input type="text" class="form-control" name="nombre1" id="" placeholder="">';
                cell2.innerHTML = '<select class="form-control" name="tipo1"><option value="administrador">Administrador</option></select>';
                cell3.innerHTML = '<input type="text" class="form-control" name="user1" id="" placeholder="">';
                cell4.innerHTML = '<input type="text" class="form-control" name="password1" id="" placeholder="">';
                cell5.innerHTML = '<button class="btn btn-success btn-xs" type="submit" id="btn-editar" name="guardar_usuario" class="" value="1">Guardar</button>';
                //cell5.innerHTML = '<button type="submit" class="" value="1" >Guardar</button><a id="btn-editar" class="" href="#" onclick="editar()">Guardar</a>';
                cell6.innerHTML = '<a id="btn-eliminar" class="delete" href="#" onclick="quitar_registro()">Cancelar</a>';
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
