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
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/plugins/iCheck/all.css">
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
        <div class="col-md-3">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-filter"></i>

              <h3 class="box-title">فیلتر</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-sm-12">
                    <div id="example1_filter" class="dataTables_filter">
                        <label>
                            جستجو:
                            <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                        </label>
                    </div>
                </div>
                <div class="col-sm-12" style="margin-top: 15px;">
                <div class="dataTables_length" id="example1_length">
                  <label style="display: inline-block;">مرتب سازی:</label>
                  <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                      <option value="">انتخاب گزینه</option>
                      <option value="1">گرانترین</option>
                      <option value="2">ارزانترین</option>
                  </select>
                </div>
                </div>
                <div class="col-sm-12" style="margin-top: 15px;">
                    <div id="example1_filter" class="dataTables_filter">
                    <label style="display: block;">دسته بندی:</label>
                    <div class="form-group">
                        <label class="">
                        <div class="icheckbox_minimal-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="minimal" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                        نمونه چک باکس
                        </label>
                        <label class="">
                        <div class="icheckbox_minimal-blue checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" class="minimal" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                        </label>
                    </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-12">
                        <p class="lead">مهلت پرداخت: ۱۳ مرداد ۱۳۹۶</p>

                        <div class="table-responsive">
                            <table class="table">
                            <tbody><tr>
                                <th style="width:50%">مبلغ کل:</th>
                                <td>250.300 تومان</td>
                            </tr>
                            <tr>
                                <th>مالیات (9.3%)</th>
                                <td>10.340 تومان</td>
                            </tr>
                            <tr>
                                <th>تخفیف</th>
                                <td>5.800 تومان</td>
                            </tr>
                            <tr>
                                <th>مبلغ قابل پرداخت:</th>
                                <td>255.240 تومان</td>
                            </tr>
                            </tbody>
                        </table> 
                        </div>
                        <button type="button" class="btn btn-block btn-primary" style="margin: 0px; width: 15%;">جزییات</button>
                    </div>
                    
                    <!-- /.col -->
                </div>
                

                <!-- <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>تعداد</th>
                            <th>محصول</th>
                            <th>سریال</th>
                            <th>توضیحات</th>
                            <th>قیمت کل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>1</td>
                            <td>Call of Duty</td>
                            <td>455-981-221</td>
                            <td>بازی جنگی</td>
                            <td> 64.500 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Need for Speed IV</td>
                            <td>247-925-726</td>
                            <td>بازی ماشینی</td>
                            <td>50.000 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Monsters DVD</td>
                            <td>735-845-642</td>
                            <td>بازی خیابانی</td>
                            <td>10.700 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Grown Ups Blue Ray</td>
                            <td>422-568-642</td>
                            <td>بازی فکری</td>
                            <td>25.990 تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div> -->

            </div>
            
            <!-- /.box-body -->
          </div>
          <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-12">
                        <p class="lead">مهلت پرداخت: ۱۳ مرداد ۱۳۹۶</p>

                        <div class="table-responsive">
                            <table class="table">
                            <tbody><tr>
                                <th style="width:50%">مبلغ کل:</th>
                                <td>250.300 تومان</td>
                            </tr>
                            <tr>
                                <th>مالیات (9.3%)</th>
                                <td>10.340 تومان</td>
                            </tr>
                            <tr>
                                <th>تخفیف</th>
                                <td>5.800 تومان</td>
                            </tr>
                            <tr>
                                <th>مبلغ قابل پرداخت:</th>
                                <td>255.240 تومان</td>
                            </tr>
                            </tbody>
                        </table> 
                        </div>
                        <button type="button" class="btn btn-block btn-primary" style="margin: 0px; width: 15%;">جزییات</button>
                    </div>
                    
                    <!-- /.col -->
                </div>
                

                <!-- <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>تعداد</th>
                            <th>محصول</th>
                            <th>سریال</th>
                            <th>توضیحات</th>
                            <th>قیمت کل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>1</td>
                            <td>Call of Duty</td>
                            <td>455-981-221</td>
                            <td>بازی جنگی</td>
                            <td> 64.500 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Need for Speed IV</td>
                            <td>247-925-726</td>
                            <td>بازی ماشینی</td>
                            <td>50.000 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Monsters DVD</td>
                            <td>735-845-642</td>
                            <td>بازی خیابانی</td>
                            <td>10.700 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Grown Ups Blue Ray</td>
                            <td>422-568-642</td>
                            <td>بازی فکری</td>
                            <td>25.990 تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div> -->

            </div>
            
            <!-- /.box-body -->
          </div>
          <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-12">
                        <p class="lead">مهلت پرداخت: ۱۳ مرداد ۱۳۹۶</p>

                        <div class="table-responsive">
                            <table class="table">
                            <tbody><tr>
                                <th style="width:50%">مبلغ کل:</th>
                                <td>250.300 تومان</td>
                            </tr>
                            <tr>
                                <th>مالیات (9.3%)</th>
                                <td>10.340 تومان</td>
                            </tr>
                            <tr>
                                <th>تخفیف</th>
                                <td>5.800 تومان</td>
                            </tr>
                            <tr>
                                <th>مبلغ قابل پرداخت:</th>
                                <td>255.240 تومان</td>
                            </tr>
                            </tbody>
                        </table> 
                        </div>
                        <button type="button" class="btn btn-block btn-primary" style="margin: 0px; width: 15%;">جزییات</button>
                    </div>
                    
                    <!-- /.col -->
                </div>
                

                <!-- <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>تعداد</th>
                            <th>محصول</th>
                            <th>سریال</th>
                            <th>توضیحات</th>
                            <th>قیمت کل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>1</td>
                            <td>Call of Duty</td>
                            <td>455-981-221</td>
                            <td>بازی جنگی</td>
                            <td> 64.500 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Need for Speed IV</td>
                            <td>247-925-726</td>
                            <td>بازی ماشینی</td>
                            <td>50.000 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Monsters DVD</td>
                            <td>735-845-642</td>
                            <td>بازی خیابانی</td>
                            <td>10.700 تومان</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Grown Ups Blue Ray</td>
                            <td>422-568-642</td>
                            <td>بازی فکری</td>
                            <td>25.990 تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div> -->

            </div>
            
            <!-- /.box-body -->
          </div>

        </div>
        
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
<!-- Bootstrap 3.3.7 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?= $app_config['base_url'] ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $app_config['base_url'] ?>assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $app_config['base_url'] ?>assets/js/demo.js"></script>
<script>
    $(document).ready(function () {
        $('#tarikh').persianDatepicker({
            altField: '#tarikhAlt',
            altFormat: 'X',
            format: 'D MMMM YYYY HH:mm a',
            observer: true,
            timePicker: {
                enabled: true
            },
        });
    });
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
