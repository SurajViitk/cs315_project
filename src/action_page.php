<html>
<body>

<?php
$servername = "localhost";
$username = "cs315";
$password = "@Passw12";
$dbname = "cs315_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pic = $_FILES["pic"]["name"];

if(!$pic)
{
	$target_file = "NULL";
}
else
{
	$target_dir = "/home/vaibhav/";
	$target_file = '"'.$target_dir.basename($_FILES["pic"]["name"]).'"';

	if (file_exists($target_file)) {
		die("Sorry, file already exists.");
	}
	$moved = move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
}

$Full_name = $_POST["Full_name"];
$date = $_POST["date"];
$month = $_POST["month"];
$year = $_POST["year"];
$Father_name = $_POST["Father_name"];
$password = $_POST["password"];
$passwd = $_POST["passwd"];
if($password != $passwd)
{
	die("passwords don't match");
}
$Gender = $_POST["Gender"];
$Aadhar_number = $_POST["Aadhar_Number"];
$Occupation = $_POST["Occupation"];
$handicap = $_POST["Ph_handi"];
$Phonenumber = $_POST["Phone_Number"];

$sql = 'insert into People values("'.$Aadhar_number.'","'.$Full_name.'","'.$Father_name.'","'.$Occupation.'",'.$handicap.',"'.$Gender.'","'.$year.'-'.$month.'-'.$date.'",'.$target_file.')';
$vai = $conn->query($sql);
$site_salt="surajsalt";
$vai = hash('sha256',$password.$site_salt);

$sql = 'insert into User values("'.$vai.'",'.$Phonenumber.')';
$vai = $conn->query($sql);

$today = date("Y-m-d");

$sql = 'insert into Registration values("'.$Phonenumber.'","'.$Aadhar_number.'","'.$today.'")';
$conn->query($sql);

header("Location: login.php");

$conn->close();
?>

</body>
</html>