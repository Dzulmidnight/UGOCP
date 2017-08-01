<?php
    require('../conexion/conexion.php');
    require('../conexion/sesion.php');


    $folio = $_POST['folio'];
    $ruta_img = 'img/documentacion_afiliados/';
    $nombre = $_POST['nombre_documento'];


    $_FILES["archivo"]["name"];
    move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta_img.$_FILES["archivo"]["name"]);
    $documento = $ruta_img.basename($_FILES["archivo"]["name"]);


	//$tmp_file = $_FILES['archivo']['tmp_name'];
	//$filename = $_FILES['archivo']['name'];

	//move_uploaded_file($tmp_file, 'uploadfolder/'. $filename);

	$query = "INSERT INTO documentacion (folio, nombre, tipo, url) VALUES ($folio, '$nombre', 'este es el tipo', '$documento')";
	$ejecutar = $mysqli->query($query);

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


                          <header class="panel-heading">
                              Listado Documentos
                          </header>
                          <!-- INICIA PANEL-BODY -->
                          <div id="prueba_id" class="panel-body">
                            <?php 
                            $query = "SELECT * FROM documentacion WHERE folio = $folio";
                            $consultar = $mysqli->query($query);
                            $num_documentos = $consultar->num_rows;
                             ?>
                            <div id="lista_documentos">
                              <?php 
                              if($num_documentos == 0){
                                echo '<p style="background:red;color:white">No se encontraron documentos</p>';
                              }else{
                              ?>
                              <table class="table table-bordered table-condensed" style="font-size:12px;">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Páginas</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  while($documentos = $consultar->fetch_assoc()){
                                    echo '<tr>';
                                      echo '<td><a href="'.$documentos['url'].'" target="_new"><span class="glyphicon glyphicon-download"></span> '.$documentos['nombre'].'</a></td>';
                                      echo '<td>'.pathinfo($documentos['url'], PATHINFO_EXTENSION).'</td>';
                                      echo '<td>'.numeroPaginasPdf($documentos['url']).'</td>';
                                    echo '</tr>';
                                  }
                                  ?>
                                </tbody>
                              </table>
                              <?php
                              }
                              ?>
                            </div>

                            
                          </div>
                          <!-- TERMINA PANEL-BODY -->