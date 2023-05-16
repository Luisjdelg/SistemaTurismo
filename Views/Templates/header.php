<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Panel Administrativo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="<?php echo base_url; ?>Assets/css/main.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="<?php echo base_url; ?>Configuracion/admin">Sistema de Gestión de Calidad</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">

            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="<?php echo base_url; ?>Usuarios/salir"><i class="fa fa-sign-out fa-lg"></i> Salir</a>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo base_url; ?>Assets/img/logo.png" alt="User Image" width="50">
            <div>
                <p class="app-sidebar__user-name"><?php echo $_SESSION['nombre'] ?></p>
                <p class="btn-userlogin"><i class="fa fa-user fa-lg"></i> <?php echo $_SESSION['rol']; ?></p>

            </div>
        </div>
        <ul class="app-menu">
            <?php if ($_SESSION['rol'] == 'Representante') { ?>
                <li><a class="app-menu__item" href="<?php echo base_url; ?>Configuracion/admin"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Inicio</span></a></li>

                <li><a class="app-menu__item" href="<?php echo base_url; ?>Simulador"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Simulador</span></a></li>
                <?php } else {
                if ($_SESSION['rol'] == 'Evaluador') { ?>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Configuracion/admin"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Inicio</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Representante"><i class="app-menu__icon fa fa-address-card"></i><span class="app-menu__label">Representantes</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Establecimiento"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">Establecimientos</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Evaluacion"><i class="app-menu__icon fa fa-list-ol"></i><span class="app-menu__label">Evaluaciones</span></a></li>
                <?php } else { ?>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Configuracion/admin"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Inicio</span></a></li>
                    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-wrench"></i><span class="app-menu__label">Administración</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a class="treeview-item" href="<?php echo base_url; ?>Usuarios"><i class="icon fa fa-user-o"></i> Usuarios</a></li>
                            <li><a class="treeview-item" href="<?php echo base_url; ?>Configuracion"><i class="icon fa fa-cogs"></i> Configuración</a></li>
                        </ul>
                    </li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Representante"><i class="app-menu__icon fa fa-address-card"></i><span class="app-menu__label">Representantes</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Establecimiento"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">Establecimientos</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Categoria"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Categorías</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Criterio"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Criterios de Evaluación</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Proceso"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Procesos</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Gestion"><i class="app-menu__icon fa fa-file-text-o"></i><span class="app-menu__label">Gestiones</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Formulario"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label">Formularios</span></a></li>
                    <li><a class="app-menu__item" href="<?php echo base_url; ?>Reporte"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Reportes</span></a></li>
            <?php }
            } ?>

        </ul>
    </aside>
    <main class="app-content">