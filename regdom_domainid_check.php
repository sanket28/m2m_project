<?php
header('Content-type: application/json');
if(isset($_REQUEST['domaintitle'])){
    $host = "us-cdbr-east-04.cleardb.com:3306";
	$username = "b4ae5754215d7e";
	$password = "507f4753";
	$name = "ad_8c8d158234a92d0";
	
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
    $domaintitle = preg_replace('#[^a-z0-9/\[]-=+_.,]#i', '', $_REQUEST['domaintitle']); 
    $sql_domaintitle_check = mysqli_query($con, "SELECT DomainTitle FROM registerdomain WHERE DomainTitle='$domaintitle' LIMIT 1");
	if (!$sql_domaintitle_check){
		echo "Could not run query.";
		exit;
	}
    $domaintitle_check = mysqli_num_rows($sql_domaintitle_check);
     if ($domaintitle_check < 1) {
	   $valid = "true";
    } else {
	    $valid = "false";
    }
	echo $valid;
}
?>