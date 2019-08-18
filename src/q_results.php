<html>
<head>
</head>
<body>
<p>
<?php 
	session_start();
	if (!isset($_SESSION["auser"])) {
 	header("Location: alogin.php");
	}
    echo "<p>Hi, Admin ".$_SESSION['auser']."</p>";

    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 1);
    error_reporting(0);

    $servername = "localhost";
    $username = "cs315";
    $password = "@Passw12";
    $dbname = "cs315_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "<p>";
    if($_POST['1'])
    {
        if(empty($_POST['query']))
        {
            echo "Input query";
        }
        else
        {
            $sql = $_POST['query'];
            $result = $conn->query($sql);
            echo "<br>";
            echo "<table border='1'>";
            if ($result->num_rows > 0) 
            {
                echo '<tr>';
                foreach (mysqli_fetch_fields($result) as $meta)
                {
                    echo '<td>' . $meta->name . '</td>';
                }
                echo '</tr>';
                // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    foreach ($row as $field => $value) 
                    { 
                        echo "<td>" . $value . "</td>";  
                    }
                    echo "</tr>";
                }
            }
            else
            {
                echo "No records found";
            } 
        }
    }
    else if($_POST['2'])
    {
        if(empty($_POST['query']))
        {
            echo "Input query";
        }
        else
        {
            $sql = $_POST['query'];
            $result = $conn->query($sql);
            $json_array = array();
            if ($result->num_rows > 0) 
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $json_array[] = $row;
                }
            }
            else
            {
                echo "No records found";
            } 
            $fp = fopen('results.json', 'w');
            fwrite($fp, json_encode($json_array));
            fclose($fp);
            echo "Results saves in \"results.json\" in home directory";
        }
    }
?>
</p>
<a href="query_search.php">Go Back</a><br>
<a href="alogout.php">logout</a>
</body>
</html>