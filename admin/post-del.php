<?php
	@session_start();
	require_once "class/formValidation.class.php";
	$validation = new formValidation;

	if(!isset($_SESSION['username'])) {
		header("location:index.php?auth=0");
		exit();
	}

	if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT))
	{
		$id = $_GET['id'];
		$sql = "select feature_image from post where id=$id";
		$res = $validation->get('con')->query($sql);

		if($res && $res->num_rows==1)
		{
			$image = $res->fetch_assoc();
			$image = $image['feature_image'];
		}

		$sql = "delete from post where id=$id";
		$resp = $validation->get('con')->query($sql);
		if($resp) {
			
			if(isset($image) && !empty($image) ){
				$file = "images/$image";
				if(file_exists($file)){
					unlink($file);
				}
			}
			echo "<script>alert('deleted');window.location='post-add.php';</script>";
		}else{
			echo "<script>alert('failed !');window.location='post-add.php';</script>";
		}

	}

?>