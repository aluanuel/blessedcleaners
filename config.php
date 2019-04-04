<?php
	
	class companyName {

		var $org_name;

		function __construct($name)
		{
			$this -> org_name=$name;
		}

		function getName(){

			return $this-> org_name;
		}
	}
	/**
	* 
	*/
	class Messages{
		
		var $text;
		
		function alerts($message){

			return $this-> text=$message;

		}
	}
?>