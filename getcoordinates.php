<?php
	require("db_connection.php");
	
	$stt = "INSERT INTO realtime (topic, posloc) VALUES ('$_POST[topic]', '$_POST[location]')";
	$query = mysqli_query($con, $stt);
	mysqli_close($con);
	
?>