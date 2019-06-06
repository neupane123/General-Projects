
<?php 	
		$title = "Home";
		require_once "header.php"; ?>
<div class="container">
	<div class="col-md-9 bann-right">
		<!-- banner -->
		<div class="banner">		
			<div class="header-slider">
				<div class="slider">
					<div class="callbacks_container">
					  	<ul class="rslides" id="slider">
					  	<?php

							$sql = "select * from post where post_cat='Slider' and status=1 order by created_at desc";
							$res = $validation->get('con')->query($sql);
							if($res && $res->num_rows>0)
							{	

								while($row = $res->fetch_assoc()){

					  	?>
							<li>
								<img src="<?php echo base_url()?>admin/images/<?php echo $row['feature_image']?>" class="img-responsive" alt="">
								<div class="caption">
									<h3><a style="color:white;" href="<?php echo base_url()?>single.php?id=<?php echo $row['id']?>"><?php echo $row['post_title']?></a></h3>
									<p><?php echo substr($row['post_description'],0,200)."...";?></p>
								</div>
							</li>

						<?php 
							}} 
						?>
							
						</ul>
			  		</div>
				 </div>
			</div>
		</div>
		<!-- banner -->	
		<!-- nam-matis -->
		<!---320x50--->
		<div class="nam-matis">
				<div class="nam-matis-top">
			<?php 
				$i=1;
				$sql = "select * from post where post_cat = 'Blog' and status=1 order by created_at desc";
				$res = $validation->get('con')->query($sql);
				if($res && $res->num_rows >0 )
				{
					while($row = $res->fetch_assoc()) 
					{

			?>
			
						
						<div class="col-md-6 nam-matis-1">
							<a href="<?php echo base_url()?>single.php?id=<?php echo $row['id'];?>"><img src="<?php echo base_url()?>admin/images/<?php echo $row['feature_image'] ?>" class="img-responsive" alt=""></a>
							<h3><a href="<?php echo base_url()?>single.php?id=<?php echo $row['id'];?>"><?php echo $row['post_title']; ?></a></h3>
							<p><?php echo substr($row['post_description'],0,300);?></p>
						</div>
						<?php if($i%2==0){?>
						<div class="clearfix"> </div>
						<?php } ?>
						
			<?php
					$i++;
					}
				}
			?>
				</div>
		</div>
		<!---320x50--->
		<!-- nam-matis -->	
	</div>
	<div class="col-md-3 bann-left">
		<div class="b-search">
			<?php if(isset($_POST['find']))
			{
				if(isset($_POST['p']) && !empty($_POST['p'])) {
					$search = filter_var($_POST['p'],FILTER_SANITIZE_STRING);

					$sql = "select * from post where match(post_title,post_description) against('>$search* +$search' IN BOOLEAN MODE)";
					$res=$validation->get('con')->query($sql);

					$Sdata =[];
					if($res && $res->num_rows>0) {
						while($row = $res->fetch_assoc()) {
							$Sdata[]=$row;
						}
					}
					if(isset($Sdata)){
						// print_r($Sdata);
					}
				}
			}
			?>
			<form action="" method="post">
				<input type="text" name="p">
				<input type="submit" value="" name="find">
			</form>
		</div>
		<h3>Recent Posts</h3>
		<div class="blo-top">
		<?php
			$sql = "select * from post order by created_at desc limit 3";
			$res = $validation->get('con')->query($sql);
			if($res && $res->num_rows >0)
			{
				while($row = $res->fetch_assoc())
				{
		
		?>
			<div class="blog-grids">
				<div class="blog-grid-left">
					<a href="<?php echo base_url()?>single.php?id=<?php echo $row['id']?>"><img src="<?php echo base_url()?>admin/images/<?php echo $row['feature_image'];?>" class="img-responsive" alt=""></a>
				</div>
				<div class="blog-grid-right">
					<h4><a href="<?php echo base_url()?>single.php?id=<?php echo $row['id']?>"><?php echo $row['post_title'];?> </a></h4>
					<p>pellentesque dui, non felis. Maecenas male </p>
				</div>
				<div class="clearfix"> </div>
			</div>
		<?php 
			}}
			?>
		</div>
		<h3>Categories</h3>
		<div class="blo-top">
		<?php
			$sql = "select name from category where status=1";
			$res = $validation->get('con')->query($sql);
			if($res && $res->num_rows>0) {
				
			while($row = $res->fetch_assoc())
			{
		?>

			<li><a href="<?php echo base_url()?>category.php?cat=<?php echo strtolower($row['name'])?>">||  <?php echo $row['name'] ?></a></li>
		
		<?php
		
			}}
		?>
			
			
		</div>
		
	</div>
	<div class="clearfix"> </div>
	<!---728x90--->
</div>
	<div class="fle-xsel">
		<ul id="flexiselDemo3">
		<?php
			$sql = "select * from post where status=1";
			$res = $validation->get('con')->query($sql);
			if($res && $res->num_rows > 0)
			{
				$data = [];
				while($row = $res->fetch_assoc())
				{
					$data[] = $row;
				}
			}

			if(isset($data) && !empty($data)) {
			foreach($data as $d){
		?>
			<li>
				<a href="<?php echo base_url()?>single.php?id=<?php echo $d['id']?>">
					<div class="banner-1">
						<img src="<?php echo base_url()?>admin/images/<?php echo $d['feature_image']?>" class="img-responsive" alt="">
					</div>
				</a>
			</li>
		<?php }} ?>
					
		</ul>
						
						 <script type="text/javascript">
							$(window).load(function() {
								
								$("#flexiselDemo3").flexisel({
									visibleItems: 5,
									animationSpeed: 1000,
									autoPlay: true,
									autoPlaySpeed: 3000,    		
									pauseOnHover: true,
									enableResponsiveBreakpoints: true,
									responsiveBreakpoints: { 
										portrait: { 
											changePoint:480,
											visibleItems: 2
										}, 
										landscape: { 
											changePoint:640,
											visibleItems: 3
										},
										tablet: { 
											changePoint:768,
											visibleItems: 3
										}
									}
								});
								
							});
							</script>
							<script type="text/javascript" src="public/js/jquery.flexisel.js"></script>
				<div class="clearfix"> </div>
	</div>


<?php require_once "footer.php"; ?>