<?php include 'admin_session.php';
  $user=$_SESSION['admin'];
?>
<!DOCTYPE html>
<html>
<?php include'header.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include'header_top.php';?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user;?></p>
          <a href="#"><i class="fa fa-circle text-"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php include('admin_menu.php');?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>
<?php
  include 'connection.php';
  $message='';
  $color=mysqli_query($conn,"SELECT * FROM services WHERE idsettings = $id_company");
  $expense=mysqli_query($conn,"SELECT * FROM users WHERE idsettings = $id_company");
  if(isset($_POST['addservice'])){
          $service = $_POST['service'];
          $price = $_POST['price'];
              if(mysqli_query($conn,"INSERT INTO services(service_name,service_price,idsettings) VALUES('$service',$price,$id_company)")){
                $message=alertSuccess();
                $color=mysqli_query($conn,"SELECT * FROM services WHERE idsettings = $id_company");
              }else{
                $message=alertError();
                $color=mysqli_query($conn,"SELECT * FROM services WHERE idsettings = $id_company");
              }
            }
              
            // }elseif (isset($_POST['addexpense'])) {
            //   $sql=mysqli_query($conn,"INSERT INTO expenses(expense_type) VALUES('".$_POST['expense']."')")or die(mysqli_error($conn));
            //   $expense=mysqli_query($conn,"SELECT * FROM expenses");
            // }
            // elseif (isset($_POST['delete_service'])) {
            //   $sql=mysqli_query($conn," DELETE FROM  services WHERE idservice='".$_POST['delete_service']."'")or die(mysqli_error($conn));
            //   $color=mysqli_query($conn,"SELECT * FROM services");
            // }elseif (isset($_POST['delete_user'])) {
            //   $sql=mysqli_query($conn," DELETE FROM  users WHERE idusers='".$_POST['delete_user']."'")or die("Record cannot be deleted");
            //   $expense=mysqli_query($conn,"SELECT * FROM users WHERE idsettings = 19");
            // }
?>
    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
              <!-- general form elements disabled -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Services</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <table id="example2" class="table table-bordered table-hover">
                <thead>
                
                <tr>
                  <th class="text-blue"><small>ID</small></th>
                  <th class="text-blue"><small>Service</small></th>
                  <th class="text-blue"><small>Service price</small></th>
                  <th class="text-blue"><small>Action</small></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $x=1;
                 while($row=mysqli_fetch_array($color)){ 
                  echo '<tr>';
                   echo '<td>'.$x.'</td>';
                   echo '<td>'.$row['service_name'].'</td>';
                   echo '<td>'.$row['service_price'].'</td>';
                   echo '<td><div><button type="submit" name="delete_service" value="'.$row['idservice'].'" class="btn btn-primary btn-sm btn-col-xs-6 pull-left">Change</button><form action="" method="POST"><button type="submit" name="delete_service" value="'.$row['idservice'].'" class="btn btn-danger btn-sm btn-col-xs-6 pull-right">Delete</button></form></div></td>';
                  echo '</tr>';
                  $x++;
                  }
                  ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              <form action="" method="post" role="form">
                <!-- text input -->
                  <div class="row form-group">
                <div class="col-xs-6">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-pencil"></i> <label>Service name</label>
                  </div>
                  <input type="text" name="service" class="form-control pull-left" required="true" id="">
                </div>
                </div>
                <div class="col-xs-4">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dollar"></i> <label>Price</label>
                  </div>
                  <input type="number" name="price" class="form-control pull-left" required="true" id="">
                </div>
                </div>
                <div class="col-xs-2">
                  <button type="submit" name="addservice" class="btn btn-success">Add Service</button>
                </div>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>

          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include'footer.php';?>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
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
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
