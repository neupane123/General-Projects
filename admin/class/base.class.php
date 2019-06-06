<?php

Class Base {

	protected $con;

	function __construct(){
		@$con = mysqli_connect('localhost','root','','ujit');
		if(!$con)
		{
			die("<strong>Database Connection Error : </strong>".mysqli_connect_error());
		}
		return $this->con = $con;
	}
	
	function set($var,$value) {
		$this->$var=$value;
	}

	function get($var) {
		return $this->$var;
	}

	
}



?>