<!DOCTYPE html>
<html>
<?php 
include'admin_session.php';
$user=$_SESSION['admin'];
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
      <?php include'admin_menu.php';?>
          </section>
    <!-- /.sidebar -->
  </aside>
<?php
if(isset($_POST['submit'])){


  $file_name = $_FILES['userphoto']['name']; //get the file name for the photo
  $file_tmp = $_FILES['userphoto']['tmp_name']; 
  $url='';
    if (!empty($file_name)) {
          $file_ext = strtolower(substr($file_name, strpos($file_name, '.') + 1)); // check the file extension ie .png,jpeg or jpg
          $new_file_name = renameUploadedFile($username, $file_ext); //rename file uploaded
          move_uploaded_file($file_tmp, "uploads/profile_photos/" . $new_file_name); // move file to a new location on the server
          $url = 'uploads/profile_photos/' . $new_file_name; // directory of the file on the server
  }else{
    $url = 'uploads/profile_photos/default.png'; // directory of the file on the server if no file is uploaded
  }
	if(mysqli_query($conn,"INSERT INTO users(fname,lname,telephone,email,usertype,username,password,userimage,idsettings,user_account_status) VALUES('".$_POST['fname']."','".$_POST['lname']."','".$_POST['phone']."','".$_POST['email']."','".$_POST['usertype']."','".$_POST['username']."','".md5($_POST['phone'])."','$url',$company_id,'Active')")){
		$message=alertSuccess();
	}else{
		$message=alertError();
	}
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        System users
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New user > <?php echo date("Y-m-d");?></li>
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
              <h3 class="box-title">New user</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
              <div class="box-body">
              <div class="row">
                <div class="col-xs-6 form-group">
                <label class="text-primary">First Name</label>
                  <input type="text" class="form-control" name="fname" required placeholder="Enter first name">
                </div>
                <div class="col-xs-6 form-group">
                <label class="text-primary">Other Name</label>
                  <input type="text" class="form-control" name="lname" required placeholder="Enter other name">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                <label class="text-primary">Telephone</label>
                  <input type="text" class="form-control" name="phone" required placeholder="Enter telephone">
                </div>
                <div class="col-xs-6 form-group">
                <label class="text-primary" for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                <label class="text-primary">User type</label>
                <select class="form-control select2" name="usertype" required style="width: 100%;">
                  <option >Select</option>
                  <option value="admin">Administrator</option>
                  <option value="receptionist">Receptionist</option>
                  <option value="cleaner">Cleaner</option>
                </select>
                </div>
                <div class="col-xs-6 form-group">
                <label class="text-primary">Username</label>
                  <input type="text" class="form-control" name="username" required placeholder="Enter username">
                </div>
              </div>
                <div class="form-group">
                  <label class="text-primary" for="exampleInputFile">Upload photo</label>
                  
                  <input type="file" name="userphoto" id="exampleInputFile">
                  <span class="text-danger"><?php echo $error;?></span>
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
  })
</script>
</body>
</html>
