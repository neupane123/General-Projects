<?php
require_once "base.class.php";

Class FormValidation extends Base
{
	public function sanitize($data)
	{
		$data = trim($data);
		$data = mysqli_real_escape_string($this->con,$data);
		$data = htmlspecialchars($data,ENT_QUOTES,'UTF-8');
		return $data;
	}
}


?>