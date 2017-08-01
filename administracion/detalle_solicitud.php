<?php 
  require('../conexion/conexion.php');
  require('../conexion/sesion.php');

  if(isset($_POST['guardar_sucursal']) && $_POST['guardar_sucursal'] == 1){
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $referencia = $_POST['referencia'];
    $cp = $_POST['cp'];
    $colonia = $_POST['colonia'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $x = $_POST['x'];
    $y = $_POST['y'];
    $img = '';

    $rutaImg = "../img/sucursales/img_sucursal/";

    if(!empty($_FILES['img_sucursal']['name'])){
        $_FILES["img_sucursal"]["name"];
          move_uploaded_file($_FILES["img_sucursal"]["tmp_name"], $rutaImg.$_FILES["img_sucursal"]["name"]);
          $img_sucursal = basename($_FILES["img_sucursal"]["name"]);
    }else{
      $img_sucursal = NULL;
    }

    $sql = "INSERT INTO sucursales (NombreSucursal, Estado, Municipio, Calle, Numero, Referencia, CP, Colonia, Telefono, Email, X, Y, UrlFoto) VALUES ('$nombre', '$estado', '$municipio', '$calle', '$numero', '$referencia', '$cp', '$colonia', '$telefono', '$email', '$x', '$y', '$img_sucursal')";
    $mysqli->query($sql);

  }

  if(isset($_POST['actualizar_sucursal']) && $_POST['actualizar_sucursal'] == 1){
    $idsucursal = $_POST['idsucursal'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $referencia = $_POST['referencia'];
    $cp = $_POST['cp'];
    $colonia = $_POST['colonia'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $x = $_POST['x'];
    $y = $_POST['y'];
    $img = '';

    $rutaImg = "../img/sucursales/img_sucursal/";
    $imagen = "../img/sucursales/img_sucursal/".$_POST['img_actual'];
    if(!empty($_FILES['img_sucursal']['name'])){
        if(file_exists($imagen)){
          unlink($imagen);
        }
        $_FILES["img_sucursal"]["name"];
          move_uploaded_file($_FILES["img_sucursal"]["tmp_name"], $rutaImg.$_FILES["img_sucursal"]["name"]);
          $img_sucursal = basename($_FILES["img_sucursal"]["name"]);
    }else{
      $img_sucursal = $_POST['img_actual'];
    }

    $sql = "UPDATE sucursales SET NombreSucursal = '$nombre', Estado = '$estado', Municipio = '$municipio', Calle = '$calle', Numero = '$numero', Referencia = '$referencia', CP = '$cp', Colonia = '$colonia', Telefono = '$telefono', Email = '$email', X = '$x', Y = '$y', UrlFoto = '$img_sucursal' WHERE idSucursales = '$idsucursal'";

    $mysqli->query($sql);
  }

  if(isset($_POST['eliminar_denuncia'])){
    $idfrm_denuncia = $_POST['eliminar_denuncia'];
    $sql = "DELETE FROM frm_denuncia WHERE idfrm_denuncia = '$idfrm_denuncia'";
    $mysqli->query($sql);
    echo "<script>alert('Se ha eliminado la denuncia');</script>";
  }

  $idSolicitudTrabajo = $_GET['solicitud'];

  //$query_solicitud = "SELECT SolicitudTrabajo.*, Solicitante.* FROM SolicitudTrabajo INNER JOIN Solicitante ON SolicitudTrabajo.idSolicitante = Solicitante.idSolicitante WHERE SolicitudTrabajo.idSolicitudTrabajo = '$idSolicitudTrabajo'";

  $query_solicitud = "SELECT SolicitudTrabajo.*, Solicitante.*, DomSolicitante.*, EdoSalud.Estado AS 'Estado_salud', EdoSalud.Padece, EdoSalud.Enfermedad, EdoSalud.Meta, Documentacion.*, Madre.Nombre AS 'Nombre_madre', Madre.Vive AS 'Vive_madre', Madre.Domicilio AS 'Domicilio_madre', Madre.Ocupacion AS 'Ocupacion_madre', PadreSol.Nombre AS 'Nombre_padre', PadreSol.Vive AS 'Vive_padre', PadreSol.Domicilio AS 'Domicilio_padre', PadreSol.Ocupacion AS 'Ocupacion_padre', Esposa.Nombre AS 'Nombre_esp', Esposa.Vive AS 'Vive_esp', Esposa.Domicilio AS 'Domicilio_esp', Esposa.Ocupacion AS 'Ocupacion_esp', Escolaridad.*, Conocimientos.*, DatosEconomicos.*, DatosGenerales.* FROM SolicitudTrabajo INNER JOIN Solicitante ON SolicitudTrabajo.idSolicitante = Solicitante.idSolicitante LEFT JOIN DomSolicitante ON SolicitudTrabajo.idSolicitante = DomSolicitante.idSolicitante LEFT JOIN EdoSalud ON SolicitudTrabajo.idSolicitante = EdoSalud.idSolicitante LEFT JOIN Documentacion ON SolicitudTrabajo.idSolicitante = Documentacion.idSolicitante LEFT JOIN Escolaridad ON SolicitudTrabajo.idSolicitante = Escolaridad.idSolicitante LEFT JOIN Conocimientos ON SolicitudTrabajo.idSolicitante = Conocimientos.idSolicitante LEFT JOIN Madre ON SolicitudTrabajo.idSolicitante = Madre.idSolicitante LEFT JOIN PadreSol ON SolicitudTrabajo.idSolicitante = PadreSol.idSolicitante LEFT JOIN Esposa ON SolicitudTrabajo.idSolicitante = Esposa.idSolicitante LEFT JOIN DatosEconomicos ON SolicitudTrabajo.idSolicitante = DatosEconomicos.idSolicitante LEFT JOIN DatosGenerales ON SolicitudTrabajo.idSolicitante = DatosGenerales.idSolicitante WHERE SolicitudTrabajo.idSolicitudTrabajo = '$idSolicitudTrabajo'";
  $consultar = $mysqli->query($query_solicitud);

  $detalle_solicitud = $consultar->fetch_assoc();
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

    <title>Detalle Solicitud</title>

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

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Detalle de la Solicitud
                      <span class="pull-right">
                        <a href="solicitudes.php" class="btn btn-warning btn-xs"><i class="fa fa-reply"></i> Regresar </a>
                      </span>
                  </header>

              </section>
              <div class="row">
                  <div class="col-md-12">
                      <section class="panel">
                          <!--<div class="bio-graph-heading project-heading">
                              <strong> [ New Dashboard BS3 ] </strong>
                          </div>-->
                          <div class="panel-body bio-graph-info">
                              <!--<h1>New Dashboard BS3 </h1>-->
                              <div class="row p-details">
                                  <div class="bio-row">
                                      <p><span class="bold">Enviada por </span>: <?php echo utf8_decode($detalle_solicitud['Nombre']).' '.utf8_decode($detalle_solicitud['ApPaterno']).' '.utf8_decode($detalle_solicitud['ApMaterno']); ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Creada </span>: <span class="label label-primary"><?php echo date('d/m/Y', $detalle_solicitud['fecha_solicitud']); ?></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Vacante </span>: <span class="label label-primary"><?php echo utf8_decode($detalle_solicitud['Puesto']); ?></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Email</span>: <?php echo utf8_decode($detalle_solicitud['Correo']); ?></p>
                                  </div>
                                  <!--<div class="bio-row">
                                      <p><span class="bold">Client </span>: <a href="#">Themeforest</a></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Version </span>: v.2.3</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span class="bold">Participants </span>:
                                      <span class="p-team">
                                          <a href="#"><img alt="image" class="" src="img/chat-avatar.jpg"></a>
                                          <a href="#"><img alt="image" class="" src="img/chat-avatar2.jpg"></a>
                                          <a href="#"><img alt="image" class="" src="img/pro-ac-1.png"></a>
                                      </span>
                                      </p>
                                  </div>

                                  <div class="col-lg-12">
                                      <dl class="dl-horizontal mtop20 p-progress">
                                          <dt>Project Completed:</dt>
                                          <dd>
                                              <div class="progress progress-striped active ">
                                                  <div style="width: 80%;" class="progress-bar progress-bar-success"></div>
                                              </div>
                                              <small>Project completed in <strong>80%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                          </dd>
                                      </dl>
                                  </div>-->
                              </div>

                          </div>

                      </section>

                      <section class="panel">
                        <header class="panel-heading">
                          Información Solicitud
                        </header>
                        <div class="panel-body">
                            <table class="table table-hover p-table">
                              <thead>
                                <tr>
                                  <th class="info text-center" colspan="4">DATOS PERSONALES</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <p>Apellido Paterno</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['ApPaterno']); ?></p>
                                  </td>
                                  <td>
                                    <p>Apellido Materno</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['ApMaterno']); ?></p>
                                    
                                    
                                  </td>
                                  <td>
                                    <p>Nombre(s)</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Nombre']); ?></p>
                                    
                                    
                                  </td>
                                  <td>
                                    <p>Edad</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Edad']); ?></p>
                                    
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>Domicilio (Tipo Vialidad y Nombre)</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Calle']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>No. Ext</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['NumExt']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>No. Int.</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['NumInt']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>Colonia</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Colonia']); ?></p>
                                    
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="2">
                                    <p>Delegación o Municipio</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Municipio']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>Estado</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Estado']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>Código Postal</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['CP']); ?></p>
                                    
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>Teléfono Casa</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['TelCasa']); ?></p>
                                  </td>
                                  <td>
                                    <p>Teléfono Celuar</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['TelCelular']); ?></p>
                                    
                                  </td>
                                  <td colspan="2">
                                    <p>Correo Electronico</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Correo']); ?></p>
                                    
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>TIEMPO DE RESIDIR EN DOMICILIO ACTUAL</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['TiempoRes']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>VIVE CON</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['ViveCon']); ?></p>
                                    
                                  </td>
                                  <td colspan="2">
                                    <p>ESPECIFICA</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['EspViveCon']); ?></p>
                                    
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>PERSONAS QUE DEPENDEN DE USTED</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['Dependientes']); ?></p>
                                    
                                  </td>
                                  <td>
                                    <p>ESTADO CIVIL:</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['EdoCivil']); ?></p>
                                    
                                  </td>
                                  <td colspan="2">
                                    <p>ESPECIFICA</p>
                                    <p class="bold"><?php echo utf8_decode($detalle_solicitud['EspEdoCivil']); ?></p>
                                    
                                  </td>
                                </tr>
                              </tbody>
                          </table>
                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="5">DOCUMENTACIÓN</th>
                              </tr>
                              <tr>
                                <td>
                                  <p>CURP</p>
                                </td>
                                <td>
                                  <p>RFC</p>
                                </td>
                                <td>
                                  <p>NÚMERO DE SEGURO SOCIAL</p>
                                </td>
                                <td>
                                  <p>LICENCIA DE CONDUCIR</p>
                                </td>
                                <td>
                                  <p>CLASE Y Nº. LICENCIA</p>
                                </td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Curp']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Rfc']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Imms']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Licencia']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['NumLicencia']); ?></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="4">ESTADO DE SALUD Y HÁBITOS PERSONALES</th>
                              </tr>
                              <tr>
                                <td>
                                  <p>SU ESTADO DE SALUD:</p> 
                                </td>
                                <td>
                                  <p>¿PADECE ALGUNA ENFERMEDAD?</p> 
                                </td>
                                <td>
                                  <p>ESPECIFIQUE ENFERMEDAD</p> 
                                </td>
                                <td>
                                  <p>¿CUAL ES SU META EN LA VIDA?</p> 
                                </td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Estado_salud']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Padece']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Enfermedad']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Meta']); ?></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="4">DATOS FAMILIARES</th>
                              </tr>
                              <tr>
                                <th>NOMBRE</th>
                                <th>VIVE/FINADO</th>
                                <th>DOMICILIO</th>
                                <th>OCUPACIÓN</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p>PADRE</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Nombre_padre']); ?></p>
                                  
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Vive_padre']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Domicilio_padre']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Ocupacion_padre']); ?></p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>MADRE</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Nombre_madre']); ?></p>
                                  
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Vive_madre']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Domicilio_madre']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Ocupacion_madre']); ?></p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>ESPOSA(O)</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Nombre_esp']); ?></p>
                                  
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Vive_esp']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Domicilio_esp']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Ocupacion_esp']); ?></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="5">ESCOLARIDAD (Solamente último nivel académico)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p>NOMBRE DE LA ESCUELA</p>
                                </td>
                                <td colspan="2">
                                  <p>DIRECCIÓN</p>
                                </td>
                                <td>
                                  <p>FECHAS</p>
                                </td>
                                <td>
                                  <p>DOCUMENTO RECIBIDO</p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Escuela']); ?></p>
                                </td>
                                <td colspan="2">
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Direccion']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['FechaI'].' A '.$detalle_solicitud['FechaF']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Documento']); ?></p>
                                </td>
                              </tr>

                              <tr>
                                <td class="warning" colspan="5">EN CASO DE ESTUDIO PROFESIONALES</td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <p>NOMBRE DE LA CARRERA</p>
                                </td>
                                <td colspan="2">
                                  <p>NIVEL ALCANZADO (SOLO PARA ESTUDIOS PROFESIONALES)</p>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Carrera']); ?></p>
                                </td>
                                <td colspan="2">
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Nivel']); ?></p>
                                </td>
                              </tr>
                              <tr>
                                <td class="warning" colspan="5">EN CASO DE ESTAR ESTUDIANDO ACTUALMENTE</td>
                              </tr>
                              <tr>
                                <td>
                                  <p>NOMBRE DE LA ESCUELA</p>
                                </td>
                                <td>
                                  <p>CURSO O CARRERA</p>
                                </td>
                                <td>
                                  <p>DIAS EN LOS QUE ASISTE</p>
                                </td>
                                <td>
                                  <p>HORARIO</p>
                                </td>
                                <td>
                                  <p>NIVEL/GRADO ACTUAL</p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['EscuelaAct']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Curso']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Dias']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Horario']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['NivelAct']); ?></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="4">CONOCIMIENTOS GENERALES</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p>FUNCIONES DE OFICINA QUE DOMINA</p>
                                </td>
                                <td>
                                  <p>PROGRAMAS DE CÓMPUTO (SOFTWARE) QUE DOMINA</p>
                                </td>
                              </tr>
                              <tr>
                                <p class="bold"><?php echo utf8_decode($detalle_solicitud['Funciones']); ?></p>
                              </tr>
                              <tr>
                                <p class="bold"><?php echo utf8_decode($detalle_solicitud['Software']); ?></p>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="12">EMPLEO ACTUA Y ANTERIORES</th>
                              </tr>
                              <tr>
                                <th>COMPAÑIA</th>
                                <th>DIRECCIÓN</th>
                                <th>TELÉFONO</th>
                                <th>PUESTO DESEMPEÑADO</th>
                                <th>INICIO</th>
                                <th>TÉRMINO</th>
                                <th>MOTIVO</th>
                                <th>SALARIO</th>
                                <th>JEFE</th>
                                <th>PUESTO DE SU JEFE</th>
                                <th colspan="2">¿SOLICITAR INFORMACIÓN?</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $query_empleo = "SELECT * FROM Empleos WHERE idSolicitante = '$detalle_solicitud[idSolicitante]'";
                              $consultar = $mysqli->query($query_empleo);
                              while($empleos = $consultar->fetch_assoc()){
                              ?>
                                <tr>
                                  <td><?php echo utf8_decode($empleos['Compania']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Direccion']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Telefono']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Puesto']); ?></td>
                                  <td><?php echo utf8_decode($empleos['FechaInicio']); ?></td>
                                  <td><?php echo utf8_decode($empleos['FechaTermino']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Motivo']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Salario']); ?></td>
                                  <td><?php echo utf8_decode($empleos['NombreJefe']); ?></td>
                                  <td><?php echo utf8_decode($empleos['PuestoJefe']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Informacion']); ?></td>
                                  <td><?php echo utf8_decode($empleos['Porque']); ?></td>
                                </tr>
                              <?php
                              }
                               ?>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="5">REFERENCIAS FAMILIARES O PERSONALES (Que no vivan en el mismo domicilio)</th>
                              </tr>
                              <tr>
                                <th>NOMBRE</th>
                                <th>DOMICILIO</th>
                                <th>TELÉFONO</th>
                                <th>OCUPACIÓN</th>
                                <th>TIEMPO DE CONOCERLO</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                              $query_referencias = "SELECT * FROM RefFamiliar WHERE idSolicitante = '$detalle_solicitud[idSolicitante]'";
                              $consultar = $mysqli->query($query_referencias);
                              while($referencias = $consultar->fetch_assoc()){
                              ?>
                                <tr>
                                  <td><?php echo utf8_decode($referencias['Nombre']); ?></td>
                                  <td><?php echo utf8_decode($referencias['Domicilio']); ?></td>
                                  <td><?php echo utf8_decode($referencias['Telefono']); ?></td>
                                  <td><?php echo utf8_decode($referencias['Ocupacion']); ?></td>
                                  <td><?php echo utf8_decode($referencias['Tiempo']); ?></td>
                                </tr>
                              <?php
                              }
                             ?>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="4">DATOS GENERALES</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p>¿COMO SUPO DE ESTE EMPLEO?</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['ComoSupo']); ?></p>
                                  
                                </td>
                                <td>
                                  <p>¿TIENE PARIENTES EN ESTA EMPRESA?</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Pariente']); ?></p>
                                  
                                </td>
                                <td>
                                  <p>¿QUIEN ES SU PARIENTE?</p>
                                  <p class="bold"><?php echo 'FALTA RESPUESTA'; ?></p>
                                  
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>¿PUEDE VIAJAR?</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Viajar']); ?></p>
                                  
                                </td>
                                <td>
                                  <p>EXPLIQUE</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['ExpViajar']); ?></p>
                                  
                                </td>
                                <td>
                                  <p>¿ESTA DISPUESTO A CAMBIAR SU LUGAR DE RESIDENCIA?</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Residencia']); ?></p>
                                  
                                </td>
                                <td>
                                  <p>EXPLIQUE</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['ExpResidencia']); ?></p>
                                  
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>FECHA EN LA QUE PODRIA PRESENTARSE A TRABAJAR</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['FechaTrabajar']); ?></p>
                                  
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <table class="table table-hover p-table">
                            <thead>
                              <tr>
                                <th class="info text-center" colspan="4">DATOS ECONÓMICOS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <p>¿TIENE USTED OTROS INGRESOS?</p>
                                </td>
                                <td>
                                  <p>IMPORTE MENSUAL</p>
                                </td>
                                <td>
                                  <p>¿SU CÓNYUGE TRABAJA?</p>
                                </td>
                                <td>
                                  <p>PERCEPCIÓN MENSUAL</p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Ingresos']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Importe']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Conyuge']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['IngresoConyuge']); ?></p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>¿VIVE EN CASA PROPIA?</p>
                                </td>
                                <td>
                                  <p>VALOR APROXIMADO</p>
                                </td>
                                <td>
                                  <p>¿PAGA RENTA?</p>
                                </td>
                                <td>
                                  <p>RENTA MENSUAL</p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['CasaPropia']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['ValorCasa']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['PagaRenta']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['ValorRenta']); ?></p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>¿TIENE AUTOMOVIL PROPIO?</p>
                                </td>
                                <td>
                                  <p>MARCA, MODELO</p>
                                </td>
                                <td>
                                  <p>¿TIENE DEUDAS?</p>
                                </td>
                                <td>
                                  <p>IMPORTE DEL ADEUDO</p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['AutoMovil']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['MarcaAuto'].' '.$detalle_solicitud['ModeloAuto']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['Adeudo']); ?></p>
                                </td>
                                <td>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['ImporteAdeudo']); ?></p>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <p>¿CUANTO ABONA MENSUALMENTE?</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['AbonoAdeudo']); ?></p>
                                </td>
                                <td>
                                  <p>¿A CUANTO ASCIENDEN SUS GASTOS MENSUALES?</p>
                                  <p class="bold"><?php echo utf8_decode($detalle_solicitud['GastosMensuales']); ?></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>


                        </div>
                      </section>

                  </div>
                  <!--<div class="col-md-4">
                      <section class="panel">
                          <header class="panel-heading">
                              Projects Description
                          </header>

                          <div class="panel-body">
                              <a href="#"><img src="img/email-img/vector-lab.jpg" alt=""/></a>

                              <p>
                                  Sometimes the simplest things are the hardest to find. I imagined a line of my favorite pieces, the things i would live in every day, all year round. So I stopped looking and started designing. Sometimes the simplest things are the hardest to find. Sometimes the simplest things are the hardest to find. I imagined a line of my favorite pieces, the things i would live in every day, all year round. So I stopped looking and started designing. Sometimes the simplest things are the hardest to find.
                              </p>
                              <br/>
                              <h5 class="bold">Priority</h5>
                              <ul class="nav nav-pills nav-stacked labels-info ">
                                  <li><i class=" fa fa-circle text-danger"></i> High Priority</p></li>
                              </ul>

                              <br/>
                              <h5 class="bold">Project files</h5>
                              <ul class="list-unstyled p-files">
                                  <li><a href=""><i class="fa fa-file-text"></i> Project-document.docx</a></li>
                                  <li><a href=""><i class="fa fa-picture-o"></i> Logo-company.jpg</a></li>
                                  <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a></li>
                                  <li><a href=""><i class="fa fa-file"></i> Contract-10_12_2014.docx</a></li>
                              </ul>
                              <br/>

                              <h5 class="bold">Project Tags</h5>
                              <ul class="p-tag-list">
                                  <li><a href=""><i class="fa fa-tag"></i> Dlor</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Google</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Excellent</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Dlor</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Google</a></li>
                                  <li><a href=""><i class="fa fa-tag"></i> Excellent</a></li>
                              </ul>

                              <div class="text-center mtop20">
                                  <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                  <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                              </div>
                          </div>-->

                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--main content end-->
      <!-- Right Slidebar start -->
      <!-- Right Slidebar end -->
      <!--footer start-->
      <?php include('footer.php'); ?>
      <!--footer end-->
  </section>

    <!-- Modal Agregar Sucursal -->
    <div class="modal fade" id="modalSucursal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><b>Formulario Sucursal </b></h4>
                  </div>
                  <div class="modal-body">
                    <!-- page start-->
                    <div class="row">

                        <aside class="profile-info col-lg-12">
                            <section class="panel">
                                <div class="panel-body bio-graph-info">
                                  <table class="table table-bordered">
                                    <tr>
                                      <td>Nombre Sucursal</td>
                                      <td colspan="3">
                                        <input type="text" class="form-control" name="nombre" id="f-name" placeholder="Nombre de la Sucursal">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Estado</td>
                                      <td colspan="3">
                                        <?php 
                                        $query = "SELECT nombre FROM estados";
                                        $consultar = $mysqli->query($query);
                                        ?>
                                          <select class="form-control" name="estado" id="">
                                            <option value="">Selecciona un Estado</option>
                                            <?php 
                                            while($estados = $consultar->fetch_assoc()){
                                              echo "<option values='".$estados['nombre']."'>".$estados['nombre']."</option>";
                                            }
                                            ?>
                                          </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Municipio</td>
                                      <td colspan="3">
                                        <input type="text" class="form-control" name="municipio" id="" placeholder="Municipio">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Colonia</td>
                                      <td>
                                        <input type="text" class="form-control" name="colonia" placeholder="Colonia">
                                      </td>
                                      <td>C.P.</td>
                                      <td>
                                        <input type="text" class="form-control" name="cp" placeholder="C.P.">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Calle</td>
                                      <td>
                                        <input type="text" class="form-control" name="calle" id="" placeholder="Calle">
                                      </td>
                                      <td>Num. Ext.</td>
                                      <td>
                                        <input type="text" class="form-control" name="numero" id="" placeholder="Num. #">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Referencias</td>
                                      <td colspan="3">
                                        <textarea class="form-control" name="referencia" id="" rows="2" placeholder="Ej: Planta Interior, Local #"></textarea>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Teléfono</td>
                                      <td>
                                        <input type="text" class="form-control" name="telefono" id="" placeholder="Teléfono">
                                      </td>
                                      <td>Email</td>
                                      <td>
                                        <input type="text" class="form-control" name="email" id="" placeholder="Email">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="info text-center" colspan="4"><b>Coordenadas Aproximadas de la Sucursal</b></td>
                                    </tr>
                                    <tr>
                                      <td>Coordenada X</td>
                                      <td>
                                        <input type="text" class="form-control" name="x" id="" placeholder="Ej: 16.831622">
                                      </td>
                                      <td>Coordenada Y</td>
                                      <td>
                                        <input type="text" class="form-control" name="y" id="" placeholder="Ej: -96.782573">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Imagen Sucursal</td>
                                      <td colspan="3">
                                        <input type="file" class="form-control" name="img_sucursal" id="">
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                            </section>
                        </aside>
                    </div>
                    <!-- page end-->
                  </div>
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default" type="button">Cerrar</button>
                      <button class="btn btn-success" type="submit" name="guardar_sucursal" value="1"> Guardar Sucursal</button>
                  </div>              
              </form>
            </div>
        </div>
    </div>
    <!-- modal -->


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

    <!--right slidebar-->
    <script src="js/slidebars.min.js"></script>

    <!--dynamic table initialization -->
    <script src="js/dynamic_table_init.js"></script>


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>

  </body>
</html>
