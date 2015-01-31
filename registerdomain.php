<?php
							require("db_connection.php");
							
							$sql="INSERT INTO registerdomain (DomainTitle, Address1, Address2, City, Country, Pincode, Email, Phone)
							VALUES ('$_POST[domaintitle]', '$_POST[address1]', '$_POST[address2]', '$_POST[city]', '$_POST[country]', '$_POST[pincode]', '$_POST[email]', '$_POST[phone]')";
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
                              <li style="vertical-align:middle; height:54px;"><a data-reveal-id="loginModal" id="login" href="#" style="background-image: radial-gradient(at 50% 50%, rgb(14, 119, 95) 0%, rgb(26, 176, 142) 100%)">LOGIN</a>
                              	<div id="loginModal" class="reveal-modal">
                                	<h2 style="margin:6px auto; width:250px"><strong>Login:</strong></h2>
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
                    	<p>Registration Successful!! Your Domain ID is <?php echo "<b>$_POST[domaintitle]</b>" ?>. Please keep your Domain ID in a safe place. </p>
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