<?php
	$host = "us-cdbr-east-04.cleardb.com:3306";
	$username = "b4ae5754215d7e";
	$password = "507f4753";
	$name = "ad_8c8d158234a92d0";
	global $con;
	$con = mysqli_connect($host, $username, $password);
	if(!$con)
	{
		die("Cannot connect to database");
	}
	
	$db = mysqli_select_db ($con, $name);
	if (!$db)
	{
		die ("No database found");
	}
?>