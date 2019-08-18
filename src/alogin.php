<!DOCTYPE html>
<html>
<body>
<form method="POST" action="alogin.php" style="border:1px solid black;display:table;margin:0px auto;padding-left:10px;padding-bottom:5px;">
 <table width="300" cellpadding="4" cellspacing="1">
  <tr><td><td colspan="3"><strong>User Login</strong></td></tr>
  <tr><td width="78">Phone No.</td><td width="6">:</td><td width="294"><input size="25" name="phone" type="text"></td></tr>
  <tr><td>Password</td><td>:</td><td><input name="pass" size="25" type="password"></td></tr>
  <tr><td></td><td></td><td><input type="submit" name="Submit" value="Login"></td></tr>
 </table>
</form>

<?php

session_start();
if(isset($_SESSION['auser']) && $_SESSION['auser']!='')
{
	header("Location:query_search.php");
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
		if(isset($_POST) && $phone!='' && $password!='')
		{
			if($phone=="315" && $password=="arnab")
			{
				echo "LOGIN SUCCESSFUL.....PLEASE WAIT........LOGGING IN";
				$_SESSION['auser']=$phone;
				echo"<meta http-equiv='Refresh' content='2; url=../query_search.php'>";
				$_SESSION['auser']=$phone;
			}
			else
			{
				echo "<h2>Username/Password is Incorrect.</h2>";	
			}
		}
	}
}
?>

</body>
</html>