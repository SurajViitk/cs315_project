<!DOCTYPE html>
<html>
<body>
	<p>
SUCCESSS
ITS HOME
</p>

<?php 
	session_start();
	if (!isset($_SESSION["puser"]))
	{
		header("Location: plogin.php");
	}
	echo "<p>police ID ".$_SESSION['puser']."</p>";

	require("sql_login.php");
	
	$phone=$_SESSION['puser'];
	
	$sql = ( "SELECT * FROM Incharge WHERE Police_ID=".$phone );
	
	$temp = $conn->query($sql);
	$r = $temp->fetch_assoc();
	
	$sql_police_ID=$r['Police_ID'];
	$sql_police_St_no = $r['Police_Station_No'];



	if($sql_police_ID!=NULL)
	{

		$_SESSION['ps_no'] = $sql_police_St_no;
		echo "<div>";
		$sql1 =  "SELECT * FROM FIR WHERE Police_Station_No=".$sql_police_St_no." and FIR_No not in (select FIR_No from General_Diary)" ;
	
		$temp = $conn->query($sql1);
		

		if($temp->num_rows>0)
		{
			echo "<table border='1'>";	
			echo "<tr>";
			echo "<td><h3>FIR Number</h3></td>";
			echo "<td><h3>Description</h3></td>";
			echo "<td><h3>Assign Investigating Officer</h3></td>";
			echo "</tr>";

			while($row = $temp->fetch_assoc())
			{
				if(!empty($_POST[$row['FIR_No']]))
				{	
					
					$sttr = 'police'.$row['FIR_No'];
					echo $_POST[$sttr];
					$sql5 = "select Police_ID from Police_Officer,People where People.Aadhar_ID = Police_Officer.Aadhar_ID and Full_Name = '".$_POST[$sttr]."'";
					$temp5 = $conn->query($sql5);
					$tow = $temp5->fetch_assoc();
					echo "<br>";
					echo $tow['Police_ID'];
					$sql1 =  "INSERT INTO General_Diary values(".$row['FIR_No'].", ".$tow['Police_ID'].")" ;
	
					if($conn->query($sql1)==True)
					{
							// do nothing
					}

					continue;

				}
				echo "<tr>";
				echo "<td>".$row['FIR_No']."</td>";
				echo "<td>".$row['FIR_Description']."</td>";
				
				echo "<td>";
				echo "<form action='' method='POST'>";
				echo "<select name='police".$row['FIR_No']."' >";
				
				$sql2 = "select Full_Name from People,Police_Officer where People.Aadhar_ID = Police_Officer.Aadhar_ID and Police_Officer.Police_Station_No =".$sql_police_St_no;
				
				$temp2 = $conn->query($sql2);
				
				while($bow=$temp2->fetch_assoc())
				{
			        echo "<option>".htmlspecialchars($bow['Full_Name'])."</option>";
			    }
				
				echo "</select>";
				echo "<input type='submit' name='".$row['FIR_No']."' value='Confirm'>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";	

		}
		
		echo "</div>";

		echo"<hr><div>";
		echo"<a href = 'signup2.php'><h3>Register new Police Officers to your Police Station</h3></a>";
	}



	echo "<hr><div>";

	$sql3 =  "SELECT * FROM FIR WHERE FIR_No in (select FIR_No from General_Diary where Police_ID=".$phone.")" ;
	
	$temp = $conn->query($sql3);
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
			echo "<a href='pfir.php?fir=".$row['FIR_No']."'>View</a>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";	

	}
	echo "</div>";
?>
<a href="plogout.php">logout</a>
</body>
</html>