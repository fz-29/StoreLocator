<?php
	require("dbinfo.php");
	$connect=new mysqli($SERVER,$USER,$PSWD,$DB);
	if($connect->connect_error)
	{
		die("Database connection failed : ".$connect->connect_error);
	}

?>