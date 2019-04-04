<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php include 'header.php';
$company_name= 'EasyInventory'
?>
<body class="hold-transition login-page">
<?php
    include 'connection.php';
    if(isset($_POST['submit'])){
      $name= $_POST['user']; // get username
      $password= md5($_POST['pass']); // get password and encrypt using md5() encryption function
    $result = mysqli_query($conn,"SELECT c.usertype,c.username,DATEDIFF(s.license,NOW()) AS license FROM users c,settings s WHERE c.username='$name' AND c.password='$password' AND c.user_account_status='active' AND c.idsettings=s.idsettings"); // checks user login details with corresponding user information in the database. Also checks if the license has expired or not using DATEDIFF() function
     $row = mysqli_num_rows($result);
     if($row == 1){
    $row=mysqli_fetch_array($result);
      $cat=$row['usertype'];
      $time=$row['license'];
      $company_name=$row['companyName'];
      if($time>=0){//check for license validity

      if($cat=='admin'){ // checks if user is an admin
        $_SESSION['admin']=$row['username']; // creates a session for admin
        if($password==""){
          header('location: admin_profile.php'); // redirects to admin homepage
        }else{
        header('location: admin_panel.php');
        }
        
      }
      else if($cat=='system_admin'){ // checks if user is system admin
        $_SESSION['system_admin']=$row['username'];
        if($password==""){
          header('location: system_profile.php');
        }else{
        header('location: system_panel.php');
        }
      }
      else if($cat=='receptionist'){ // checks if user is a receptionist
        $_SESSION['receptionist']=$row['username'];
        if($password==""){
          header('location: receptionist_profile.php'); // redirects to receptionist homepage
        }else{
        header('location: receptionist_panel.php');
        }
      }
      else if($cat=='cleaner'){  // checks if user is a cleaner(washman)
        $_SESSION['cleaner']=$row['username'];
        if($password==""){
          header('location: cleaner_profile.php'); // redirects to cleaner(washman) homepage
        }else{
        header('location: cleaner_panel.php');
        }
      }
      else{
        header('location:index.php');
      }
     }else{
        echo "License expired.Please renew license";
      }
    }
  }
?>
<div class="login-box">
  <div class="login-logo">
    <div class="text-center">
         <img src="dist/img/logoInventory.png" alt="User Image">
        </div>
    <b>Blessed</b><a href=""> cleaners</a> Ltd
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="pass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="custom/password_reset.php">Forgot password?</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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
