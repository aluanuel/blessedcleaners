<?php
include 'connection.php';
    $sql2=mysqli_query($conn, "SELECT count(*) as users from users WHERE status='active'");
     $row2=mysqli_fetch_array($sql2);
     $sysUsers=$row2['users'];
?>