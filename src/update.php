<!DOCTYPE html>
<html>
<body>
	<form action="" method="POST">
	Description:
	<br>
	<textarea rows="4" cols="50" name="Update_desc"></textarea>
	<!-- <input type="number" name="Aadhar_Number"> -->
	<br>
	<input type="submit" value="Submit">
</form>
<?php 
	session_start();
	if (!isset($_SESSION["puser"]))
	{
		echo 'yo';header("Location: plogin.php");
	}
	require("sql_login.php");
	$phone=$_SESSION['puser'];
	$fir_no = $_REQUEST['fir'];
	// echo $fir_no;
	if(!empty($_POST["Update_desc"]))
	{
		$desc = $_POST["Update_desc"];
		$sql = "SELECT Update_No FROM Updates ORDER BY Update_No DESC";
		// echo $sql;
		$temp = $conn->query($sql);
		// echo $temp;
		$row = $temp->fetch_assoc();
		if(!$row)
		{
			$no = 1;
		}
		else
		{
			$no = $row["Update_No"] + 1;
		}
		// echo $no;
		$sql = "insert into Updates values(".$no.", '".$desc."', ".$fir_no.")";
		// echo $sql;
		$conn->query($sql);
	}
?>
<br>


<a href="phome.php">Go back to home</a>
</body>
</html>