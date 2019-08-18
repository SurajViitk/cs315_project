<!DOCTYPE html>
<html>
<body>
	<p>
SUCCESSS
ITS HOME
</p>

<?php 
	session_start();
	// echo $_SESSION['pass'] ;
	if (!isset($_SESSION["user"])) {
	 	header("Location: login.php");
	}
 	echo "<p>Hi, the guy whose phone no. is ".$_SESSION['user']."</p>";
?>
<a href="registerfir.php">Register new FIR</a>
<a href="profile.php">View Profile</a>
<a href="viewfir.php">View your FIRs</a>
<a href="logout.php">logout</a>
</body>
</html>