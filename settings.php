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
  $message='';
  if(isset($_POST['addservice'])){
          $service = $_POST['service'];
          $price = $_POST['price'];
              if(mysqli_query($conn,"INSERT INTO services(service_name,service_price,idsettings) VALUES('$service',$price,$company_id)")){
                $message=alertSuccess();
              }else{
                $message=alertError();
              }
            }elseif (isset($_POST['save_changes'])) {
              if(mysqli_query($conn,"UPDATE services SET service_name ='".$_POST['service_name']."',service_price='".$_POST['service_price']."' WHERE idservice ='".$_POST['idservice']."' AND idsettings = $company_id")){
                $message=alertSuccess();
              }else{
                $message=alertError();
              }
            }elseif (isset($_POST['delete_service'])) {
              if(mysqli_query($conn,"DELETE FROM services WHERE idservice ='".$_POST['idservice']."'")){
                $message=alertSuccess();
              }else{
                $message=alertError();
              }
            }
  $service=mysqli_query($conn,"SELECT * FROM services WHERE idsettings = $company_id");
  
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
                 while($row=mysqli_fetch_array($service)){ ?>
                  <tr>
                   <td><?php echo $x;?></td>
                   <td><?php echo $row['service_name'];?></td>
                   <td><?php echo $row['service_price'];?></td>
                   <td><div class=""><a data-toggle="modal" href="#order-assign-form<?php echo $row['idservice'];?>" class="btn btn-primary pull-left">Change</a><form method="post" action=""><button class="btn btn-danger pull-right" name="delete_service" type="submit">Delete</button>
                  <input type="hidden" name="idservice" value="<?php echo $row['idservice'];?>"></form></div></td>
                <div class="modal modal-default fade" id="order-assign-form<?php echo $row['idservice'];?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">Service Editting Form</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-6">
                              <input type="hidden" name="idservice" value="<?php echo $row['idservice'];?>">
                                <label class="text-info">Service name</label>
                                <input type="text" class="form-control" name="service_name" value="<?php echo $row['service_name']?>">
                            </div>
                            <div class="col-xs-6">
                              
                                <label class="text-info">Price</label>
                                <input type="text" class="form-control" name="service_price" value="<?php echo $row['service_price']?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_changes" class="btn btn-success btn-md">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
                  </tr>
                  <?php
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
