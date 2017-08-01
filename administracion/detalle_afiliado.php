<?php
    require('../conexion/conexion.php');
    require('../conexion/sesion.php');
    require_once('../funciones/funciones.php');
    require_once('mpdf/mpdf.php');

    date_default_timezone_set('America/Mexico_City');

    $fecha_actual = time();

    if(isset($_SESSION['administrador'])){
        if($_SESSION['administrador']['tipo'] != 'administrador'){
            header('Location: conexion/salir.php');
        }
    }

    if(isset($_POST['eliminar_documento']) && !empty($_POST['eliminar_documento'])){
      $iddocumentacion = $_POST['eliminar_documento'];
      $query = "DELETE FROM documentacion WHERE iddocumentacion = $iddocumentacion";
      $eliminar = $mysqli->query($query);

      //echo '<script>alert("documento eliminado")</script>';

    }

    $folio = $_GET['folio'];
    $query = "SELECT nombre, ap_paterno, ap_materno FROM datos_generales WHERE folio = $folio";
    $ejecutar = $mysqli->query($query);
    $datos = $ejecutar->fetch_assoc();
    $nombre = $datos['nombre'].' '.$datos['ap_paterno'].' '.$datos['ap_materno'];
    $formato_folio = str_pad($folio, 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Detalle Afiliado</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/fuelux/css/tree-style.css" />
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

      <!--sidebar start-->
      <?php include('aside.php'); ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Documentación Afiliado: <span style="color:red"><?php echo $formato_folio.' ('.$nombre.')'; ?></span>
                      <span class="pull-right">
                        <a href="index.php" class="btn btn-warning btn-xs" href=""><i class="fa fa-reply" aria-hidden="true"></i></i> Regresar</a>
                      </span>
                  </header>

              </section>
              <div class="row">

                  <div class="col-md-8">
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                              <!--<h1>New Dashboard BS3 </h1>-->
                              <div class="col-md-12">
                                <?php
                                /**
                                 * Esta función devuelve el número de páginas de un archivo pdf
                                 * Tiene que recibir la ubicación y nombre del archivo
                                 */
                                function numeroPaginasPdf($archivoPDF)
                                {
                                  $stream = fopen($archivoPDF, "r");
                                  $content = fread ($stream, filesize($archivoPDF));
                                 
                                  if(!$stream || !$content)
                                    return 0;
                                 
                                  $count = 0;
                                 
                                  $regex  = "/\/Count\s+(\d+)/";
                                  $regex2 = "/\/Page\W*(\d+)/";
                                  $regex3 = "/\/N\s+(\d+)/";
                                 
                                  if(preg_match_all($regex, $content, $matches))
                                    $count = max($matches);
                                 
                                  return $count[0];
                                }
                                 
                                //echo numeroPaginasPdf("img/fotos_afiliados/maskapital.pdf");
                                //echo "<br>".numeroPaginasPdf("img/fotos_afiliados/formato_afiliado2.pdf");
                                ?>

                                <h4>Cargar Documentación</h4>
                                <!--<form action="" method="POST">
                                  <h4>Cargar Documentación</h4>
                                    <div class="form-group">
                                      <label for="exampleInputFile">Elegir archivos</label>
                                      <input type="file" id="exampleInputFile">
                                    </div>
                                </form>-->

                                <form id="form_prueba" action="#">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label for="archivo">Archivo</label>
                                      <input type="file" class="form-control" id="archivo" name="archivo">
                                      <input type="hidden" name="folio" value="<?php echo $_GET['folio']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="nombre_documento">Nombre del Documento</label>
                                        <input type="text" class="form-control" id="nombre_documento" name="nombre_documento" placeholder="Nombre Documento">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="progress progress-striped active">
                                    <div class="progress-bar" style="width:0%"></div>
                                  </div>
                                  <button class="btn btn-sm btn-info upload" type="submit" onclick="return validar()">Cargar</button>
                                  <button type="button" class="btn btn-sm btn-danger cancel">Cancelar</button>


                                </form>

                                <!--<form action="#">
                                  <input type="file" name="image" >
                                  <button class="btn btn-sm btn-info upload" type="submit">Cargar</button>
                                  <button type="button" class="btn btn-sm btn-danger cancel">Cancelar</button>

                                  <div class="progress progress-striped active">
                                    <div class="progress-bar" style="width:0%"></div>
                                  </div>
                                </form>

                                <form action="#">
                                  <input type="file" name="image" >
                                  <button class="btn btn-sm btn-info upload" type="submit">Cargar</button>
                                  <button type="button" class="btn btn-sm btn-danger cancel">Cancelar</button>

                                  <div class="progress progress-striped active">
                                    <div class="progress-bar" style="width:0%"></div>
                                  </div>
                                </form>-->
                                <!--<button class="btn btn-sm btn-primary upload-all">Cargar Todo</button>
                                <button class="btn btn-sm btn-danger cancel-all">Cancelar</button>-->
                              
                              </div>
                          </div>

                      </section>

                  </div>
                  <div class="col-md-4">

                      <section id="mostrar_documentacion" class="panel">
                          <header class="panel-heading">
                              Listado Documentos
                          </header>
                          <!-- INICIA PANEL-BODY -->
                          <div id="prueba_id" class="panel-body">
                            <?php 
                            $folio = $_GET['folio'];
                            $query = "SELECT * FROM documentacion WHERE folio = $folio";
                            $consultar = $mysqli->query($query);
                            $num_documentos = $consultar->num_rows;
                             ?>
                            <div id="lista_documentos">
                              <?php 
                              if($num_documentos == 0){
                                echo '<p style="padding:.5em;background:#3498db;color:white">No se encontraron documentos</p>';
                              }else{
                              ?>
                              <table class="table table-bordered table-condensed" style="font-size:12px;">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  while($documentos = $consultar->fetch_assoc()){
                                    echo '<tr>';
                                      echo '<td><a href="'.$documentos['url'].'" target="_new"><span class="glyphicon glyphicon-download"></span> '.$documentos['nombre'].'</a></td>';
                                      echo '<td>'.pathinfo($documentos['url'], PATHINFO_EXTENSION).'</td>';
                                  ?>
                                    <form action="" method="POST">
                                      <td>
                                        <!--<button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>-->
                                        <button type="submit" name="eliminar_documento" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Eliminar archivo" value="<?php echo $documentos['iddocumentacion']; ?>" onclick="return confirm('¿Desea eliminar el archivo?');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                        <!--<button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar documento" name="eliminar_documento" value="<?php echo $documentos['iddocumentacion']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>-->
                                      </td>
                                    </form>
                                  <?php
                                    echo '</tr>';
                                  }
                                  ?>
                                </tbody>
                              </table>
                              <?php
                              }
                              ?>
                            </div>
                            
                            <!--<div id="FlatTree4" class="tree tree-solid-line">
                                <div class = "tree-folder" style="display:none;">
                                    <div class="tree-folder-header">
                                        <i class="fa fa-folder"></i>
                                        <div class="tree-folder-name"></div>
                                    </div>
                                    <div class="tree-folder-content"></div>
                                    <div class="tree-loader" style="display:none"></div>
                                </div>
                                <div class="tree-item" style="display:none;">
                                    <i class="tree-dot"></i>
                                    <div class="tree-item-name"></div>
                                </div>
                            </div>-->
                            
                          </div>
                          <!-- TERMINA PANEL-BODY -->
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->


      <!--footer start-->
      <?php include('footer.php'); ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/slidebars.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>
    <script src="assets/fuelux/js/tree.min.js"></script>
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <script src="js/tree.js"></script>

  <script>
      jQuery(document).ready(function() {
          TreeView.init();
      });

    function validar() {

        nombre_documento = document.getElementById("nombre_documento").value;
        if ( nombre_documento == null || nombre_documento.length == 0 || /^\s+$/.test(nombre_documento)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NOMBRE DEL DOCUMENTO');
            document.getElementById("nombre_documento").focus();
            return false;

        }
        archivo = document.getElementById("archivo").value;
        if ( archivo == null || archivo.length == 0 || /^\s+$/.test(archivo)) {
        // Si no se cumple la condicion...
            alert('DEBES SELECCIONAR UN ARCHIVO');
            document.getElementById("archivo").focus();
            return false;
        }
        return true;
    }

  </script>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $('.upload-all').click(function(){
      //submit all form
      $('#form').submit();
    });

    $('.cancel-all').click(function(){
      //submit all form
      $('form .cancel').click();
    });

    $(document).on('submit','#form_prueba',function(e){
      e.preventDefault();
      $form = $(this);
      uploadImage($form);

    });

    function uploadImage($form){
      $form.find('.progress-bar').removeClass('progress-bar-success')
                    .removeClass('progress-bar-danger');

      var formdata = new FormData($form[0]); //formelement
      var request = new XMLHttpRequest();

      //progress event...
      request.upload.addEventListener('progress',function(e){
        var percent = Math.round(e.loaded/e.total * 100);
        $form.find('.progress-bar').width(percent+'%').html(percent+'%');
      });    
       
      //progress completed load event
      request.addEventListener('load',function(e){
        $form.find('.progress-bar').addClass('progress-bar-success').html('Archivo cargado ....');   
        setTimeout(function(){
          $form.find('.progress-bar').width(0);
          document.getElementById("mostrar_documentacion").innerHTML = request.responseText;
          document.getElementById("form_prueba").reset();
        },1500);

      });

      request.open('post', 'server.php');
      request.send(formdata);




      $form.on('click','.cancel',function(){
        request.abort();

        $form.find('.progress-bar')
          .addClass('progress-bar-danger')
          .removeClass('progress-bar-success')
          .html('Archivo cancelado ...');

      });



    }

    //thanks for watching........
    //code on git........

    //subscribe, share, like, comment.............

  </script>

  </body>
</html>
