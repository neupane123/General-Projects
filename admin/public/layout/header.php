<?php SessionHelper::adminlogin() ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/a3cd9cb368.js"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url()?>public/dist/css/skins/_all-skins.min.css">
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>public/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>public/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>public/dist/js/demo.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>public/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>public/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
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

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="user-menu">
            <a href="logout.php" class="dropdown-toggle" data-toggle="">
              <span class="hidden-xs">Sign Out</span>
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
        <li class="header"></li>
        <?php
          if ($currentpage=='dashboard') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="dashboard.php">
            <i class="fa dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php
          if ($currentpage=='logo') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="logo.php">
            <i class="fa dashboard"></i> <span>Logo</span>
          </a>
        </li>
        <?php
          if ($currentpage=='reservation') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="reservation.php">
            <i class="fa fa-ticket"></i> <span>Reservation</span>
          </a>
        </li>
        <?php
          if ($currentpage=='message') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="messagecontact.php">
            <i class="fa fa-envelope-o"></i> <span>Contact Message</span>
          </a>
        </li>
        <?php
          if ($currentpage=='slider') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-television"></i> <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="#"><a href="slideradd.php"><i class="fa fa-plus"></i> Add Slider</a></li>
            <li><a href="sliderindex.php"><i class="fa fa-list-ul"></i> Index Slider</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='foodcategory') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-glass"></i> <span>Food Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="#"><a href="foodcategoryadd.php"><i class="fa fa-plus"></i> Add Food Category</a></li>
            <li><a href="foodcategoryindex.php"><i class="fa fa-list-ul"></i> Index Food Category</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='fooditem') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-glass"></i> <span>Food Item</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="#"><a href="fooditemadd.php"><i class="fa fa-plus"></i> Add Food Item</a></li>
            <li><a href="fooditemindex.php"><i class="fa fa-list-ul"></i> Index Food Item</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='image') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa  fa-file-image-o"></i> <span>Image</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="imageadd.php"><i class="fa fa-plus"></i> Add Image</a></li>
            <li class=""><a href="imagecategoryadd.php"><i class="fa fa-plus"></i> Add Image Category</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='branch') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-building-o"></i> <span>Branch</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="branchadd.php"><i class="fa fa-plus"></i> Add Branch</a></li>
            <li><a href="branchindex.php"><i class="fa fa-list-ul"></i> Index Branch</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='team') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-users"></i> <span>Team</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="teamadd.php"><i class="fa fa-plus"></i> Add Team</a></li>
            <li><a href="teamindex.php"><i class="fa fa-list-ul"></i> Index Team</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='social') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="sociallink.php">
            <i class="fa  fa-share-alt"></i> <span>Social</span>
          </a>
        </li>
        <?php
          if ($currentpage=='contact') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="contact.php">
            <i class="fa fa-phone"></i> <span>Contact Page</span>
          </a>
        </li>
        <?php
          if ($currentpage=='testimonial') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-comment-o"></i> <span>Testimonial</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="#"><a href="testimonialadd.php"><i class="fa fa-plus"></i> Add Testimonial</a></li>
            <li><a href="testimonialindex.php"><i class="fa fa-list-ul"></i> Index Testimonial</a></li>
          </ul>
        </li>
        <?php
          if ($currentpage=='single') {
            echo "<li class='treeview active'>";
          }else{
            echo "<li class='treeview'>";
          }
        ?>
          <a href="#">
            <i class="fa fa-user"></i> <span>About Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="aboutuspage.php"><i class="fa fa-users"></i> About Us </a></li>
            <li><a href="aboutresturant.php"><i class="fa fa-home"></i> Our Resturant </a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>