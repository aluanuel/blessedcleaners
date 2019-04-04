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
        <li class="active">Registered Accounts > <?php echo date("Y-m-d");?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <?php
            $query=mysqli_query($conn,"SELECT * FROM settings s, users u WHERE u.idsettings = s.idsettings AND u.usertype='admin'");
     ?>
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-primary">
           <div class="box-header">
            <h3 class="box-title">Registered Company Accounts</h3>
            </div>
            <div class="box-header">
            <div class="row form-group">
            <form method="POST" action="">
            <div class="col-xs-4 pull-left">
                        <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa ">Category</i>
                      </div>
                      <select  class="form-control select2 " name="particulars"  style="width: 100%;">
                      <option>Select</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                
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
                <form method="POST" action="print_sales_report.php" target="_blank">
                 <div class="col-xs-1">
                  <button type="submit" name="search" class="btn btn-default" >Export</button>
                </div> 
                </form>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-blue"><small>ID</small></th>
                  <th class="text-blue"><small>Company</small></th>
                  <th class="text-blue"><small>Address</small></th>
                  <th class="text-blue"><small>Telephone</small></th>
                  <th class="text-blue"><small>Email</small></th>
                  <th class="text-blue"><small>Admin Name</small></th>
                  <th class="text-blue"><small>Admin Telephone</small></th>
                  <th class="text-blue"><small>Admin Email</small></th>
                  <th class="text-blue"><small>Account Status</small></th>
                  <th class="text-blue"><small>License(days)</small></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                while ($row = mysqli_fetch_array($query)) {
                  echo '<tr>';
                  echo '<td>'.$i.'</td>';
                  echo '<td>'.$row['companyName'].'</td>';
                  echo '<td>'.$row['companyAddress'].'</td>';
                  echo '<td>'.$row['companyTelephone'].'</td>';
                  echo '<td>'.$row['companyEmail'].'</td>';
                  echo '<td>'.$row['fname'].' '.$row['lname'].'</td>';
                  echo '<td>'.$row['telephone'].'</td>';
                  echo '<td>'.$row['email'].'</td>';
                  echo '<td>'.$row['status'].'</td>';
                  echo '<td>'.licenseDuration($row['idsettings']).'</td>';
                  echo '</tr>';
                  $i++;
                }
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
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
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
