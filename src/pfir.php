<!DOCTYPE html>
<html>
<body>
<?php 
	session_start();
	if (!isset($_SESSION["puser"]))
	{
		header("Location: plogin.php");
	}
	require("sql_login.php");
	$phone=$_SESSION['puser'];
	$fir_no = $_REQUEST['fir'];
	//fir details
	$sql = ("SELECT Phone_Number, FIR_Description, Status, FIR_Date FROM FIR WHERE FIR_NO=".$fir_no);
	$temp = $conn->query($sql);
	$a = $temp->fetch_assoc();
	echo "FIR NO : ".$fir_no."<br>FIR Description : ".$a['FIR_Description']."<br>FIR Date : ".$a['FIR_Date']."<br>Status : ".$a['Status']."<br>Phone Number : ".$a['Phone_Number'];
	echo "<br>--------------------------------------------<br>";
	//fir updates
	$sql = ("SELECT Update_No, Description FROM Updates WHERE FIR_NO = ".$fir_no." ORDER BY Update_No");
	$temp = $conn->query($sql);
	if($row = $temp->fetch_assoc())
	{
		echo "<table border='1'>";	
		echo "<tr>";
		echo "<td><h3>Update No</h3></td>";
		echo "<td><h3>Description</h3></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>".$row['Update_No']."</td>";
		echo "<td>".$row['Description']."</td>";
		echo "<tr>";

		while($row = $temp->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>".$row['Update_No']."</td>";
			echo "<td>".$row['Description']."</td>";
			echo "<tr>";
		}
		echo "</table>";
	}
	echo "<a href='update.php?fir=".$fir_no."'>Add new update</a>";
	//fir Properties
	$sql = ("SELECT Property_No, Description FROM Property WHERE FIR_NO = ".$fir_no);
	$temp = $conn->query($sql);
	if($row = $temp->fetch_assoc())
	{
		echo "<br>--------------------------------------------<br>";
		echo "<table border='1'>";	
		echo "<tr>";
		echo "<td><h3>Property No</h3></td>";
		echo "<td><h3>Description</h3></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>".$row['Property_No']."</td>";
		echo "<td>".$row['Description']."</td>";
		echo "<tr>";

		while($row = $temp->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>".$row['Property_No']."</td>";
			echo "<td>".$row['Description']."</td>";
			echo "<tr>";
		}
		echo "</table>";
	}
	//fir suspects
	$sql = ("SELECT Suspect_No, Description FROM Suspect WHERE FIR_NO = ".$fir_no);
	$temp = $conn->query($sql);
	if($row = $temp->fetch_assoc())
	{
		echo "<br>--------------------------------------------<br>";
		echo "<table border='1'>";	
		echo "<tr>";
		echo "<td><h3>Suspect No</h3></td>";
		echo "<td><h3>Description</h3></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>".$row['Suspect_No']."</td>";
		echo "<td>".$row['Description']."</td>";
		echo "<tr>";

		while($row = $temp->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>".$row['Suspect_No']."</td>";
			echo "<td>".$row['Description']."</td>";
			echo "<tr>";
		}
		echo "</table>";
	}
	//fir victims
	$sql = ("SELECT Aadhar_ID, Victim_detail FROM Victims WHERE FIR_NO = ".$fir_no);
	$temp = $conn->query($sql);
	if($row = $temp->fetch_assoc())
	{
		echo "<br>--------------------------------------------<br>";
		echo "<table border='1'>";	
		echo "<tr>";
		echo "<td><h3>Aadhar Number</h3></td>";
		echo "<td><h3>Details</h3></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>".$row['Aadhar_ID']."</td>";
		echo "<td>".$row['Victim_detail']."</td>";
		echo "<tr>";

		while($row = $temp->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>".$row['Aadhar_ID']."</td>";
			echo "<td>".$row['Victim_detail']."</td>";
			echo "<tr>";
		}
		echo "</table>";
	}
?>
<br>
<a href="phome.php">Go back to home</a>
</body>
</html>