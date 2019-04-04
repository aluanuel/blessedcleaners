<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include '../title.php';
    $recovery_status='all';
    $password_status='none';
    $error='';
  ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="icon" type="../image/png" href="..dist/img/logoInventory.png"/>
</head>
<?php
  include '../connection.php';
  $user_id=0;
  if(isset($_POST['submit'])){
    $username=$_POST['user'];
    $phone=$_POST['phone'];
    $query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND telephone='$phone'") or die(mysqli_error($conn));
    if(mysqli_num_rows($query) > 0){
      $row = mysqli_fetch_array($query);
      $user_id =$row['idusers'];
      $recovery_status='none';
        $password_status='all';
    }else{
      $recovery_status='all';
        $password_status='none';
        $error = "Wrong username or telephone number";
    }
  }elseif(isset($_POST['save'])){
    $pass1=md5($_POST['password1']);
    $pass2=md5($_POST['password2']);
    $user_id=$_POST['user_id'];
    if($pass1 != $pass2){
      $error = "Password mismatch, enter same password in both fields";
      $recovery_status='none';
        $password_status='all';
    }else{
      $query = mysqli_query($conn,"UPDATE users SET password ='$pass1' WHERE idusers = $user_id") or die(mysqli_error($conn));
      header('location: ../index.php');
    }
  }
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <div class="text-center">
         <img src="../dist/img/logoInventory.png" alt="User Image">
        </div>
    <b>Blessed</b><a href=""> cleaners</a> Ltd
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" id="recovery">Account recovery</p>
    <p class="login-box-msg" id="password_reset">New password setup</p>
<p class="login-box-msg text-danger" id="password_reset_error"><?php echo $error;?></p>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user" id="recovery" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="phone" id="recovery" placeholder="Telephone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input type="hidden" class="form-control" name="user_id" id="password_reset" value="<?php echo $user_id;?>">
        <input type="password" class="form-control" name="password1" id="password_reset" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback" id="password_reset"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password2" id="password_reset" placeholder="Password again">
        <span class="glyphicon glyphicon-lock form-control-feedback" id="password_reset"></span>
      </div>

      <div class="row">
        <div class="col-xs-4">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat" id="recovery">Submit</button>
          <button type="submit" name="save" class="btn btn-primary btn-block btn-flat" id="password_reset">Save</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<style type="text/css">
  #password_reset{
    display: <?php echo $password_status;?>;
  }
  #recovery{
    display: <?php echo $recovery_status;?>;
  }
</style>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
