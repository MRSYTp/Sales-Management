<?php 
use App\Helpers\urlHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>  محصولات | کنترل پنل</title>
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

      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="جستجو">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

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
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 915.875px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         محصولات

      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $app_config['base_url'] ?>"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">محصولات</li>
        <li class="active">محصولات</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="dataTables_length" id="example1_length">
                  <label style="display: inline-block;">نمایش</label>
                  <select name="example1_length" aria-controls="example1" class="form-control input-sm" style="display: inline-block; width: auto;">
                      <option value="">انتخاب گزینه</option>
                      <option value="1">گرانترین</option>
                      <option value="2">ارزانترین</option>
                  </select>
                  <label style="display: inline-block;">محصولات</label>
              </div>


                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control" placeholder="جستجو">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                <?php if(is_null($products)) :  ?>
                    <th>محصولی یافت نشد</th>
                <?php endif; ?>
                <?php if (!is_null($products)) : ?>
                  <th>نام</th>
                  <th>قیمت خرید</th>
                  <th>قیمت فروش</th>
                  <th>عملیات</th>
                </tr>
                <?php foreach($products as $product) : ?>
                <tr>
                  
                  <td><?= $product->name ?></td>
                  <td><?= $product->cost_price ?></td>
                  <td><?= $product->sell_price ?></td>
                  <td><button type="button" class="label label-primary" data-toggle="modal" data-target="#modal-info">ویرایش</button></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                
              </tbody></table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="modal modal-info fade" id="modal-info" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ویرایشگر</h4>
              </div>
              <div class="modal-body">
                <p>محتوا</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">خروج</button>
                <button type="button" class="btn btn-outline">ذخیره</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-left">
    <strong>Copyleft &copy; 2014-2017 <a href="https://adminlte.io">Almsaeed Studio</a> & <a href="https://netparadis.com">NetParadis</a></strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?= $app_config['base_url'] ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>

$(document).ready(function () {

    function updateTable(response) {
        let tableBody = $('table tbody');
        tableBody.empty();

        if (response === null || response.length === 0) {
            tableBody.append('<tr><td colspan="4">محصولی یافت نشد</td></tr>');
        } else {
            tableBody.append(`
                    <tr>
                      <th>نام</th>
                      <th>قیمت خرید</th>
                      <th>قیمت فروش</th>
                      <th>عملیات</th>
                    </tr>
            
            `);
            response.forEach(function (product) {
                tableBody.append(`
                    <tr>
                        <td>${product.name}</td>
                        <td>${product.cost_price}</td>
                        <td>${product.sell_price}</td>
                        <td><button type="button" class="label label-primary" data-toggle="modal" data-target="#modal-info">ویرایش</button></td>
                    </tr>
                `);
            });
        }
    }

    // ارسال مقدار انتخاب‌شده به سرور
    $('select[name="example1_length"]').on('change', function () {
        let sortValue = $(this).val();

        if (sortValue === '') {
            return;
        }

        $.ajax({
            url: 'process/sort-product-handler.php',
            type: 'POST',
            data: { sort: sortValue,
                user_id: <?= $currentUserData->id ?> },
            dataType: 'json',
            success: function (response) {
                updateTable(response);
            },
            error: function () {
                alert('خطا در دریافت اطلاعات');
            }
        });
    });

    $('input[name="table_search"]').on('keyup', function () {
        let searchText = $(this).val().trim();

        $.ajax({
            url: 'process/product-search-handler.php',
            type: 'POST',
            data: { name: searchText,
                user_id: <?= $currentUserData->id ?> },
            dataType: 'json',
            success: function (response) {
                updateTable(response);
            },
            error: function () {
                alert('خطا در دریافت اطلاعات');
            }
        });
    });
});



</script>
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
