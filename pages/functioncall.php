<?php
  require_once('connection.php');
  require_once('functions.php');
  GLOBAL $sql;
  /*============creating object of the connection class=============*/
  $database = new Database();
  $conn = $database->getConnection();
  /*=============end connection====================================*/
  /*==================================creating objects===========================*/
  $student =new Student($sql);

  /*==================================end=======================================*/
  $student->newStudent($conn,$_POST['name1'],$_POST['name2'],$_POST['sex'],$_POST['birthday'],$_POST['st_class'],$_POST['st_parent'],$_POST['tel']);
  ?>