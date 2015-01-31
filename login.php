<?php
	
	require("session.php");
	if (!isset($_POST['loginemail']))
	{
		die ("Error: Email field was not set.");
	}
	else if (!isset($_POST['logindomainid']))
	{
		die ("Error: Domain ID field was not set.");
	}
	$email = $_POST['loginemail'];
	$domainid = $_POST['logindomainid'];
	$stt = "SELECT ID from registerdomain WHERE Email = '$email' AND DomainTitle = '$domainid'";
	$query = mysqli_query($con, $stt);
	
	if (mysqli_num_rows($query))
	{
		$session_id = session_id();
		$hash = hash("sha512", $session_id.$_SERVER['HTTP_USER_AGENT']);
		while($row = mysqli_fetch_assoc($query))
		{
			$userData = $row['ID'];
		}
		
		$expires = time() + (60 * 15);
		$query_active = "INSERT INTO active_users (user , session_id, hash, expires) VALUES ('$userData', '$session_id', '$hash', '$expires')";
		$query_insert = mysqli_query($con, $query_active);
		mysqli_close();
		header("Location: dashboard.php");
		
	}
	else
	{
		mysqli_close();
		header("Location: loginfailed.html");
		exit; 
	}

?>