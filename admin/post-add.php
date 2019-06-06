<?php
		
		$title = "Post";
		require_once "header.php";
		$validation = new FormValidation;

		if(isset($_POST['btnSave']))
		{
			$err=[];

			if(isset($_POST['category']) && !empty($_POST['category']) && $_POST['category'] !=' ')
			{
					$category = $validation->sanitize($_POST['category']);
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
					$description = $_POST['description'];
					$description = $validation->get('con')->real_escape_string($description);
			}else{
					$err['description'] = "post description is required";
			}


			if(isset($_POST['status']) && ($_POST['status']==0) || $_POST['status']==1)
			{
				$status = $_POST['status'];
			}else{
				$err['status'] = "please provide either boolean 0 or 1 as status";
			}

			if(count($err)==0) {

				$sql = "select id from post where post_title='$title'";
				$res = $validation->get('con')->query($sql);
				if($res->num_rows==1)
				{	

					echo "<script>alert('post with this title already exists');window.location='".base_url()."post-add.php';</script>";
					exit();

				}

				$sql = "insert into post(post_cat, post_title, feature_image, post_description, status, created_by, created_at) values('$category', '$title', '$image', '$description', $status,'".$_SESSION['name']."','".date('Y-m-d H:i:s')."')";
				
				$resp = $validation->get('con')->query($sql);
				if($resp)
				{	
					move_uploaded_file($_FILES['image']['tmp_name'],"images/$image");
					echo "<script>alert('post added !');</script>";
				}else{
					echo "<script>alert('failed !');</script>";
				}

			}

			
		}
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
      <li><a href="<?php echo base_url();?>post-add.php">Post</a>
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
		</div>
		</div>
		<div class="box-body">
	        <div class="col-lg-6">
	            <form role="form" action="" method="post" enctype="multipart/form-data">
	                <div class="form-group">
	                    <label for="category">Select Category</label>
	                    <select name="category" class="form-control">
	                    	<option value="">Select Category...</option>
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
	                    (isset($err['name']))?"<span class='error'>".$err['name']."</span>":""; ?>
	                </div>
					
					<div class="form-group">
					    <label for="title">Title</label>
					    <input type="text" class="form-control" name="title" required>
					    <?php echo 
	                    (isset($err['title']))?"<span class='error'>".$err['title']."</span>":""; ?>
					</div>

					<div class="form-group">
					    <label for="image">Fetaure Image</label>
					    <input type="file" class="form-control" name="image" required>
					    <?php echo 
	                    (isset($err['image']))?"<span class='error'>".$err['image']."</span>":""; ?>
					</div>

					<div class="form-group">
					    <label for="description">Description</label>
					    <textarea class="form-control" name="description" rows=5 required></textarea>
					    <?php echo 
	                    (isset($err['description']))?"<span class='error'>".$err['description']."</span>":""; ?>
					</div>


					<div calss="form-group">
						<label>Status</label>
						<input type="radio" name="status" checked="" value="1"> Active
						<input type="radio" name="status" value="0"> InActive
					</div>
	             
	                <button type="submit" class="btn btn-success" name="btnSave">Save Post</button>
	                
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

   	<!-- ==================================post listing============================== -->

    <!-- Default box -->
    <div class="box">
		<div class="box-header with-border">
		<h3 class="box-title">All Posts</h3>

		<div class="box-tools pull-right">
		  
		</div>
		</div>
		<div class="box-body">
	        <table id="example2" class="table table-striped table-bordered" role="grid" aria-describedby="example2_info">
	              <thead>
	              <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SN</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Title</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Category</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">FImage</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
	              </thead>
	              <tbody>

	              <tr role="row" class="odd">
              	<?php
              		$i=1;
              		$sql = "select * from post";
              		$res = $validation->get('con')->query($sql);

              		while($row=$res->fetch_assoc()) {
              		//------------------------------------start of while loop-------------------
              	?>
	                <td class="sorting_1"><?php echo $i++; ?></td>
	                <td><?php echo $row['post_title']; ?></td>
	                <td><span class="label label-primary"><?php echo $row['post_cat'];?></span></td>
	                <td><?php echo !empty($row['feature_image']) ? "<img src='images/".$row['feature_image']."' width=50px height=50px >":"";?></td>
	                <td><?php echo ($row['status']==1) ? "<sapn class='label label-success'>Active</span>" : "<sapn class='label label-danger'>Inactive</span>"; ?></td>
	                <td><a class="btn btn-md btn-warning" href="<?php echo base_url()?>post-edit.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a> <a class="btn btn-md btn-danger"  href="<?php echo base_url()?>post-del.php?id=<?php echo $row['id']?>"><i class="fa fa-trash"></i></a></td>
	              </tr>
              	<?php 
              		} 
              		//-----------------------------------end of while loop------------------------------------
              	?>
	              </tbody>
	        </table>
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

<?php require_once "footer.php"; ?>