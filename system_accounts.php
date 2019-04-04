<?php 
  include 'system_session.php';
  $user=$_SESSION['system_admin'];
?>
<!DOCTYPE html>
<html>
<?php include 'header.php';?>
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
      <?php include('system_menu.php');?>
    
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accounts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Company Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <?php
        if(isset($_POST['submit'])){
          $name=$_POST['name'];
          $addr=$_POST['address'];
          $tel=$_POST['telephone'];
          $email=$_POST['email'];
          $license=$_POST['license'];
          $license_fee=$_POST['license_fee'];
          $sql="INSERT INTO settings(companyName,companyAddress,companyTelephone,companyEmail,license_fee,license,status) VALUES('$name','$addr','$tel','$email','$license_fee','$license','Active')";
          if(mysqli_query($conn,$sql)){

        $query=mysqli_query($conn,"SELECT idsettings FROM settings WHERE companyName='$name'");

        $row=mysqli_fetch_array($query);

        $id =$row['idsettings'];

        $sql=mysqli_query($conn,"INSERT INTO users(fname,lname,telephone,email,usertype,username,password,idsettings,user_account_status) VALUES('".$_POST['fname']."','".$_POST['lname']."','".$_POST['admin_telephone']."','".$_POST['admin_email']."','admin','".$_POST['username']."','".md5($_POST['admin_telephone'])."','$id','Active')") or die(mysqli_error($conn));
        }
        }
        ?>
        <form  action="" name="userform" method="POST">
           <div class="box-body">
              	<div class="row form-group col-xs-12 col-sm-12">
			        <div class="input-group col-xs-12 col-sm-5 pull-left">
			          <span class="input-group-addon">Company Name</span>
			          <input type="text" class="form-control" id="fname" name="name" placeholder="Company Name...">
			        </div>
			        <div class="input-group col-xs-12 col-sm-5 pull-right">
			          <span class="input-group-addon">Physical Address</span>
			          <input type="text" class="form-control" id="lname" name="address" placeholder="Company Address...">
       				</div>
        		</div>
        		<div class="row form-group col-xs-12 col-sm-12">
			        <div class="input-group col-xs-12 col-sm-5 pull-left">
			          <span class="input-group-addon">Telephone Number</span>
          				<input type="text" class="form-control" id="lname" name="telephone" placeholder="Telephone Number...">
			        </div>
			        <div class="input-group col-xs-12 col-sm-5 pull-right">
			          <span class="input-group-addon">Email Address</span>
			          <input type="email" class="form-control" id="lname" name="email" placeholder="Email Address...">
       				</div>
        		</div>
        		<div class="row form-group col-xs-12 col-sm-12">
        			<div class="input-group col-xs-12 col-sm-5 pull-left">
			          <span class="input-group-addon">License Fee</span>
          			<input type="number" class="form-control" id="dob" name="license_fee" placeholder="Cash.."/>
       				</div> 
			        <div class="input-group col-xs-12 col-sm-5 pull-right">
			          <span class="input-group-addon">License duration</span>
          			<input type="date" class="form-control" id="dob" name="license" placeholder="YY-MM-DD"/>
       				</div>
        		</div>
        		<div class="box-header with-border">
              <h3 class="box-title">Admin Details</h3>
            </div>
        		<div class="row form-group col-xs-12 col-sm-12">
			        <div class="input-group col-xs-12 col-sm-5 pull-left">
			          <span class="input-group-addon">First Name</span>
          			<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name...">
			        </div>
			        <div class="input-group col-xs-12 col-sm-5 pull-right">
			          <span class="input-group-addon">Other Name</span>
          				<input type="text" class="form-control" id="lname" name="lname" placeholder="Other Name...">
       				</div>
        		</div>
            <div class="row form-group col-xs-12 col-sm-12">
              <div class="input-group col-xs-12 col-sm-5 pull-left">
                <span class="input-group-addon">Telephone Number</span>
                  <input type="text" class="form-control" id="lname" name="admin_telephone" placeholder="Telephone Number...">
              </div>
              <div class="input-group col-xs-12 col-sm-5 pull-right">
                <span class="input-group-addon">Email Address</span>
                <input type="email" class="form-control" id="lname" name="admin_email" placeholder="Email Address...">
              </div>
            </div>
            <div class="row form-group col-xs-12 col-sm-12">
              <div class="input-group col-xs-12 col-sm-5 pull-left">
                <span class="input-group-addon">Username</span>
                  <input type="text" class="form-control" id="lname" name="username" placeholder="Admin username...">
              </div>
            </div>      
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="col-md-4 pull-left"></div><input type="submit" class="btn btn-primary " name="submit" value="Activate Account"  />
              </div>
            </form>
          </div>
    </div>
        
          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include'footer.php';?>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
  $(function(){
     $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
</body>
</html>
