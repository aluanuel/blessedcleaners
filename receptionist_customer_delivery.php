<!DOCTYPE html>
<html>
<?php 
include'receptionist_session.php';
  $user=$_SESSION['receptionist'];
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
      <?php include'receptionist_menu.php';?>
          </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product dispatch 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product dispatch > <?php echo date("Y-m-d");?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <?php
        $message = '';
            
            $table_header = "Avaialbe customer orders";

            if(isset($_POST['save_bill'])){

              if(mysqli_query($conn,"INSERT INTO order_payment(idorder,cash_pay,idsettings) VALUES('".$_POST['customer_order']."','".$_POST['amount_for_bill']."',$company_id)")){
                $message=alertSuccess();
  }else{
    $message=alertError();
  }
   

            }
     ?>
        <!-- right column -->
        <div class="col-md-12">
          <?php echo $message;?>
          <!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Showing customer orders delivered</h3>
            </div>
            <div class="box-header with-border">
            <div class="row form-group">
            <form method="POST" action="">
            <div class="col-xs-4 pull-left">
                        <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa ">Service category</i>
                      </div>
                      <select  class="form-control select2 " name="service_type"  style="width: 100%;">
                      <option>Select</option>
                      <?php
                        $query_service=mysqli_query($conn,"SELECT * FROM services WHERE idsettings = $company_id");
                          while($row=mysqli_fetch_array($query_service)){
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
                  <th class="text-blue"><small>Sevice cost</small></th>
                  <th class="text-blue"><small>Cash paid</small></th>
                  <th class="text-blue"><small>Balance</small></th>
                  <th class="text-blue"><small>Customer</small></th>
                  <th class="text-blue"><small>Telephone</small></th>
                  <th class="text-blue" style="width: 60px;"><small>Action</small></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                $clear_bill = '';

                if(isset($_POST['search'])){ // search specific data
              $idservice = $_POST['service_type'];
              $date_from = $_POST['date_from'];
              $date_to = $_POST['date_to'];
              $date_from = $date_from.' 00:00:00'; //format the date to timestamp
              $date_to = $date_to.' 23:59:59'; //format date to timestamp
               $query=mysqli_query($conn,"SELECT * FROM assign_order a, customer_order o,services s, customer c WHERE a.idorder = o.idorder AND a.idcustomer = c.idcustomer AND o.idcustomer = c.idcustomer AND o.idservice = s.idservice AND s.idservice =$idservice AND o.order_date BETWEEN '".$date_from."' AND '".$date_to."' AND a.idsettings = $company_id AND o.order_status = 'Taken'");
            }else{  // retrieve all data 
            $query=mysqli_query($conn,"SELECT * FROM assign_order a, customer_order o,services s, customer c WHERE a.idorder = o.idorder AND a.idcustomer = c.idcustomer AND o.idcustomer = c.idcustomer AND o.idservice = s.idservice AND a.idsettings = $company_id AND o.order_status = 'Taken'");
          }
                    while($row=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['idorder'];?></td>
                        <td><?php echo $row['order_date'];?></td>
                        <td><?php echo $row['service_name'];?></td>
                        <td><?php echo $row['order_quantity'];?></td>
                        <?php 
                          $quantity = $row['order_quantity'];
                          $total_cost =  $quantity * getServicePrice('services','service_price','idservice',$row['idservice']);
                          $cash_paid = getSum('order_payment','cash_pay','idorder', $row['idorder']);
                          $balance = $total_cost -$cash_paid;
                          if($balance > 0){
                            $clear_bill = '<a data-toggle="modal" href="#order-assign-form'. $row['idorder'].'" class="btn btn-primary pull-left">Clear Bill</a>';
                          }
                        ?>
                        <td><?php echo $total_cost;?></td>
                        <td><?php echo $cash_paid;?></td>
                        <td><?php echo $balance ;?></td>
                        <td><?php echo $row['fname'].' '.$row['lname'];?></td>
                        <td><?php echo $row['telephone'];?></td>
                        <td><?php echo $clear_bill; ?></td>
                        <div class="modal modal-default fade" id="order-assign-form<?php echo $row['idorder'];?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">Bill Payment Form</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Customer Name</label>
                                <input type="text" class="form-control" name="amount_for_bill" value="<?php echo $row['fname'].' '.$row['lname'];?>" >
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-3">
                                <label class="text-info">Sevice ordered</label>
                                <input type="text" class="form-control" name="amount_for_bill" value="<?php echo $row['service_name'];?>" >
                            </div>
                            <div class="col-xs-3">
                                <label class="text-info">Quantity</label>
                                <input type="text" class="form-control" name="amount_for_bill" value="<?php echo $row['order_quantity'];?>" >
                            </div>
                            <div class="col-xs-3">
                                <label class="text-info">Cost</label>
                                <input type="text" class="form-control" name="amount_for_bill" value="<?php echo $total_cost;?>" >
                            </div>
                            <div class="col-xs-3">
                                <label class="text-info">Cash paid</label>
                                <input type="text" class="form-control" name="amount_for_bill" value="<?php echo $cash_paid;?>" >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-12">
                              <input type="hidden" name="customer_order" value="<?php echo $row['idorder'];?>">
                                <label class="text-info">Amount</label>
                                <input type="number" class="form-control" name="amount_for_bill" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_bill" class="btn btn-success btn-md">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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
