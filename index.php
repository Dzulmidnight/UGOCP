<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/logo_ugocp_xs.png">

    <title>Inicio de Sesión - UGOCP</title>

    <!-- Bootstrap core CSS -->
    <link href="administracion/css/bootstrap.min.css" rel="stylesheet">
    <link href="administracion/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="administracion/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="administracion/css/style.css" rel="stylesheet">
    <link href="administracion/css/style-responsive.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
    <div class="container">
        <div class="text-center col-md-12" style="margin-top:2em;">
            <img class="" src="img/logo_ugocp.png" width="200px" alt="">  
        </div>
    </div>
              
  
    <div class="container">
      <form class="form-signin" id="form-login" action="" method="POST">

        <h2 class="form-signin-heading">INICIO DE SESIÓN</h2>
        <div class="login-wrap">
            <div class="error alert alert-danger alert-dismissible" style="display:none" role="alert">
                <strong>Datos incorrectos, inténtalo de nuevo por favor.
            </div>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required autofocus>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>

            <input class="btn btn-lg btn-login btn-block botonlg" type="submit" onclick="validar()" value="Ingresar">


        </div>

          <!-- Modal -->
          <!--<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>-->
          <!-- modal -->

      </form>

    </div>

<!-- -->
    <script>
        function validar(){
            usuario = document.getElementById("usuario").value;
            if ( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario)) {
            // Si no se cumple la condicion...
                alert('DEBES INGRESAR TU CORREO ELECTRÓNICO');
                document.getElementById("usuario").focus();
                return false;

            }
            password = document.getElementById("password").value;
            if ( password == null || password.length == 0 || /^\s+$/.test(password)) {
            // Si no se cumple la condicion...
                alert('DEBES DE INGRESAR TU CONTRASEÑA');
                document.getElementById("password").focus();
                return false;
            }
            return true;


        }
    </script>

    <script type="text/javascript" src="js/validacion.js"></script>
    <!-- --->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>
