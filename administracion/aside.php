

      <!--header start-->
      <header class="header white-bg">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="fa fa-bars"></span>
              </button>

              <!--logo start-->
              <a href="index.php" class="logo"><span>UGOCP</span></a>
              <!--logo end-->
              <div class="horizontal-menu navbar-collapse collapse ">
                  <ul class="nav navbar-nav">
                    <li <?php if(isset($menu) && $menu == 'inicio'){echo 'class="active"';} ?>>
                        <!--<a <?php if(isset($menu) && $menu == 'inicio'){echo 'class="active"';} ?> href="index.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Principal</span>
                        </a>-->
                        <a  href="index.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Principal</span>
                        </a>
                    </li>
                    <li <?php if(isset($menu) && $menu == 'usuarios'){echo 'class="active"';} ?>>
                        <!--<a <?php if(isset($menu) && $menu == 'inicio'){echo 'class="active"';} ?> href="index.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Principal</span>
                        </a>-->
                        <a  href="usuarios.php">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>


                    <!--<li class="sub-menu">
                        <a <?php if(isset($seccion) && $seccion == 'afiliacion'){echo 'class="active"'; } ?> href="javascript:;" >
                            <i class="fa fa-book"></i>
                            <span>Afiliación</span>
                        </a>
                        <ul class="sub">
                            <li <?php if(isset($menu) && $menu == 'formato_afiliacion'){echo 'class="active"'; } ?>><a  href="formato_afiliacion.php">Formato de Afiliación</a></li>
                        </ul>
                    </li>-->
                    <!--<li class="sub-menu">
                        <a <?php if(isset($seccion) && $seccion == 'formularios'){echo 'class="active"'; } ?> href="javascript:;" >
                            <i class="fa fa-files-o"></i>
                            <span>Formularios</span>
                        </a>
                        <ul class="sub">
                            <li <?php if(isset($menu) && $menu == 'denuncias'){echo 'class="active"'; } ?>><a  href="denuncias.php">Denuncias</a></li>
                            <li <?php if(isset($menu) && $menu == 'solicitudes'){echo 'class="active"'; } ?>><a  href="solicitudes.php">Solicitudes</a></li>
                            <li <?php if(isset($menu) && $menu == 'atencion'){echo 'class="active"'; } ?>><a  href="frm_atencion.php">Atención a Clientes</a></li>
                        </ul>
                    </li>-->

                      <!--<li><a href="index.html">Dashboard</a></li>
                      <li class="active"><a href="#">Components</a></li>
                      <li class="dropdown">
                          <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">UI Element <b class=" fa fa-angle-down"></b></a>
                          <ul class="dropdown-menu">
                              <li><a href="general.html">General</a></li>
                              <li><a href="buttons.html">Buttons</a></li>
                              <li><a href="widget.html">Widget</a></li>
                              <li><a href="slider.html">Slider</a></li>
                              <li><a href="nestable.html">Nestable</a></li>
                              <li><a href="font_awesome.html">Font Awesome</a></li>
                          </ul>
                      </li>
                      <li><a href="basic_table.html">Tables</a></li>
                      <li class="dropdown">
                          <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">Extra <b class=" fa fa-angle-down"></b></a>
                          <ul class="dropdown-menu">
                              <li><a href="blank.html">Blank Page</a></li>
                              <li><a href="boxed_page.html">Boxed Page</a></li>
                              <li><a href="profile.html">Profile</a></li>
                              <li><a href="invoice.html">Invoice</a></li>
                              <li><a href="search_result.html">Search Result</a></li>
                              <li><a href="404.html">404 Error Page</a></li>
                              <li><a href="500.html">500 Error Page</a></li>
                          </ul>
                      </li>-->
                  </ul>

              </div>
                <div class="top-nav ">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <!--<li>
                            <input type="text" class="form-control search" placeholder="Search">
                        </li>-->
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="img/avatar1_small.jpg">
                                <span class="username"><?php echo $_SESSION['administrador']['nombre']; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <!--<li><a href="#"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i> Configuración</a></li>
                                <li><a href="#"><i class="fa fa-bell-o"></i> Notificaciones</a></li>-->
                                <li><a href="../conexion/salir.php"><i class="fa fa-key"></i> Cerrar Sesión</a></li>
                            </ul>
                        </li>
                        <li class="sb-toggle-right">
                            <i class="fa  fa-align-right"></i>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!--search & user info end-->
                </div>
          </div>

      </header>