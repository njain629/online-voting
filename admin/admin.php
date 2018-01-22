<?php
session_start();
global $con=mysqli_connect('localhost', 'root', '','poll');
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
	</head>
	<body bgcolor="tan">
		<center><b><font color = "brown" size="6">Simple PHP Polling System</font></b></center><br><br>
		<div id="page">
			<div id="header">
				<h1>ADMINISTRATION CONTROL PANEL </h1>
				<a href="admin.php">Home</a> | <a href="manage-admins.php">Manage Administrators</a> | <a href="positions.php">Manage Positions</a> | <a href="candidates.php">Manage Candidates</a> | <a href="refresh.php">Poll Results</a> | <a href="logout.php">Logout</a>
			</div>
			<p align="center">&nbsp;</p>
			<div id="container">
				<p>Click a link above to perform an administrative operation.</p>
			</div>
			<div id="footer">
				<div class="bottom_addr">&copy; 2017 Simple PHP Polling System. All Rights Reserved</div>
			</div>
		</div>
	</body>
</html>
