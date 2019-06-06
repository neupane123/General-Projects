<?php 

if(isset($_GET['cat']) && !empty($_GET['cat']) && $_GET['cat'] != ' ')
{
	$category = filter_var($_GET['cat'],FILTER_SANITIZE_STRING);
	$title = ucfirst($category);
	require_once "header.php"; 

}

?>

	<div class="container">
		
		<div class="blog-content">
					<div class="blog-content-left">
						<div class="blog-articals">
						<?php
							if(isset($category)){

								$category = ucfirst($category);
								$sql = "select * from post where post_cat='$category' and status=1 order by created_at desc";
								$res = $validation->get('con')->query($sql);
								
								if($res && $res->num_rows>0)
								{
									while($row = $res->fetch_assoc())
									{

									
						?>
						<div class="blog-artical">
							<div class="blog-artical-info">
								<div class="blog-artical-info-img">
									<a href="<?php echo base_url()?>single.php?id=<?php echo $row['id']?>"><img src="<?php echo base_url()?>admin/images/<?php echo $row['feature_image']?>" title="<?php echo $row['feature_image'];?>"></a>
								</div>
								<div class="blog-artical-info-head">
									<h2><a href="<?php echo base_url()?>single.php?id=<?php echo $row['id']?>"><?php echo !empty($row['post_title']) ? $row['post_title'] :''; ?></a></h2>
									<h6>Posted on, <?php echo date('j F Y g:ia', strtotime($row['created_at']))?> by <a href="#"> <?php echo $row['created_by'];?></a></h6>
									
								</div>
								<div class="blog-artical-info-text">
									<p><?php echo !empty($row['post_description']) ? substr($row['post_description'],0,255) : ''; ?><a href="<?php echo base_url()?>single.php?id=<?php echo $row['id']?>">[...]</a></p>
								</div>
								<div class="artical-links">
		  						 	<ul>
		  						 		<li><small> </small><span><?php echo !empty($row['created_at']) ? date('F j, Y',strtotime($row['created_at'])):'';?></span></li>
		  						 		<li><a href="#"><small class="admin"> </small><span><?php echo !empty($row['created_by']) ? $row['created_by'] : '';?></span></a></li>
		  						 		
		  						 	</ul>
		  						 </div>
							</div>
							<div class="clearfix"> </div>
						</div>

						<?php 
							}
								}
									}

						?>
							<!---728x90--->
<script src='../../../../publisher.eboundservices.com/dynamicAds/dynamicScript.js'></script>
<div style='margin: 0 auto;text-align: center;margin-top: 5px;'><script>
var allowedNumberOfEboundDynamicAdds = 4;
var sizesEboundDynamicAdsDesktop = ['728x90'];
var sizesEboundDynamicAdsTablet = ['728x90'];
var sizesEboundDynamicAdsMobile = ['320x100'];
eboundAdsTagByDevice(sizesEboundDynamicAdsDesktop,sizesEboundDynamicAdsTablet,sizesEboundDynamicAdsMobile, 'ebound_header_tag');

if(typeof user_tag_config == 'undefined'){
	var user_tag_config = {};
}
user_tag_config['ebound_header_tag'] = {};
user_tag_config['ebound_header_tag']['desktop'] = {};
user_tag_config['ebound_header_tag']['desktop']['cpm'] = '';
user_tag_config['ebound_header_tag']['desktop']['adsCode'] = '';
user_tag_config['ebound_header_tag']['tablet'] = {};
user_tag_config['ebound_header_tag']['tablet']['cpm'] = '';
user_tag_config['ebound_header_tag']['tablet']['adsCode'] = '';
user_tag_config['ebound_header_tag']['mobile'] = {};
user_tag_config['ebound_header_tag']['mobile']['cpm'] = '';
user_tag_config['ebound_header_tag']['mobile']['adsCode'] = '';
</script></div>
						
							</div>
						
					</div>
					
					</div>
					<div class="blog-content-right">
						<div class="b-search">
							<form>
								<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
								<input type="submit" value="">
							</form>
						</div>
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
								<li><a href="<?php echo base_url()?>category.php?cat=<?php echo strtolower($row['name']);?>"><?php echo $row['name'];?></a></li>
							<?php }} ?>
							</ul>
						</div>
						<!---- //End-tag-weight---->
					</div>
					<div class="clearfix"> </div>
				
				</div>
		</div>
		<!-- /Blog -->

<?php require_once "footer.php"; ?>