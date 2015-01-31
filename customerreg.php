<?php
							require("db_connection.php");
							
							$sql="INSERT INTO registercustomer (firstname, middlename, lastname, address1, address2, city, country, pincode, email, phone,domainid)
							VALUES ('$_POST[firstname]','$_POST[middlename]', '$_POST[lastname]','$_POST[address1cu]', '$_POST[address2cu]', '$_POST[citycu]', '$_POST[countrycu]', '$_POST[pincodecu]', '$_POST[emailcu]', '$_POST[phonecu]','$_POST[domainid]')";
							$qu = mysqli_query ($con, $sql);
							if (!$qu) {
							die ("Error: Cannot insert into database. Please try again");	
							}
							
							mysqli_close($con);
					?>


<!doctype html>
      
      <html>
      
          <head>
          	<script src="js/jquery.js" type="text/javascript"></script>
            <script src="js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
            <script src="js/jquery.validate.js" type="text/javascript"></script>
            <script src="js/jquery.reveal.js"></script>
          	<meta charset="UTF-8">
            <title>Registration Successful-M2M Dashboard</title>
            <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen">
            <link rel="stylesheet" href="css/reveal.css" type="text/css" media="screen">
            <link href='http://fonts.googleapis.com/css?family=Lato:900,400,700' rel='stylesheet' type='text/css'>
          </head>
          
          <body>
              <div id="wrapper">
                  <div id="nav">
                       <div id="mainnav">
                            <ul>
                              <li><a href="index.html"><img src="images/m2mlogo.png" style="vertical-align:middle; height:54px;"></a></li>
                              <li style="vertical-align:middle; height:54px;"><a href="platform.html">PLATFORM</a></li>
                              <li style="vertical-align:middle; height:54px;"><a href="services.html">SERVICES</a></li>
                              <li style="vertical-align:middle; height:54px;"><a href="devcenter.html">DEVELOPER CENTER</a></li>
                              <li style="vertical-align:middle; height:54px;"><a href="support.html">SUPPORT</a></li>
                              <li style="vertical-align:middle; height:54px;"><a data-reveal-id="loginModal" id="login" href="#">LOGIN</a>
                              	<div id="loginModal" class="reveal-modal">
                                	<h2><strong>Login:</strong></h2>
                                	<form method="post" action="login.php" name="loginform" id="loginform">
                                    	 <ol>
                                            <li>
                                                <label for="loginemail">Email</label>
                                                <input type="email" name="loginemail">
                                            </li>
                                            <li>
                                                <label for="logindomainid">Domain ID</label>
                                                <input type="password" name="logindomainid">
                                            </li>
                                            <li>
                                            	<input class="submit" type="image" value="" src="images/login.png" style="height:50px; width:110px; margin-left:-4px">
                                    		</li>
                                         </ol>
                                    </form>
                              		<a class="close-reveal-modal">&#215;</a>
                         		</div>
                              </li>
                          </ul>
                      </div>
                  </div>
              
              	<div id="content-wrapper">
                	<div id="regsuccessfuldomain">
                    	<p>Registration Successful!! Your Domain ID is <?php echo "<b>$_POST[domainid]</b>" ?>. Please keep your Domain ID in a safe place. </p>
                        <p>You can now login to your dashboard OR click <a href="getstarted.html">here</a> to go back to previous page</p>
                    </div>     
              	</div>
              
              	<div id="footer">
					<p style="color:grey; text-align:center; margin-top:20px;">&copy;Copyright 2013 | All Rights Reserved | About Us | <a href="support.html">Contact</a> | Privacy | Terms Of Use | <a href="support.html">Feedback</a></p>              
              	</div>
              </div>
              <script>
			 	$(document).ready(function() {
					$('#loginform').validate({
						rules: {
							loginemail: {
								required: true
								},
							logindomainid: {
								required: true
								}
						},
						messages: {
							loginemail: {
								required: "Please enter your Email address"
								},
							logindomainid: {
								required: "Please enter your Domain ID"
								}
						}
					});
				});
			</script>
          </body>
      
      </html>