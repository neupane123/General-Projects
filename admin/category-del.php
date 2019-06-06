<?php
	@session_start();
	require_once "class/formValidation.class.php";
	$validation = new FormValidation;


	// if(isset($_COOKIE['username'])) {
	// 	$_SESSION['username'] = $_COOKIE['username'];
	// }

	if(!isset($_SESSION['username'])) {
		header("location:index.php?auth=0");
		exit();
	}

	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT))
	{
		$id = $_GET['id'];
		$sql = "delete from category where id=$id";
		$resp = $validation->get('con')->query($sql);
		if($resp) {
			echo "<script>alert('deleted');window.location='category-add.php';</script>";
		}else{
			echo "<script>alert('failed !');window.location='category-add.php';</script>";
		}

	}
?>