<!DOCTYPE html>
<html>
<body>
<form method="POST" action="login.php" style="border:1px solid black;display:table;margin:0px auto;padding-left:10px;padding-bottom:5px;">
 <table width="300" cellpadding="4" cellspacing="1">
  <tr><td><td colspan="3"><strong>User Login</strong></td></tr>
  <tr><td width="78">Phone No.</td><td width="6">:</td><td width="294"><input size="25" name="phone" type="text"></td></tr>
  <tr><td>Password</td><td>:</td><td><input name="pass" size="25" type="password"></td></tr>
  <tr><td></td><td></td><td><input type="submit" name="Submit" value="Login"></td></tr>
 </table>
</form>

<?php

session_start();
if(isset($_SESSION['user']) && $_SESSION['user']!='')
{
	header("Location:home.php");
}

if(!empty($_POST['phone']) and !empty($_POST['pass']))
{
	require("sql_login.php");
	$phone=$_POST['phone'];
	$password=$_POST['pass'];
	if(!is_numeric($phone))
	{
		echo "<h2>enter numeric value for phone</h2>";
	}
	else
	{
		$numlength = strlen((string)$phone);
		if($numlength!=10)
		{
			echo "<h2>Enter a 10 digit number</h2>";
		}
		else
		{
			if(isset($_POST) && $phone!='' && $password!='')
			{
				$sql=("SELECT Phone_Number, Password_Hash FROM User WHERE Phone_Number=".$phone);
				// echo $sql;
				$temp = $conn->query($sql);
				$r = $temp->fetch_assoc();
				// $r=$sql->fetch_assoc();
				$sql_phone=$r['Phone_Number'];
				$sql_pwd=$r['Password_Hash'];
				$site_salt="surajsalt";
				$salted_hash = hash('sha256',$password.$site_salt);
				
				if($sql_pwd==$salted_hash)
				{
					echo "SUCCESSFUL.....PLS WAIT..............LOGGING IN";
					$_SESSION['user']=$phone;
					echo"<meta http-equiv='Refresh' content='2; url=../home.php'>";
					$_SESSION['user']=$phone;
					// $_SESSION['pass'] =$salted_hash;
				}
				else
				{
					echo "<h2>Username/Password is Incorrect.</h2>";	
				}
			}
		}
	}
}
?>

</body>
</html>