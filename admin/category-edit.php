<?php
	$title = "Category-Edit";
	require_once "header.php";
	require_once "class/formValidation.class.php";
	$validation = new FormValidation;

	if(isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))
	{
			$id= $_GET['id'];

			if(isset($_POST['btnUpdate']))
			{
				$err = [];

				if(isset($_POST['name']) && !empty($_POST['name']) && $_POST['name'] != ' ') {
						$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
						$name = $validation->sanitize($name);
				}elseif(empty($_POST['name']) || $_POST['name'] == ' ') {
						$err['name']="category name is required";
				}else{
						$err['name'] = "please input valid category name";
				}


				if(isset($_POST['rank']) && filter_var($_POST['rank'], FILTER_VALIDATE_INT)) {

						$rank = $_POST['rank'];
				}else{
						$err['rank'] = "please input numeric display rank";
				}


				if( isset($_POST['status_key']) && ($_POST['status_key']==0 || $_POST['status_key']==1))
				{
						$status = $_POST['status_key'];
				}else{
						$err['status'] = "invalid input";
				}

				if(count($err)==0)
				{
					$sql = "select id form category where name='$name'";
					$res = $validation->get('con')->query($sql);
					if($res && $res->num_rows==1) {
						echo "<script>alert('category ".$name." already exists');</script>";
					}else{
						$sql="update category set name='$name', rank=$rank, status=$status where id=$id";
						$resp = $validation->get('con')->query($sql);
						if($resp)
						{
							echo "<script>alert('updated successfully')</script>";
						}
					}
				}

			}

			$id=$_GET['id'];
			$sql = "select * from category where id=$id";
			$res = $validation->get('con')->query($sql);
			if($res && $res->num_rows==1){
				$data = $res->fetch_assoc();
			}

	}

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Cateogy
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
		<h3 class="box-title">Update Category</h3>

		<div class="box-tools pull-right">
		  <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>category-add.php">All Categories</a>
		</div>
		</div>
		<div class="box-body">
	        <div class="col-lg-6">
	            <form role="form" action="" method="post" enctype="multipart/form-data">
	                <div class="form-group">
	                    <label for="ctg_id">Name</label>
	                    <input type="text" name="name" value="<?php echo !empty($data['name']) ? $data['name'] : ''; ?>" required class="form-control">
	                    <?php echo 
	                    (isset($err['name']))?"<span class='error'>".$err['name']."</span>":""; ?>
	                </div>
					
					<div class="form-group">
					    <label for="status">Display Rank</label>
					    <input type="number" class="form-control" name="rank" value="<?php echo $data['rank'];?>" required>
					    <?php echo 
	                    (isset($err['rank']))?"<span class='error'>".$err['rank']."</span>":""; ?>
					</div>
	                <div class="form-group">
	                    <label for="status">Publish</label>

	                    <?php if($data['status']==0){ ?>

	                    <input type="radio" name="status_key"  value="1"> Yes
	                    <input type="radio" name="status_key"  checked="" value="0" checked=""> NO

	                	<?php }else{ ?>

						<input type="radio" name="status_key"  value="1" checked=""> Yes
						<input type="radio" name="status_key" value="0"> No

	                	<?php } ?>

	                    <?php echo 
	                    (isset($err['status']))?"<span class='error'>".$err['status']."</span>":""; ?>
	                </div>
	             
	                <button type="submit" class="btn btn-success" name="btnUpdate">Update Category</button>
	                
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

<?php require_once "footer.php"; ?>

