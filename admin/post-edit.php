<?php
		$title = "Post-Edit";
		require_once "header.php";
		require_once "class/formValidation.class.php";
		$validation = new FormValidation;

		$sql = "select * from post where id={$_GET['id']}";
		$res = $validation->get('con')->query($sql);
		if($res && $res->num_rows==1)
		{
			$data = $res->fetch_assoc();
		}


		if( (in_array('author',explode(',' , $_SESSION['role'])) && $data['created_by'] == $_SESSION['name']) || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor')
		{//---------------


		if(isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) )
		{
			$id= $_GET['id'];

			if(isset($_POST['btnUpdate']))
			{
					
					$err = [];

					if(isset($_POST['category']) && !empty($_POST['category']) && $_POST['category'] !=' ')
					{
							$category = $validation->sanitize($_POST['category']);
					}else{
							$err['category'] = "category is required";
					}


					if(isset($_POST['title']) && !empty($_POST['title']) && $_POST['title'] !=' ')
					{
							$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
							$title = $validation->get('con')->real_escape_string($title);
					}else{
							$err['title'] = "post title is required";
					}

					if(isset($_FILES['image']) && $_FILES['image']['error']==0) {

						$finfo = finfo_open(FILEINFO_MIME_TYPE);
						$mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
						if($mime=="image/jpeg" || $mime=="image/jpg" || $mime=="image/png" || $mime=="image/pjpeg" )
						{
							$image = $_FILES['image']['name'];
							$image = str_replace(" ", "-", $image);
						}else{
							$err['image']="please select an jpeg/png image of size less than 2MB";
						}
					}

					if(isset($_POST['description']) && !empty($_POST['description']) && $_POST['description'] !=' ')
					{
							// $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
							// $description = $validation->sanitize($_POST['description']);
							$description = $validation->get('con')->real_escape_string($_POST['description']);
					}else{
							$err['description'] = "post description is required";
					}

					if(isset($_POST['status']) && ($_POST['status']==0 || $_POST['status']==1) )
					{
						$status = $_POST['status'];
					}else{
						$err['status'] = "please provide either boolean 0 or 1 as status";
					}



					if(count($err)==0) {

						$sql = "select feature_image from post where id=$id";
						$res = $validation->get('con')->query($sql);
						if($res && $res->num_rows==1)
						{
							$Oldimage = $res->fetch_assoc();
							$Oldimage = (isset($Oldimage['feature_image']) && !empty($Oldimage['feature_image'])) ? $Oldimage['feature_image'] : '';
						}

						//----------if new image is updated--------------------
						if(isset($image)){

							$sql = "update post set post_cat='$category', post_title = '$title', feature_image = '$image', post_description = '$description', status=$status where id=$id";
							$resp = $validation->get('con')->query($sql);
							if($resp){
								$imgToRemove = "images/$Oldimage";
								if(file_exists($imgToRemove)){
									unlink($imgToRemove);
								}
								move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");
								echo "<script>alert('post updated !')</script>";
							}	


						}else{
						//---------------------if image is not updated----------------------------

							$sql = "update post set post_cat='$category', post_title = '$title', post_description = '$description', status=$status where id=$id";
							$resp = $validation->get('con')->query($sql);

							if($resp){
								echo "<script>alert('post updated !')</script>";
							}else{
								echo "<script>alert('failed !')</script>";
							}	
						}

					}

					

			}




			$sql = "select * from post where id=$id";
			$res = $validation->get('con')->query($sql);
			if($res && $res->num_rows==1)
			{
				$data = $res->fetch_assoc();
			}

		}
		
		if(isset($data) && !empty($data))
		{
	//---------------start of !empty($dat) block-----------

?>	



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      New Post
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>
      <li><a href="<?php echo base_url();?>category-add.php">Category</a>
      </li>
      <li><a href="<?php echo base_url();?>category-add.php">New</a>
      </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
		<div class="box-header with-border">
		<h3 class="box-title">Create Post</h3>

		<div class="box-tools pull-right">
		  <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>category-add.php">All Categories</a>
		</div>
		</div>
		<div class="box-body">
	        <div class="col-lg-6">
	            <form role="form" action="" method="post" enctype="multipart/form-data">
	                <div class="form-group">
	                    <label for="category">Select Category</label>
	                    <select name="category" class="form-control">
	                    	<option value="<?php echo !empty($data['post_cat']) ? $data['post_cat'] : '';?>"><?php echo $data['post_cat'];?></option>
	                    	<?php
	                    		$sql="select * from category where status=1 order by rank asc";
	                    		$res = $validation->get('con')->query($sql);
	                    		if($res && $res->num_rows>0){
	                    			while($row=$res->fetch_assoc())
	                    			{
	                    				echo "<option>".$row['name']."</option>";
	                    			}
	                    		}
	                    	?>
	                    </select>
	                    <?php echo 
	                    (isset($err['category']))?"<span class='error'>".$err['category']."</span>":""; ?>
	                </div>
					
					<div class="form-group">
					    <label for="title">Title</label>
					    <input type="text" class="form-control" name="title" value="<?php echo !empty($data['post_title']) ? $data['post_title'] : '';?>" required>
					    <?php echo 
	                    (isset($err['title']))?"<span class='error'>".$err['title']."</span>":""; ?>
					</div>

					<div class="form-group">
					    <label for="image">Fetaure Image</label>
					    <?php if(!empty($data['feature_image'])){?>
					    	<img src="images/<?php echo $data['feature_image'];?>" width="100px" height="100px">
					    <?php } ?>
					    <input type="file" class="form-control" name="image">
					    <?php echo 
	                    (isset($err['image']))?"<span class='error'>".$err['image']."</span>":""; ?>
					</div>

					<div class="form-group">
					    <label for="description">Description</label>
					    <textarea class="form-control" name="description" rows=5 required><?php echo  !empty($data['post_description']) ? $data['post_description'] : '';?></textarea>
					    <?php echo 
	                    (isset($err['description']))?"<span class='error'>".$err['description']."</span>":""; ?>
					</div>


					<div calss="form-group">
						<label>Status</label>

						<?php if($data['status']==1){?>

						<input type="radio" name="status" checked="" value="1"> Active
						<input type="radio" name="status" value="0"> InActive

						<?php } else { ?>

						<input type="radio" name="status"  value="1"> Active
						<input type="radio" name="status" checked="" value="0"> InActive

						<?php } ?>
					</div>
	             
	                <button type="submit" class="btn btn-success" name="btnUpdate">Update Post</button>
	                
	            </form>
	        </div>
			<!-- /.col-lg-g -->
		</div>
		<!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->


  </section>
  <!-- /.content -->
</div>


<?php } ?>

<?php }//roles based edit closing-------------- ?>
<!-- ----------------end of !empty($data) block------------- -->
<?php require_once "footer.php"; ?>

