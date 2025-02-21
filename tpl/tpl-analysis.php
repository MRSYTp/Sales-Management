<?php

use App\Helpers\urlHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>آنالیز فروش | کنترل پنل مدیریت</title>
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
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <p class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">پنل</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
    </p>
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
              <img src="<?= $profileURL ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $currentUserData->username ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $profileURL ?>" class="img-circle" alt="User Image">

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
          <img src="<?= $profileURL ?>" class="img-circle" alt="User Image">
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
        آنالیز
        <small>فروش</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $app_config['base_url'] ?>"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">مدیریت</li>
        <li class="active">آنالیز فروش</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= !is_null($SaleRepo->findAll($currentUserData->id)) ? count($SaleRepo->findAll($currentUserData->id)) : 0 ?></h3>

              <p>تعداد فروش کل</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= !is_null($SaleRepo->getCustomers($currentUserData->id)) ? count($SaleRepo->getCustomers($currentUserData->id)) : 0?><sup style="font-size: 20px"></sup></h3>

              <p>تعداد مشتری کل</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $SaleItemRepo->getTotalQuantity($currentUserData->id) ?></h3>

              <p>تعداد محصول فروخته شده</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">گزارش</h3>
              <div class="dataTables_length" id="example1_length">

              </div>
              <div class="box-tools pull-right">
                <button type="submit" class="btn btn-block btn-info btn-sm">Go</button>
                <button type="submit" class="btn btn-block btn-info btn-sm">Go</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong><?=$title?></strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="lineChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header"><?= !is_null($totalSalePrice) ? number_format($totalSalePrice) : 0?> تومان</h5>
                    <span class="description-text">فروش کل</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header"><?= !is_null($totalSaleProfit) ? number_format($totalSaleProfit) : 0?> تومان</h5>
                    <span class="description-text">سود کل</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header"><?= !is_null($totalSaleCount) ? $totalSaleCount : 0?></h5>
                    <span class="description-text">تعداد فروش</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header"><?= !is_null($totalSaleProductCount) ? $totalSaleProductCount : 0?></h5>
                    <span class="description-text">تعداد محصول فروخته شده</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row" >


        <div class="col-md-6" >
            
            <div class="box box-default" >
              <div class="box-header with-border">
                <h3 class="box-title">فروش محصول ها</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body" id="product-cart">
                <div class="row">
                  <div class="col-md-5">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-7">
                    <ul class="chart-legend clearfix" id="product-legend">
                      <!-- اسامی محصولات در اینجا قرار خواهند گرفت -->
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
          </div>
        <div class="col-md-6">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-heart-o fa-trophy"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">پرفروش ترین محصول</span>
              <span class="info-box-number"><?= !is_null($SaleAnalysis->getBestSellingProduct()) ? $SaleAnalysis->getBestSellingProduct()->total_quantity : 0 ?></span>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <span class="progress-description">
                  <?= !is_null($SaleAnalysis->getBestSellingProduct()) ? $SaleAnalysis->getBestSellingProduct()->product_name : 'وجود ندارد' ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">پرسود ترین محصول</span>
              <span class="info-box-number"><?= !is_null($SaleAnalysis->getBestProductByProfit()) ? number_format($SaleAnalysis->getBestProductByProfit()->profit) : 0 ?></span>

              <div class="progress">
                <div class="progress-bar" ></div>
              </div>
              <span class="progress-description">
              <?= !is_null($SaleAnalysis->getBestProductByProfit()) ? $SaleAnalysis->getBestProductByProfit()->product_name : "وجود ندارد" ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">بهترین فروش</span>
              <span class="info-box-number"><?= !is_null($SaleAnalysis->getBestSale()) ? number_format($SaleAnalysis->getBestSale()->total_price) : 0 ?> تومان</span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <span class="progress-description">
                    <?= !is_null($SaleAnalysis->getBestSale()) ? $SaleAnalysis->getBestSale()->customer_name : "وجود ندارد" ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">بهترین مشتری</span>
              <span class="info-box-number"><?= !is_null($SaleAnalysis->getBestCustomer()) ? number_format($SaleAnalysis->getBestCustomer()->total_spent) : 0 ?> تومان</span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <span class="progress-description">
                  <?= !is_null($SaleAnalysis->getBestCustomer()) ? $SaleAnalysis->getBestCustomer()->customer_name : "وجود ندارد" ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-left">
  <strong>Copyleft &copy; 2025 <a href="https://iammohamadrezasalehi.ir/">Mr Salehi</a></strong>
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- ChartJS -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/Chart.js/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0"></script>
<script>
  $(document).ready(function() {
    $.ajax({
      url: '<?= $app_config['base_url'] ?>process/saleProcess/get-sale-percentage-Handler.php',
      method: 'GET',
      dataType: 'json',
      success: function(data) { 
        if (data === null) {
          $('#product-cart').html('<p>هنوز محصولی ثبت نشده است.</p>');
          return;
        }

        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: data.labels,
            datasets: [{
              data: data.data,            
              backgroundColor: data.colors
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'none'
              }
            }
          }
        });

        $('#product-legend').empty();
        data.labels.forEach((label, index) => {
          $('#product-legend').append(`
            <li><i class="fa fa-circle-o" style="color: ${data.colors[index]}"></i> ${label}</li>
          `);
        });
      },
      error: function(xhr, status, error) {
        console.log('خطا در دریافت داده‌ها:', error);
      }
    });

    $.ajax({
          url: '<?= $app_config['base_url'] ?>process/saleProcess/get-sale-total-price-Handler.php',
          method: 'GET',
          data : {
            time: "<?= $_GET['analysisBy'] ?? '7-days-ago'?>"
          },
          dataType: 'json',
          success: function(data) { 
            console.log(data);
            const ctx = document.getElementById('lineChart').getContext('2d');
            if (ctx === null) {
              console.log('خطا: کانواس به درستی بارگذاری نشده است.');
              return;
            }

            new Chart(ctx, {
              type: 'line',
              data: {
                labels: data.labels,
                datasets: [{
                  label: 'درامد کل',
                  data: data.data,
                  borderColor: '#3c8dbc', 
                  fill: false,
                  tension: 0.1
                }]
              },
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top'
                  }
                },
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          },
          error: function(xhr, status, error) {
            console.log('خطا در دریافت داده‌ها:', error);
          }
        });
  });
</script>

<!-- Bootstrap 3.3.7 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $app_config['base_url'] ?>assets/js/adminlte.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $app_config['base_url'] ?>assets/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $app_config['base_url'] ?>assets/js/demo.js"></script>
</body>
</html>
