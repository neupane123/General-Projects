<?php
  @session_start();
  require_once "config/config.php";
  require_once "class/formValidation.class.php";

  
  if(!isset($_SESSION['username']) && empty($_SESSION['username']) || $_SESSION['username']==' ') {
    $uri = base_url()."?auth=0";
    header("location : $uri");
    exit();
  }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($title) ? "Dashboard | ".$title : 'Dashboard';?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/dist/css/skins/_all-skins.min.css">

  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>DB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Blog </b>Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

     
            <a href="admin-logout.php" class="btn btn-primary btn-md pull-right">
              <span class="hidden-xs">Logout</span>
            </a>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo (isset($title) && $title=='Home') ? 'active ' : ' ';?> treeview">
          <a href="<?php echo base_url();?>dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="<?php echo (isset($title) && $title=='Category') ? 'active ' : ' ';?> treeview">
          <a href="<?php echo base_url();?>category-add.php">
            <i class="fa fa-dashboard"></i> <span>Category</span>
          </a>
        </li>

        <li class="<?php echo (isset($title) && $title=='Post') ? 'active ' : ' ';?> treeview">
          <a href="<?php echo base_url();?>post-add.php">
            <i class="fa fa-dashboard"></i> <span>Post</span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->