<?php
	
	ini_set ('SMTP', 'smtp.gmail.com');
	ini_set ('smtp_port', '465');
	ini_set ('sendmail_from', 'teammachine2machine@gmail.com');
	$email_to = "teammachine2machine@gmail.com";
 	$email_subject = "Contact Form M2M Dashboard";
	
	$first_name = $_POST['fisrtnamecon'];
	$last_name = $_POST['lastnamecon'];
	$company_name = $_POST['companyname'];
	$email_from = $_POST['emailcon'];
	$telephone = $_POST['phonecon'];
	$queries = $_POST['queries'];
	$mail_header = "From : $email_from \r\n";
	$email_message = "Form details below : \n\n
		";
				
	$mail_to = mail ($email_to, $email_subject, $email_message, $mail_header);
	
	if (!$mail_to) {
		
		die ("Oops!! Something went wrong. Please try resubmitting your form. ");
	}
		
?>

<!doctype html>
      
      <html>
      
          <head>
          	<script src="js/jquery.js" type="text/javascript"></script>
            <script src="js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
            <script src="js/jquery.validate.js" type="text/javascript"></script>
            <script src="js/jquery.reveal.js"></script>
          	<meta charset="UTF-8">
            <title>Email Sent-M2M Dashboard</title>
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
                    	<p>Thank you for contacting us. Your email has been sent successfully.</p>
                        <p>We will get back to you within 2 to 3 business days.</p>
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