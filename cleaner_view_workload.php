<!DOCTYPE html>
<html>
<?php 
include'cleaner_session.php';
  $user=$_SESSION['cleaner'];
include 'header.php';
?>
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
          <img src="<?php echo getProfileImage($user);?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php include'cleaner_menu.php';?>
          </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Workload
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Workload > <?php echo date("Y-m-d");?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <?php
        $message='';
            $table_header = "Showing workload for all services";
            
            if(isset($_POST['dispatch'])){
              $id_order = $_POST['dispatch'];
              if(mysqli_query($conn,"UPDATE customer_order SET order_status ='Ready' WHERE idorder = $id_order ")){
                $message=alertSuccess();
              }else{
                $message=alertError();
              }
              
            }elseif(isset($_POST['delete_order'])){
              $query=mysqli_query($conn,"DELETE FROM process WHERE id_order ='".$_POST['delete_order']."'");
            }
     ?>
        <!-- right column -->
        <div class="col-md-12">
          <?php echo $message;?>
          <!-- Horizontal Form -->
          <div class="box box-primary">
           <div class="box-header">
            <h3 class="box-title"><?php echo $table_header;?></h3>
            </div>
            <div class="box-header">
            <div class="row form-group">
            <form method="POST" action="">
            <div class="col-xs-4 pull-left">
                        <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa ">Service category</i>
                      </div>
                      <select  class="form-control select2 " name="particulars"  style="width: 100%;">
                      <option>Select</option>
                      <?php
                          while($row=mysqli_fetch_array($query)){
                            echo '<option value="'.$row['idservice'].'">'.$row['service_name'].'</option>';
                          }
                      ?>
                
                </select>
                    </div>
            </div>
                <div class="col-xs-5">
                  <div class="row form-group">
                    <div class="col-xs-5 pull-left">
                        <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa ">From</i>
                      </div>
                      <input type="date" name="date_from" class="form-control pull-left" placeholder="YY-MM-DD">
                    </div>
                    </div>
                    <div class="col-xs-6 pull-right">
                        <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa">To</i>
                      </div>
                      <input type="date" name="date_to" class="form-control pull-right" placeholder="YY-MM-DD">
                    </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-1">
                  <button type="submit" name="search" class="btn btn-default">Search</button>
                </div>
                </form>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-blue"><small>S/N</small></th>
                  <th class="text-blue"><small>Order Number</small></th>
                  <th class="text-blue"><small>Order date</small></th>
                  <th class="text-blue"><small>Service Type</small></th>
                  <th class="text-blue"><small>Quantity</small></th>
                  <th class="text-blue" style="width: 60px;"><small>Action</small></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                 $query=mysqli_query($conn,"SELECT * FROM assign_order a, customer_order o,users u,services s WHERE a.idorder = o.idorder and o.idservice = s.idservice AND a.idusers = u.idusers AND a.idsettings = $company_id AND o.order_status = 'Queued' AND u.username = '".$user."'");
                    while($row=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['idorder'];?></td>
                        <td><?php echo $row['order_date'];?></td>
                        <td><?php echo $row['service_name'];?></td>
                        <td><?php echo $row['order_quantity'];?></td>
                        <td><form action="" method="post"><button class="btn btn-primary" type="submit" name="dispatch" value="<?php echo $row['idorder'];?>">Dispatch</button></form></td>
                      </tr>
                      <?php
                $i++;
              }
              mysqli_close($conn);
                ?>

                </tbody>
                <tfoot>
                </tfoot>
              </table>
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