<?php

	require("db_connection.php");
				  	$posloc_stt = "SELECT posloc FROM realtime ORDER BY id DESC LIMIT 1";
					$posloc_query = mysqli_query($con, $posloc_stt);
					while($posrow = mysqli_fetch_assoc($posloc_query))
					{
						$pos = $posrow['posloc'];
					}
					echo json_encode($pos);
					mysqli_close($con);
?>