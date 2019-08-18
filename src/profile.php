<!DOCTYPE html>
<html>
<body>
<p>Your Profile : </p>

<?php 
	session_start();
	if (!isset($_SESSION["user"])) {
 		header("Location: login.php");
	}
	require('sql_login.php');
	$sql_1 = ("SELECT Aadhar_ID FROM Registration WHERE Phone_Number=".$_SESSION['user']);
	$temp = $conn->query($sql_1);
	$a = $temp->fetch_assoc();
	$sql=("SELECT Full_Name, Father_Name, Gender, Date_of_Birth FROM People WHERE Aadhar_ID=".$a['Aadhar_ID']);
	$tem = $conn->query($sql);
	$r = $tem->fetch_assoc();

	echo "Aadhar_ID : ".$a['Aadhar_ID']."<br>Full_Name : ".$r['Full_Name']."<br>Father_Name : ".$r['Father_Name']."<br>Gender : ".$r['Gender']."<br>Date_of_Birth : ".$r['Date_of_Birth']."<br>Phone Number : ".$_SESSION['user']."<br><br>";
?>

<a href="home.php">Home</a>

</body>
</html>