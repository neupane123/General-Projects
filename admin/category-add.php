<?php
		$title = "Category";
		require_once "header.php";
		require_once "authorization.php"; //role based authorization
		
		$roles = explode(',',$_SESSION['role']);

		authorize('add_category',$roles);
		$validation = new FormValidation;

		if(isset($_POST['btnSave'])) {

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


				if(count($err)==0) {
					$sql = "select * from category where name='$name' limit 1";
					// validation object is getting database connection object from its parent's constructor fuction
					$res = $validation->get('con')->query($sql);

					if($res && $res->num_rows==1) {
						echo "<script>alert('category name already exists'); window.location='".base_url()."category-add.php';</script>";
						exit();
					}else {
						$sql = "insert into category(name, rank, status) values('$name', $rank, $status)";
						$resp = $validation->get('con')->query($sql);
						if($resp) {
							echo "<script>alert('category added !');</script>";
						}else{
							echo "<script>alert('failed to add category !');</script>";		
						}
					}
				}
		}
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Manage Cateogy
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
			<h3 class="box-title">New Category</h3>

			<div class="box-tools pull-right">
			  <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>category-add.php">Add New</a>
			</div>
			</div>
			<div class="box-body">
		        <div class="col-lg-6">
		            <form role="form" action="" method="post" enctype="multipart/form-data">
		                <div class="form-group">
		                    <label for="ctg_id">Name</label>
		                    <input type="text" name="name" required class="form-control">
		                    <?php echo 
		                    (isset($err['name']))?"<span class='error'>".$err['name']."</span>":""; ?>
		                </div>
						
						<div class="form-group">
						    <label for="status">Display Rank</label>
						    <input type="number" class="form-control" name="rank" required>
						    <?php echo 
		                    (isset($err['rank']))?"<span class='error'>".$err['rank']."</span>":""; ?>
						</div>
		                <div class="form-group">
		                    <label for="status">Publish</label>
		                    <input type="radio" name="status_key"  value="1"> Yes
		                    <input type="radio" name="status_key"  checked="" value="0" checked=""> NO
		                    <?php echo 
		                    (isset($err['status']))?"<span class='error'>".$err['status']."</span>":""; ?>
		                </div>
		             
		                <button type="submit" class="btn btn-success" name="btnSave">Save Category</button>
		                
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

	    <!-- ==================================categories listing============================== -->

	    <!-- Default box -->
	    <div class="box">
			<div class="box-header with-border">
			<h3 class="box-title">All Category</h3>

			<div class="box-tools pull-right">
			  
			</div>
			</div>
			<div class="box-body">
		        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
		              <thead>
		              <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SN</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Rank</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action grade</th></tr>
		              </thead>
		              <tbody>

		              <tr role="row" class="odd">
	              	<?php
	              		$i=1;
	              		$sql = "select * from category";
	              		$res = $validation->get('con')->query($sql);

	              		while($row=$res->fetch_assoc()) {
	              		//------------------------------------start of while loop-------------------
	              	?>
		                <td class="sorting_1"><?php echo $i++; ?></td>
		                <td><span class="label label-info"><?php echo $row['name']; ?></span></td>
		                <td><?php echo $row['rank']; ?></td>
		                <td><?php echo ($row['status']==1) ? "<sapn class='label label-success'>Active</span>" : "<sapn class='label label-danger'>Inactive</span>"; ?></td>
		                <td><a class="btn btn-md btn-warning" href="<?php echo base_url()?>category-edit.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a> <a class="btn btn-md btn-danger"  href="<?php echo base_url()?>category-del.php?id=<?php echo $row['id']?>"onClick="confirm('Delete entry?')"><i class="fa fa-trash"></i></a></td>
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
	<!-- /.content-wrapper -->


<?php require_once "footer.php";?>