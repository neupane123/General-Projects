<?php 
		$title="Home";
?>
<?php 
		require_once "header.php"; 
		$cat = "select id from category";
		$post = "select id from post";
		$validation = new FormValidation;
		$res = $validation->get('con')->query($cat);
		$no_category = $res->num_rows;
		$resP = $validation->get('con')->query($post);
		$no_post = $resP->num_rows;



?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Welcome To Dashboard
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">

	    <!-- Default box -->
	    <div class="box">
	      <div class="box-header with-border">
	        <h3 class="box-title">Title</h3>

	        <div class="box-tools pull-right">
	          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	            <i class="fa fa-minus"></i></button>
	          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	            <i class="fa fa-times"></i></button>
	        </div>
	      </div>
	      <div class="box-body">
				<div class="row">
				        <div class="col-md-3 col-sm-6 col-xs-12">
				          <div class="info-box">
				            <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>

				            <div class="info-box-content">
				              <span class="info-box-text">Post Categories</span>
				              <span class="info-box-number"><small><?php echo isset($no_category) ? $no_category : '';?></small></span>
				            </div>
				            <!-- /.info-box-content -->
				          </div>
				          <!-- /.info-box -->
				        </div>
				        <!-- /.col -->
				        <div class="col-md-3 col-sm-6 col-xs-12">
				          <div class="info-box">
				            <span class="info-box-icon bg-red"><i class="fa fa-television"></i></span>

				            <div class="info-box-content">
				              <span class="info-box-text">Posts</span>
				              <span class="info-box-number"><?php echo isset($no_post) ? $no_post : '';?></span>
				            </div>
				            <!-- /.info-box-content -->
				          </div>
				          <!-- /.info-box -->
				        </div>
				        <!-- /.col -->
						

				      </div>
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
<?php require_once "footer.php"; ?>