<?php
		header('Content-type: application/json');
		if(isset($_REQUEST['domainiddev'])) {
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

			$domain=preg_replace('#[^a-z0-9*]#i', '', $_REQUEST['domainiddev']);
			$sql_dname_check=mysqli_query($con, "SELECT DomainTitle FROM registerdomain WHERE DomainTitle='$domain' LIMIT 1");
			$dname_check= mysqli_num_rows($sql_dname_check);

			if($dname_check<1)
			{
				$valid="false";
				
			}

			else
			{
				$valid="true";				
			}
			echo $valid;
}
?>



