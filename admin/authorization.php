<?php

	$u_roles = [
					'add_category'=>['admin','editor'], //for adding category admin or editor roles are required
					'view_category'=>['admin','editor','author'],
					'add_post'=>['admin','author'],
					'view_post'=>['admin','editor']
			];


	/**
	*function authorizatin
	*@arg req_action : authorization request for action e.g adding news category (add_cagegory)
	*@roles : all the roles that currently logged in user has
	**/
	function authorize(string $req_action, array $roles)
	{
		$c = 0;
		global $u_roles;
		if(array_key_exists($req_action, $u_roles))
		{
			foreach($roles as $role)
			{
				if(in_array($role, $u_roles[$req_action]))
				{
					$c++;
				}
			}
		}

		if($c==0)
		{
			$uri = $_SERVER['HTTP_REFERRER'];

			if(isset($uri) && !empty($uri))
			{
				header("location:$uri?msg=you do not have required previledge to $req_action");
				exit();
			}
			header("location:dashboard.php?msg=you do not have required previledge to $req_action");
			exit();
		}
	}

?>