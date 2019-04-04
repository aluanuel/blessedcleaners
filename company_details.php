<?php 
  include 'system_session.php';
  include 'connection.php';
  include 'config.php';
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
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <?php include('system_menu.php');?>
    
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
            
            <!-- /.box-header -->
            <!-- form start -->
        <?php
        $query=mysqli_query($conn,"SELECT s.companyName,s.companyAddress,s.companyTelephone,DATEDIFF(s.license,now()) as license, c.fname,c.lname,c.telephone as admin_tel,c.email,c.username FROM settings s,users c WHERE c.username = '$user' AND c.idsettings=s.idsettings");
        //echo $query;
        while($row=mysqli_fetch_array($query)){
          $co_name=$row['companyName'];
          $co_address=$row['companyAddress'];
          $co_telephone=$row['companyTelephone'];
           $co_license=$row['license'];
          $fname=$row['fname'];
          $lname=$row['lname'];
          $telephone=$row['admin_tel'];
          $mail=$row['email'];
        }
         ?>

        <div class="example-modal">
        <div class="modal modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Company Registration Details</h4>
              </div>
              <div class="modal-body">
              <div class="row">
                <div class="col-sm-6 pull-left"><p>Company Name: <strong><?php echo $co_name;?></strong></p></div>
                <div class="col-sm-6 pull-right"><p>Physical Address: <strong><?php echo $co_address;?></strong></p></div>
              </div>
              <div class="row">
                <div class="col-sm-6 pull-left"><p>Telephone: <strong>0<?php echo $co_telephone;?></strong></p></div>
                <div class="col-sm-6 pull-right"><p>License Duration: <strong><?php echo $co_license;?></strong> days remaining</p></div>
              </div>
              <div class="row">
                <div class="col-sm-6 pull-left"><p>Administrator: <?php echo $fname.' '.$lname;?></p></div>
                <div class="col-sm-3 "><p><?php echo $telephone;?></p></div>
                <div class="col-sm-3 pull-right"><p><?php echo $mail;?></p></div>
              </div>
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      <!-- /.example-modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include'footer.php';?>
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
  })
</script>
</body>
</html>
