<?php
function licenseDuration($id){
	include 'connection.php';
$query=mysqli_query($conn,"SELECT DATEDIFF(license,date(now())) as license FROM settings WHERE idsettings = $id");
	$row=mysqli_fetch_array($query) ;
	return $row['license'];
}
function getProfileImage($user){
	include 'connection.php';
$query=mysqli_query($conn,"SELECT userimage FROM users WHERE username = '$user'");
if(mysqli_num_rows($query)<=0){
	return 'No Image';
}else{
	$row=mysqli_fetch_array($query) ;
	return $row['userimage'];
}
}
function getCompanyName($user){
	include 'connection.php';
$query=mysqli_query($conn,"SELECT * FROM settings s, users u  WHERE u.idsettings = s.idsettings AND u.idusers = '$user'");
if(mysqli_num_rows($query)==0){
	return 'No Company Found';
}else{
	$row=mysqli_fetch_array($query) ;
	return $row['companyName'];
}
}

function getCompanyId($user){
	include 'connection.php';
$query=mysqli_query($conn,"SELECT * FROM settings s, users u  WHERE u.idsettings = s.idsettings AND u.idusers = '$user'");
if(mysqli_num_rows($query)==0){
	return 'No Company Found';
}else{
	$row=mysqli_fetch_array($query) ;
	return $row['idsettings'];
}
}

function getLastCustomerId($table,$id){
	include 'connection.php';
	// $id = '';
	$query = mysqli_query($conn,"SELECT MAX($id) as idcustomer FROM $table");
	if(mysqli_num_rows($query)>0){
		$row = mysqli_fetch_array($query);
		return $row[$id];
	}
	// return $row['idcustomer'];
}

function getServicePrice($table,$price_column,$where_column, $service_id){
	include 'connection.php';
	$query = mysqli_query($conn,"SELECT $price_column AS price FROM $table WHERE $where_column = $service_id");
	if(mysqli_num_rows($query)>0){
		$row = mysqli_fetch_array($query);
		return $row['price'];
	}else{
		return 0;
	}

}

function getSum($table,$price_column,$where_column, $service_id){
	include 'connection.php';
	$query = mysqli_query($conn,"SELECT SUM($price_column) AS amount FROM $table WHERE $where_column = $service_id");
	if(mysqli_num_rows($query)>0){
		$row = mysqli_fetch_array($query);
		return $row['amount'];
	}else{
		return 0;
	}

}
function getCountResult($table,$column_count,$where){
 	include 'connection.php';
 	$query = mysqli_query($conn,"SELECT count($column_count) AS total FROM $table WHERE $where");
 	if(mysqli_num_rows($query)>0){
		$row = mysqli_fetch_array($query);
		return $row['total'];
	}
 }

 function getWorkload($where){
 	include 'connection.php';
 	$query = mysqli_query($conn,"SELECT count(idassign_order) AS workload FROM assign_order a, customer_order d WHERE $where");
 	if(mysqli_num_rows($query)>0){
		$row = mysqli_fetch_array($query);
		return $row['workload'];
	}
 }
 function renameUploadedFile($filename,$file_ext){
        $file = array();

          $file =explode('.',$filename);
          $new_file_name =$file[0].'-'.date('H-i-s').'.'.$file_ext;
          return $new_file_name;
    }
function alertSuccess(){
	return '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4 class="text-center">Success</h4>
              </div>';
}
function alertError(){
	return '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4 class="text-center">Oops, something went wrong</h4>
              </div>';

}