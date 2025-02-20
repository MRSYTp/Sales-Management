<?php 
use App\Helpers\urlHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> افزودن محصول | کنترل پنل</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/bootstrap-theme.css">
  <!-- Bootstrap rtl -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/rtl.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/skins/_all-skins.min.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">پنل</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $app_config['base_url'] ?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $currentUserData->username ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $app_config['base_url'] ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                <?= $currentUserData->username ?>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">پروفایل (بزودی)</a>
                </div>
                <div class="pull-left">
                  <a href="<?= urlHelper::siteUrl('add-product.php?action=logout') ?>" class="btn btn-default btn-flat">خروج</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- right side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-right image">
          <img src="<?= $app_config['base_url'] ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
          <p><?= $currentUserData->username ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
        </div>
      </div>

      <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">منو</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>محصولات</span>
            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= $app_config['base_url'] ?>products.php"><i class="fa fa-circle-o"></i>محصولات</a></li>
            <li><a href="<?= $app_config['base_url'] ?>add-product.php"><i class="fa fa-circle-o"></i>افزودن محصول</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>فروش ها</span>
            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= $app_config['base_url'] ?>sales.php"><i class="fa fa-circle-o"></i>فروش ها</a></li>
            <li><a href="<?= $app_config['base_url'] ?>add-sale.php"><i class="fa fa-circle-o"></i>افزودن فروش</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-signal"></i>
            <span>مدیریت</span>
            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= $app_config['base_url'] ?>analysis.php"><i class="fa fa-circle-o"></i>آنالیز فروش</a></li>
          </ul>
        </li>
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        افزودن محصول جدید
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $app_config['base_url'] ?>"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">محصول ها</li>
        <li class="active">افزودن محصول</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?= urlHelper::siteUrl('add-product.php') ?>" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">نام محصول:</label>
                  <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="نام محصول">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">قیمت خرید:</label>
                  <input name="cost_price" type="text" class="form-control" id="exampleInputEmail1" placeholder="قیمت خرید">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">قیمت فروش:</label>
                  <input name="sell_price" type="text" class="form-control" id="exampleInputEmail1" placeholder="قیمت فروش">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">ارسال</button>
                <button type="reset" class="btn btn-danger">انصراف</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-left">
  <strong>Copyleft &copy; 2025 <a href="https://iammohamadrezasalehi.ir/">Mr Salehi</a></strong>
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= $app_config['base_url'] ?>assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $app_config['base_url'] ?>assets/js/demo.js"></script>
</body>
</html>
