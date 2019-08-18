<!DOCTYPE html>
<html>
<body>
	<p>
SUCCESSS
ITS HOME
</p>

<?php 
	session_start();
	if (!isset($_SESSION["auser"])) {
 		header("Location: alogin.php");
	}
 	echo "<p>Hi, Admin ".$_SESSION['auser']."</p>";
?>
<h2>Search queries</h2>
<form action="q_results.php" method="POST">
<table>
<tr>
<td><textarea rows="4" cols="50" name="query"></textarea></td>
</tr>
</table>
<input type="submit" value="Show results" name='1'>
<input type="submit" value="Save results" name='2'>
</form>
<a href="alogout.php">logout</a>
</body>
</html>