<!DOCTYPE html>
<html>
<body>
<?php 
	session_start();
	if (!isset($_SESSION["user"]))
	{
		echo 'yo';header("Location: login.php");
	}
	require("sql_login.php");
	$phone=$_SESSION['user'];

	$sql =  "SELECT * FROM FIR WHERE Phone_Number = ".$phone;
	
	$temp = $conn->query($sql);
	if($temp != NULL)
	{
		echo "<table border='1'>";	
		echo "<tr>";
		echo "<td><h3>FIR Number</h3></td>";
		echo "<td><h3>Description</h3></td>";
		echo "<td><h3>Details</h3></td>";
		echo "</tr>";

		while($row = $temp->fetch_assoc())
		{

			echo "<tr>";
			echo "<td>".$row['FIR_No']."</td>";
			echo "<td>".$row['FIR_Description']."</td>";
			
			echo "<td>";
			echo "<a href='ufir.php?fir=".$row['FIR_No']."'>View</a>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>
<br>
<a href="home.php">Go back to home</a>
</body>
</html>