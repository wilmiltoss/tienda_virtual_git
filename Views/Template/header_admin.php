<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <!-- descripcion preeliminar que muestra en el buscador-->
    <meta name="description" content="Tienda Virtual Wilson Miltos"> 
    <!-- meta para arreglar cliente response-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Wilson SMS">
     <!-- color para los dispisitivos moviles-->
    <meta name="theme-color" content="#009688">
     <!-- icono p/ la pestaña del navegador-->
    <link rel="shortcut icon" href="<?= media(); ?>/images/favicon.png">
    <title><?= $data['page_tag']; ?></title>
    <!-- Main CSS carga de estilos, utiliza por prioridad orden-->
    <link rel="stylesheet" type="text/css" href=" <?= media(); ?>/css/main.css">
     <link rel="stylesheet" type="text/css" href=" <?= media(); ?>/css/style.css">

  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>/dashboard">Tienda Virtual</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
    
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/usuarios/perfil"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <?php 
      //invocamos al navegador
      require_once("nav_admin.php");
     ?>
    