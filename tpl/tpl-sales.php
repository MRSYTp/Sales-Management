<?php 
use App\Helpers\urlHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>  فروش ها | کنترل پنل</title>
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
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/plugins/iCheck/all.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/AdminLTE.css">
<!-- Skins -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/skins/_all-skins.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- Input Mask -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/plugins/input-mask/inputmask.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- bootstrap color picker -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<!-- bootstrap time picker -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Persian Datepicker -->
<link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/persian-datepicker-0.4.5.min.css" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
  <div class="content-wrapper" style="min-height: 915.875px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        فروش ها
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $app_config['base_url'] ?>"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">فروش ها</li>
        <li class="active">فروش ها</li>
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
                            <input type="search" class="form-control input-sm" name="table_search" placeholder="" aria-controls="example1">
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
                      <option value="3">جدیدترین</option>
                      <option value="4">قدیمیترین</option>
                  </select>
                </div>
                </div>
                <div class="col-sm-12" style="margin-top: 15px;">
                    <div id="example1_filter" class="dataTables_filter">
                    <label style="display: block;">دسته بندی:</label>
                    <div class="form-group">
                        <label class="">
                            <input id="justnumber" name="justnumber" type="checkbox">
                          شماره همراه
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
        <?php if(is_null($Sales)) :  ?>
          <div class="alert alert-warning">هیچ فروشی یافت نشد.</div>
        <?php endif; ?>
        <?php if(!is_null($Sales)) : ?>
        <?php foreach($Sales as $sale) : ?>
          <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-12">
                        <p class="lead"><?= $sale->customer_name ?></p>

                        <div class="table-responsive">
                            <table class="table">
                            <tbody><tr>
                                <th style="width:50%">شماره مشتری:</th>
                                <td> <?= is_null($sale->customer_phone) ? 'ندارد' : $sale->customer_phone ?> </td>
                            </tr>
                            <tr>
                                <th>مبلع کل خرید:</th>
                                <td><?= number_format($sale->total_price);?> تومان</td>
                            </tr>
                            <tr>
                                <th>سود شما از خرید:</th>
                                <td><?= number_format($SaleAnalysis->getProfit($sale->id)) ?> تومان</td>
                            </tr>
                            <tr>
                                <th>زمان خرید:</th>
                                <td><?= verta($sale->sale_date)->format('%d  %B  %Y'); ?></td>
                            </tr>
                            </tbody>
                        </table> 
                        </div>
                        
                    </div>
                    
                    <!-- /.col -->
                </div>
                

                <div class="row" style="display: none;">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>تعداد</th>
                            <th>نام</th>
                            <th>قیمت محصول</th>
                            <th>قیمت کل</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $saleitems = $SaleItemRepo->findAll($sale->id); ?>
                            <?php foreach($saleitems as $saleitem) : ?>
                            <tr>
                            <td><?= $saleitem->quantity?></td>
                            <td><?= $saleitem->product_name ?></td>
                            <td><?= number_format($saleitem->sell_price);?> تومان</td>
                            <td><?= number_format($saleitem->total_price);?> تومان</td>
                            </tr>
                            <?php  endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            <button type="button" class="btn btn-block btn-primary details-button" style="margin: 0px; width: 15%;">جزییات</button>
            </div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
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

<script src="<?= $app_config['base_url'] ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>

  $(document).ready(function() {

      function updateSalesTable(response) {
        let tableBody = $('div.col-md-9');
        tableBody.empty(); 

        
        if (response.sale === null) {
            tableBody.append('<div class="alert alert-warning">هیچ فروشی یافت نشد.</div>');
        } else {
            
            response.sale.forEach(function (sale) {
                let saleDetails = `
                    <div class="box box-primary" id="sale-${sale.id}">
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p class="lead">${sale.customer_name}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr><th style="width:50%">شماره مشتری:</th><td>${sale.customer_phone || 'ندارد'}</td></tr>
                                                <tr><th>مبلغ کل خرید:</th><td>${new Intl.NumberFormat().format(sale.total_price)} تومان</td></tr>
                                                <tr><th>سود شما از خرید:</th><td>${new Intl.NumberFormat().format(sale.sell_profit)} تومان</td></tr>
                                                <tr><th>زمان خرید:</th><td>${sale.sale_date}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="row" style="display: none;">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr><th>تعداد</th><th>نام محصول</th><th>قیمت محصول</th><th>قیمت کل</th></tr>
                                        </thead>
                                        <tbody>
                                        `;
                if (response.saleItem[sale.id]) {
                    response.saleItem[sale.id].forEach(function (item) {
                        saleDetails += `
                            <tr>
                                <td>${item.quantity}</td>
                                <td>${item.product_name}</td>
                                <td>${new Intl.NumberFormat().format(item.sell_price)} تومان</td>
                                <td>${new Intl.NumberFormat().format(item.total_price)} تومان</td>
                            </tr>
                        `;
                    });
                } else {
                    saleDetails += `<tr><td colspan="4">هیچ کالایی برای این فروش یافت نشد.</td></tr>`;
                }

                saleDetails += `
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-block btn-primary details-button" style="margin: 0px; width: 15%;">جزییات</button>
                        </div>
                    </div>
                `;
                tableBody.append(saleDetails);
            });
        }
      }

        $('select[name="example1_length"]').on('change', function () {
          let sortValue = $(this).val();

          if (sortValue === '') {
              return;
          }

          $.ajax({
              url: '<?= $app_config['base_url'] ?>process/saleProcess/sort-sale-handler.php',
              type: 'POST',
              data: { sort: sortValue,
                  user_id: <?= $currentUserData->id ?> },
              dataType: 'json',
              success: function (response) {
                  updateSalesTable(response);
              },
              error: function () {
                  alert('خطا در دریافت اطلاعات');
              }
          });
       });

       $('#justnumber').on('change', function() {
            let isChecked = $(this).is(':checked') ? 1 : 0; 
            $.ajax({
                url: '<?= $app_config['base_url'] ?>process/saleProcess/sale-justNumber-handler.php',
                type: 'POST',
                data: { justnumber: isChecked,
                        user_id : <?= $currentUserData->id ?> 
                 },
                success: function(response) {
                    updateSalesTable(response);
                },
                error: function(xhr, status, error) {
                  alert('خطا در دریافت اطلاعات');
                }
            });
        });

      $(document).on('click', '.details-button', function() {
        var detailsRow = $(this).closest(".box-body").find(".row").eq(1);
        var button = $(this); 

        detailsRow.slideToggle(300, function() {
            button.text(detailsRow.is(":visible") ? "بستن جزییات" : "جزییات");
        });
      });


        $('input[name="table_search"]').on('keyup', function () {
          let searchText = $(this).val().trim();

          $.ajax({
              url: '<?= $app_config['base_url'] ?>process/saleProcess/sale-search-handler.php',
              type: 'POST',
              data: { customer_name: searchText,
                  user_id: <?= $currentUserData->id ?> },
              dataType: 'json',
              success: function (response) {
                  updateSalesTable(response);
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
<!-- iCheck 1.0.1 -->
<script src="<?= $app_config['base_url'] ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $app_config['base_url'] ?>assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $app_config['base_url'] ?>assets/js/demo.js"></script>
<!-- Select2 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= $app_config['base_url'] ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= $app_config['base_url'] ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= $app_config['base_url'] ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?= $app_config['base_url'] ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- babakhani datepicker -->
<script src="<?= $app_config['base_url'] ?>assets/js/persian-date-0.1.8.min.js"></script>
<script src="<?= $app_config['base_url'] ?>assets/js/persian-datepicker-0.4.5.min.js"></script>

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
