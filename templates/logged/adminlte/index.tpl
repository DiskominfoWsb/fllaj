<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{$web_title} - {$appname}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{$themepath}bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{$themepath}bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{$themepath}bower_components/Ionicons/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{$themepath}bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{$themepath}wfadd/buttons.dataTables.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{$themepath}bower_components/select2/dist/css/select2.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{$themepath}plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{$themepath}dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{$themepath}dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="{$themepath}dist/css/bootstrap-tagsinput.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link href="{$themepath}plugins/sweetalert/sweetalert.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="{$themepath}plugins/datetime/bootstrap-datetimepicker.css">

  <script type="text/javascript">
    var jbase = "{$basedir}";
    var jtheme = "{$themepath}";
  </script>

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <script src="{$themepath}bower_components/jquery/dist/jquery.min.js"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>WF</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><marquee>{$nama_app_singkat}</marquee></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

    
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{$basedir}{$ff}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{$nama_lengkap}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{$basedir}{$ff}" class="img-circle" alt="User Image">

                <p>
                  {$nama_lengkap}
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{$basedir}giadmin/gantipassword" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
                <div class="pull-right">
                  <a href="{$basedir}giadmin/logout" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{$basedir}{$ff}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{$nama_lengkap}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">HEADER</li> -->
        <!-- Optionally, you can add icons to the links -->
        {$menu_navigasi}
        <li>
            <a href="{$basedir}giadmin/account"><i class="fa fa-user"></i><span>My Account</span></a>
        </li>
        <li>
            <a href="{$basedir}giadmin/logout"><i class="fa fa-sign-out"></i><span>Log Out</span></a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {$page_title}
        <!-- <small>Optional description</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        {$content}

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Developed By <a href="https://wfdev.us" target="_blank">WF</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#">{$appname}</a>.</strong> All rights reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{$themepath}bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{$themepath}bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="{$themepath}bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{$themepath}plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="{$themepath}bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{$themepath}bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{$themepath}wfadd/dataTables.buttons.min.js"></script>
<script src="{$themepath}wfadd/jszip.min.js"></script>
<script src="{$themepath}wfadd/pdfmake.min.js"></script>
<script src="{$themepath}wfadd/vfs_fonts.js"></script>
<script src="{$themepath}wfadd/buttons.html5.min.js"></script>
<script src="{$themepath}wfadd/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="{$themepath}dist/js/adminlte.min.js"></script>
<script src="{$themepath}dist/js/bootstrap-tagsinput.js"></script>

<script src="{$themepath}plugins/sweetalert/sweetalert.min.js"></script>
<script src="{$themepath}plugins/tinymce/tinymce.min.js"></script>

<script src="{$themepath}plugins/datetime/moment-with-locales.min.js" type="text/javascript"></script>
<script src="{$themepath}plugins/datetime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="{$basedir}js/logged/wf.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>