<?php
	if(isset($_GET['msg']) && !empty($_GET['msg']))
	{
		$msg = filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
		// echo "
		// 	<div class='alert alert-warning col-md-12'>
		// 	  <strong>Warning!</strong> $msg
		// 	</div>
		// ";

		echo "

			<div class='alert alert-warning alert-dismissible'>
			  <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			  <strong>Warning!</strong> $msg
			</div>

		";
	}

?>