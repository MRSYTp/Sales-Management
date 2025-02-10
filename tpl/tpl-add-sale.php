<?php 
use App\Helpers\urlHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> افزودن فروش  | کنترل پنل</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/bootstrap-theme.css">
  <!-- Bootstrap rtl -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/rtl.css">
  <!-- babakhani datepicker -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/css/persian-datepicker-0.4.5.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= $app_config['base_url'] ?>assets/bower_components/select2/dist/css/select2.min.css">
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        افزودن فروش جدید
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
        <li class="active">محصول ها</li>
        <li class="active">افزودن محصول</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="<?= $app_config['base_url'] ?>add-sale.php" method="post">
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row">


                <div class="col-md-6">
                    <div class="form-group">
                        <label>نام مشتری:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input name="customer_name" type="text" class="form-control" placeholder="نام مشتری">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>شماره مشتری:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input name="customer_phone" type="text" class="form-control" placeholder="شماره مشتری(اختیاری)" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>تاریخ ثبت:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input  type="text" id="tarikh" class="form-control pull-right">
                            <input name="sale_date" type="hidden" id="tarikhAlt" class="form-control pull-right">
                            <input type="hidden" name="total_price" id="total_sell_price_input">
                        </div>
                    </div>

                    <div class="form-group">
                            <label style="display: block;">انتخاب محصول:</label>
                            <div class="input-group" style="display: inline;">
                            <select id="product" class="form-control" style="width: 74%; display: inline;" <?= is_null($products) ? 'disabled' : '';  ?>>
                                <?php if(is_null($products)): ?>
                                <option>محصولی ندارید</option>
                                <?php endif; ?>
                                <?php foreach($products as $product): ?>
                                <option value="<?= $product->id ?>"><?= $product->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="number" id="product-quantity" class="form-control" placeholder="تعداد" min="1" max="100" style="width: 16%; display: inline;" <?= is_null($products) ? 'disabled' : '';  ?>>
                            <button type="button" id="add-product" class="btn bg-navy btn-flat" style="width: 9%; display: inline;" <?= is_null($products) ? 'disabled' : '';  ?>><li class="fa fa-plus"></li></button>
                            </div>
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 15px;">
                    
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting">نام</th>
                                            <th class="sorting" style="width: 90px;" >قیمت کل</th>
                                            <th class="sorting" style="width: 50px;">تعداد</th>
                                            <th class="sorting" style="width: 60px;">عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <b>قیمت کل فروش:</b>
                <p style="display: inline;" id="total_sell_price"></p>
            </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">ارسال</button>
            </div>
        </div>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-left">
    <strong>Copyleft &copy; 2014-2017 <a href="https://adminlte.io">Almsaeed Studio</a> & <a href="https://netparadis.com">NetParadis</a></strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        toggleTableVisibility();
        updateTotalSellPrice();


        function toggleTableVisibility() {
            var $table = $('#example1');
            var $tbody = $table.find('tbody');


            if ($tbody.children().length === 0) {
                $table.closest('.col-md-12').hide();
            } else {
                
                $table.closest('.col-md-12').show();
            }
        }

        function updateTotalSellPrice() {
            var totalSellPrice = 0;

            $('#example1 tbody tr').each(function () {
                var totalPrice = parseFloat($(this).find('input[name^="totalPrice"]').val()) || 0;
                totalSellPrice += totalPrice;
            });

            
            $('#total_sell_price').text(totalSellPrice.toLocaleString('fa-IR')); 
            $('#total_sell_price_input').val(totalSellPrice);
        }

        $(document).on('click', '.btn-delete-row', function () {

            var $row = $(this).closest('tr');

            $row.remove();

            toggleTableVisibility();
            updateTotalSellPrice();

        });

        $('#add-product').on('click', function () { 

            var productId = $('#product').val();
            var productQuantity = $('#product-quantity').val();
 

            if (!productId || !productQuantity || productQuantity <= 0) {
                alert('لطفاً محصول و تعداد معتبر را وارد کنید.');
                return;
            }


            $.ajax({
                url: 'process/sale-product-handler.php',
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity: productQuantity
                },
                dataType: 'json',
                success: function (response) {

                    var newRow = `
                        <tr role="row">
                            <input type="hidden" name="id.${response.id}" value="${response.id}">
                            <input type="hidden" name="totalPrice.${response.id}" value="${response.total_price}">
                            <input type="hidden" name="sellPrice.${response.id}" value="${response.sell_price}">
                            <input type="hidden" name="quantity.${response.id}" value="${response.quantity}">

                            <td>${response.name}</td>
                            <td>${response.total_price}</td>
                            <td>${response.quantity}</td>
                            <td><button type="button" class="btn btn-danger btn-delete-row">حذف</button></td>
                        </tr>
                    `;

                    $('#example1 tbody').append(newRow);

                    toggleTableVisibility();

                    updateTotalSellPrice();
                },
                error: function () {
                    alert('خطا در ارتباط با سرور!');
                }
            });
        });

    });
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
<!-- iCheck 1.0.1 -->
<script src="<?= $app_config['base_url'] ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?= $app_config['base_url'] ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= $app_config['base_url'] ?>assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $app_config['base_url'] ?>assets/js/demo.js"></script>
<!-- babakhani datepicker -->
<script src="<?= $app_config['base_url'] ?>assets/js/persian-date-0.1.8.min.js"></script>
<script src="<?= $app_config['base_url'] ?>assets/js/persian-datepicker-0.4.5.min.js"></script>
<!-- Page script -->
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
