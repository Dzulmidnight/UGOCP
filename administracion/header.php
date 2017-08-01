<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <i class="fa fa-bars"></i>
    </div>
    <!--logo start-->
    <a href="index.php" class="logo"><span>UGOCP</span></a>
    <!--logo end-->

    <div class="top-nav ">
        <ul class="nav pull-right top-menu">
            
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="img/avatar1_small.jpg">
                    <span class="username"><?php echo $_SESSION['administrador']['nombre']; ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Configuración</a></li>
                    <li><a href="#"><i class="fa fa-bell-o"></i> Notificaciones</a></li>
                    <li><a href="login.php"><i class="fa fa-key"></i> Cerrar Sesión</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
            <li class="sb-toggle-right">
                <i class="fa  fa-align-right"></i>
            </li>
        </ul>
    </div>
</header>