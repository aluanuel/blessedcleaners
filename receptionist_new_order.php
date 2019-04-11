<!DOCTYPE html>
<html>
<?php 
include'receptionist_session.php';
  $user=$_SESSION['receptionist'];
include 'header.php';
$error='';
          $message='';

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
<?php
if(isset($_POST['submit'])){
  $existing_customer_id = $_POST['existing_customer'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $telephone = $_POST['phone'];
  $email = $_POST['email'];
  $quantity = $_POST['quantity'];
  $service_id = $_POST['service'];

  if(!empty($fname) || !empty($lname)){ // if customer is new, then the code below is execuuted

	if(mysqli_query($conn,"INSERT INTO customer(fname,lname,telephone,email,username,password) VALUES('$fname','$lname','$telephone','$email','$fname','md5($fname)')")){
    $existing_customer_id = getLastCustomerId('customer','idcustomer');
    mysqli_query($conn,"INSERT INTO customer_order(order_quantity,order_status,idcustomer,idservice,idsettings) VALUES('$quantity','Pending','$existing_customer_id','$service_id',$company_id)");
		$message=alertSuccess();
	}else{
		$message=alertError();
	}
}else{ 
  if(mysqli_query($conn,"INSERT INTO customer_order(order_quantity,order_status,idcustomer,idservice,idsettings) VALUES('$quantity','Pending','$existing_customer_id','$service_id',$company_id)")){
  $message=alertSuccess();
  }else{
    $message=alertError();
  }
}
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customer orders
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Make order > <?php echo date("Y-m-d");?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <?php echo $message;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New order</h3>
            </div>
            <!-- /.box-header -->
            <?php
            $query_services = mysqli_query($conn,"SELECT * FROM services WHERE idsettings=$company_id");
            $query_customer = mysqli_query($conn,"SELECT * FROM customer");
            ?>
            <!-- form start -->
            <form role="form" action="" method="POST">
              <div class="box-body">
              <div class="row">
                <div class="col-xs-6 form-group">
                <label class="text-primary">Select Service</label>
                <select class="form-control select2" name="service" required style="width: 100%;">
                  <option >Select</option>
                  <?php 
                    if(mysqli_num_rows($query_services)>0){
                      while($row = mysqli_fetch_array($query_services)){

                  ?>
                  <option  value="<?php echo $row['idservice']?>"><?php echo $row['service_name'].' '.$row['service_price'];?></option>
                  <?php

                      }
                    }
                  ?>
                </select>
                </div>
                <div class="col-xs-6 form-group">
                <label class="text-primary">Quantity</label>
                  <input type="number" class="form-control" name="quantity" required placeholder="Enter Quantity" autocomplete="off">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3 form-group">
                  <label class="text-primary">
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                      New Customer
                    </label>
                </div>
                <div class="col-xs-3 form-group">
                  <label class="text-primary">
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Existing Customer
                    </label>
                </div>
              </div>
              <div class="row" id="new_customer">
                <div class="col-xs-3 form-group">
                <label class="text-primary">First Name</label>
                  <input type="text" class="form-control" name="fname"  placeholder="Enter first name">
                </div>
                <div class="col-xs-3 form-group">
                <label class="text-primary">Other Name</label>
                  <input type="text" class="form-control" name="lname"  placeholder="Enter other name">
                </div>
                <div class="col-xs-3 form-group">
                <label class="text-primary">Telephone</label>
                  <input type="text" class="form-control" name="phone"  placeholder="Enter telephone">
                </div>
                <div class="col-xs-3 form-group">
                <label class="text-primary" for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                </div>
              </div>
              <div class="row" id="existing_customer">
                <div class="col-xs-12 form-group">
                <label class="text-primary">Select Customer</label>
                <select class="form-control select2" name="existing_customer" required style="width: 100%;">
                  <option>Select</option>
                  <?php 
                    if(mysqli_num_rows($query_customer)>0){
                      while($row = mysqli_fetch_array($query_customer)){

                  ?>
                  <option  value="<?php echo $row['idcustomer']?>"><?php echo $row['fname'].' '.$row['lname'].' '.$row['telephone'];?></option>
                  <?php

                      }
                    }
                  ?>
                </select>
                </div>
              </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

  ////// custom codes by blessed cleaners team///////////////////////////////
    $(document).ready( function(){ //// when page loads, hide fields for new and existing customers
    $('#new_customer').hide();
    $('#existing_customer').hide();
  })
    $('#optionsRadios2').click(function(){ // when new customer selected, show new customer fields.
      $('#new_customer').hide();
      $('#existing_customer').show();
    })
    $('#optionsRadios1').click(function(){ // when existing customer selected, show existing customer field
      $('#existing_customer').hide();
      $('#new_customer').show();
    })
  })
</script>
</body>
</html>
