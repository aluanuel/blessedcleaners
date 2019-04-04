<?php
/*
*********************Database class*****************************************************
*/
class Database{
	
	public $conn;
	function __construct(){
		//create connection
	}
	public function getConnection(){
		$servername="localhost";
		$username="root";
		$password="";
		$dbname="school_db";

		$this -> conn = null;

		try{
			$this -> conn = new mysqli($servername,$username,$password,$dbname);
		}catch(mysqli_sql_exception $e){
			$error = $e->connect_error;
			echo $error;
		}
		return $this -> conn;
		}
	}

?>
