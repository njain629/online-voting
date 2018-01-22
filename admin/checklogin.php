<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Simple PHP Polling System Access Denied</title>
		<link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
	</head>
	<body bgcolor="tan">
		<center><b><font color = "brown" size="6">Simple PHP Polling System</font></b></center><br><br>
		<div id="page">
				<div id="header">
					<h1>Invalid Credentials Provided </h1>
					<p align="center">&nbsp;</p>
				</div>
				<div id="container">
					<?php
						ini_set ("display_errors", "1");
						error_reporting(E_ALL);

						ob_start();
						session_start();
						global $con=mysqli_connect('localhost', 'root', '','poll');

						$tbl_name="tbAdministrators"; // Table name


						// Defining your login details into variables
						$myusername=$_POST['myusername'];
						$mypassword=$_POST['mypassword'];
						$encrypted_mypassword=md5($mypassword); //MD5 Hash for security
						// MySQL injection protections
						$myusername = stripslashes($myusername);
						$mypassword = stripslashes($mypassword);
						$myusername = mysqli_real_escape_string($con,$myusername);
						$mypassword = mysqli_real_escape_string($con,$mypassword);

						$sql="SELECT * FROM $tbl_name WHERE email='$myusername' and password='$encrypted_mypassword'" or die(mysql_error());
						$result=mysqli_query($con,$sql) or die(mysqli_error($con));

						// Checking table row
						$count=mysqli_num_rows($result);
						// If username and password is a match, the count will be 1

						if($count==1){
						// If everything checks out, you will now be forwarded to admin.php
						$user = mysqli_fetch_assoc($result);
						 $_SESSION['admin_id'] = $user['admin_id'];
						header("location:admin.php");
						}
						//If the username or password is wrong, you will receive this message below.
						else {
						echo "Wrong Username or Password<br><br>Return to <a href=\"index.php\">login</a>";
						}

						ob_end_flush();

					?>
				</div>
				<div id="footer">
  					<div class="bottom_addr">&copy; 2017 Simple PHP Polling System. All Rights Reserved</div>
				</div>
			</div>
	</body>
</html>
