<?php require_once "header.php"; 

if(isset($_GET['id']) && !empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))
{
	$id = $_GET['id'];
	$sql = "select * from post where id=$id";

	$res = $validation->get('con')->query($sql);

	if($res && $res->num_rows==1)
	{
		$data = $res->fetch_assoc();
	}

	if(isset($data) && !empty($data)){

}

?>

<!-- content -->
<div class="container">
<div class="content-top">
	
			<div class="single">

				<div class="single-top">
					<img src="<?php echo base_url(); ?>admin/images/<?php echo $data['feature_image']; ?>" class="img-responsive" alt="">
					<h2 style="margin-top:10px;"><?php echo !empty($data['post_title']) ? $data['post_title'] : ''; ?></h2>
					<p class="sin"><?php echo !empty($data['post_description']) ? $data['post_description'] : ''; ?>
						<div class="artical-links">
		  						 	<ul>
		  						 		<li><small> </small><span><?php echo !empty($data['created_at']) ? date('jS, M Y',strtotime($data['created_at'])) . " , ". date('g:i:s a',strtotime($data['created_at'])) : '';?></span></li>
		  						 		<li><a href="#"><small class="admin"> </small><span><?php echo isset($data['created_by']) ? $data['created_by'] : '';?></span></a></li>

		  						 	</ul>
		  						 </div>

				</div>

				<div class="blog-content-right">
						<div class="b-search">
							<form>
								<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
								<input type="submit" value="">
							</form>
						</div>
						<!--start-twitter-weight-->
						<div class="twitter-weights">
							<h3>Related Posts</h3>
						<?php 
						
							$sql = "select * from post where post_cat='". ($data['post_cat']) ."' order by created_at desc limit 3";

							$res = $validation->get('con')->query($sql);
							if($res && $res->num_rows >0)
							{
								while($row = $res->fetch_assoc())
								{
									if($row['id'] != $data['id'])
									{

						?>
							<div class="twitter-weight-grid">
								<h4><a href="<?php echo base_url()?>single.php?id=<?php echo $row['id'];?>" style="color:red;"><?php echo $row['post_title']?></a></h4>
								<p><?php echo substr($row['post_description'],0,50)."...";?></p>
								<i><a href="#"><?php echo date("jS,M Y",strtotime($row['created_at']));?></a></i>
							</div>
						<?php }}} ?>
							
							<a class="twittbtn" href="#">See All Posts</a>
						</div>
						<!--//End-twitter-weight-->
						<!-- start-tag-weight-->
						<div class="b-tag-weight">
							<h3>Post Categories</h3>
							<ul>
							<?php 
								$sql = "select id,name from category where status=1";
								$res = $validation->get('con')->query($sql);
								if($res && $res->num_rows >0)
								{
									while($row = $res->fetch_assoc())
									{
								
							?>
								<li><a href="<?php echo base_url()?>category.php?cat=<?php echo strtolower($row['name'])?>"><?php echo $row['name'];?></a></li>
							<?php }} ?>
							</ul>
						</div>
						<!---- //End-tag-weight---->
					</div>
					<div class="clearfix"> </div>
			</div>
</div>
<!-- content -->

<?php }
		require_once "footer.php"; ?>
