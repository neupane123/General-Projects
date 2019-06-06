<?php 
		require_once "config/config.php";
		require_once "admin/class/formValidation.class.php";

		$validation = new FormValidation;

?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo isset($title) ? $title : '';?></title>
<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="public/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
	
</script>
	
</head>
<body>

<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="<?php echo base_url()?>"><img src="public/images/logo.png" class="img-responsive" alt=""></a>
			</div>
			
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-1">
							<li class="<?php if(isset($title) && $title=='Home'){ echo 'active';}else{}?>"><a href="index.php">Home</a></li>
							<?php 
								$sql = "select * from category where status=1 order by rank asc";
								$res = $validation->get('con')->query($sql);
								while($row = $res->fetch_assoc()) {
							?>

							<li class="<?php echo (ucfirst($row['name'])==$title) ? 'active' : ''; ?>"><a href="<?php base_url()?>category.php?cat=<?php echo strtolower($row['name']);?>"><?php echo $row['name'];?></a></li>
							<?php } ?>
										<div class="clearfix"></div>
						</ul>
				</div>
						<!-- script-for-nav -->
							<script>
								$( "span.menu" ).click(function() {
								  $( ".head-nav ul" ).slideToggle(300, function() {
									// Animation complete.
								  });
								});
							</script>
						<!-- script-for-nav -->
				
						
			
					<div class="clearfix"> </div>
		</div>
	</div>
<!-- header -->