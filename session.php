<?php 

	session_start();
	require("db_connection.php");
	
	$session_id = session_id();
	$time = time();
	$hash = hash("sha512", $session_id.$_SERVER['HTTP_USER_AGENT']);
	$query = "SELECT user FROM active_users WHERE session_id = '$session_id' AND hash = '$hash' AND expires > '$time' LIMIT 1";
	$query_loggedin = mysqli_query($con, $query);
	if(mysqli_num_rows($query_loggedin))
	{
		while($data = mysqli_fetch_assoc($query_loggedin))
		{
			$datauser = $data['user'];
		}
	}
	
	if(isLoggedIn())
	{
		$expires = time() + (60 * 15);
		$update_statement = "UPDATE active_users SET expires = '$expires' WHERE user = '$datauser'";
		$update_query = mysqli_query($con, $update_statement);
		$userdata_statement = "SELECT DomainTitle, Email FROM registerdomain WHERE ID = '$datauser'";
		$getuser_query = mysqli_query($con, $userdata_statement);
		while ($getuserdata = mysqli_fetch_assoc($getuser_query))
		{
			$userdomain = $getuserdata['DomainTitle'];
			$useremail = $getuserdata['Email'];
		}
		$serialnumber_statement = "SELECT serialnumber FROM registerdevice WHERE domainid1 = '$userdomain'";
		$serialnumber_query = mysqli_query($con, $serialnumber_statement);
		$serialnumber_array = array();
		while ($sn = mysqli_fetch_array($serialnumber_query))
		{
			$serialnumber_array[] = $sn['serialnumber'];
		}
		$serialnumber_count = count($serialnumber_array);
		mysqli_close();
	}
	
	
	function isLoggedIn()
	{
		global $query_loggedin;
		
		if (mysqli_num_rows($query_loggedin))
		{
			
			return true;
			
		}
		else
		{
			mysqli_close();
			return false;
		}
	}
	
	
	
?>
