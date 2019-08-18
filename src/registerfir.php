<!DOCTYPE html>
<html>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "cs315";
$password = "@Passw12";
$dbname = "cs315_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<?php 
    session_start();
    if (!isset($_SESSION["user"]))
    {
        echo 'yo';header("Location: login.php");
    }
    echo "<p>phone number ".$_SESSION['user']."</p>";

    require("sql_login.php");
    
    $phone=$_SESSION['user'];
?>

<h2>Register FIR</h2>
<form action="" method="POST">
Choose nearest Police station:<br>
<table>
<tr>
<td>State:</td>
<td>
<select name="ps_state" >
<?php
    
    if($_POST['ps_state']){
        echo "<option>".($_POST['ps_state'])."</option>";
    }
    else{
    $sql1 = "select distinct State from Police_Station"; 
    $result =   $conn->query($sql1);
    while($row=$result->fetch_assoc()){
        echo "<option>".htmlspecialchars($row["State"])."</option>";
    }
    }
?>
</select>
</td>
<td><input type="submit" name="state" value="Submit State"></td>
</tr>
<td>District:</td>
<td><select name="ps_district"  >
     
<?php
    if(empty($_POST['ps_state']))
    {

    }
    else if ($_POST['ps_district']){

        echo "<option>".($_POST['ps_district'])."</option>";
    }
    else
    {

        $state = $_POST['ps_state'];
        $sql1 = "select distinct District from Police_Station where State like '%".$state."%'"; 
        $result =   $conn->query($sql1);
        while($row=$result->fetch_assoc()){
            echo "<option>".htmlspecialchars($row["District"])."</option>";
        }
    }

?>

    </select>
</td>
<td><input type="submit" name="district" value="Submit District"></td>
    </tr>

    <tr>
    <td>
    City:
    </td>
    <td>
    <select name="ps_city"  >
<?php
    if(empty($_POST['ps_state']) or empty($_POST['ps_district']))
    {

    }
    else if($_POST['ps_city']){

        echo "<option>".($_POST['ps_city'])."</option>";
    }
    else
    {

        $state = $_POST['ps_state'];
        $district = $_POST['ps_district'];
        $city = $_POST['ps_city'];
        $sql1 = "select distinct City from Police_Station where State like '%".$state."%' and District like '%".$district."%'and City like '%".$city."%'"; 
        $result =   $conn->query($sql1);
        while($row=$result->fetch_assoc()){
            echo "<option>".htmlspecialchars($row["City"])."</option>";
        }
    }

?>
    </select>
    </td>
    <td><input type="submit" name="city" value="Submit City"></td>
    </tr>

    <tr>
    <td>  
    Police Station Name:
    </td>
    <td>
    <select name="ps_name"  >
<?php
    if(empty($_POST['ps_state']) or empty($_POST['ps_district']) or empty($_POST['ps_city']))
    {

    }
    else if($_POST['ps_name']){

        echo "<option>".($_POST['ps_name'])."</option>";
    }
    else
    {

        $state = $_POST['ps_state'];
        $district = $_POST['ps_district'];
        $city = $_POST['ps_city'];
        $ps = $_POST['ps_name'];
        $sql1 = "select distinct Police_Station_Name from Police_Station where State like '%".$state."%' and District like '%".$district."%'and City like '%".$city."%'and Police_Station_Name like '%".$ps."%'"; 
        $result =   $conn->query($sql1);
        while($row=$result->fetch_assoc()){
            echo "<option>".htmlspecialchars($row["Police_Station_Name"])."</option>";
        }
    }

?>   
    </select>
    </td>
    <!-- <td><input type="submit" name="city" value="Submit City"></td> -->
    </tr>
  </table>
  <br>
  Other details<br>

  <table>
    <tr>
      <td>
        Date of Incident:
      </td>
      <td>
                  <select name="date"  >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            <select name="month"  >
                <option value="1">Jan</option>
                <option value="2">Feb</option>
                <option value="3">Mar</option>
                <option value="4">Apr</option>
                <option value="5">May</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Aug</option>
                <option value="9">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
            </select>
            <select name="year"  >
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2003">2003</option>
                <option value="2002">2002</option>
                <option value="2001">2001</option>
                <option value="2000">2000</option>
                <option value="1999">1999</option>
                <option value="1998">1998</option>
                <option value="1997">1997</option>
                <option value="1996">1996</option>
                <option value="1995">1995</option>
                <option value="1994">1994</option>
                <option value="1993">1993</option>
                <option value="1992">1992</option>
                <option value="1991">1991</option>
                <option value="1990">1990</option>
                <option value="1989">1989</option>
                <option value="1988">1988</option>
                <option value="1987">1987</option>
                <option value="1986">1986</option>
                <option value="1985">1985</option>
                <option value="1984">1984</option>
                <option value="1983">1983</option>
                <option value="1982">1982</option>
                <option value="1981">1981</option>
                <option value="1980">1980</option>
                <option value="1979">1979</option>
                <option value="1978">1978</option>
                <option value="1977">1977</option>
                <option value="1976">1976</option>
                <option value="1975">1975</option>
                <option value="1974">1974</option>
                <option value="1973">1973</option>
                <option value="1972">1972</option>
                <option value="1971">1971</option>
                <option value="1970">1970</option>
                <option value="1969">1969</option>
                <option value="1968">1968</option>
                <option value="1967">1967</option>
                <option value="1966">1966</option>
                <option value="1965">1965</option>
                <option value="1964">1964</option>
                <option value="1963">1963</option>
                <option value="1962">1962</option>
                <option value="1961">1961</option>
                <option value="1960">1960</option>
            </select><br>
      </td>
    </tr>
    <tr>
      <td>
        Incident Description:
      </td>
      <td>
         <textarea rows="4" cols="50" name="Incident_desc"></textarea>
      </td>
    </tr>
    <tr>
      <td>
        Lost property Description (if any, Leave empty if NA, Separate multiple entries with semi-colons(;)):
      </td>
      <td>
         <textarea rows="4" cols="50" name="Lost_desc"></textarea>
      </td>
    </tr>
    <tr>
      <td>
        Suspect Description (Separate multiple entries with semi-colons(;)):
      </td>
      <td>
         <textarea rows="4" cols="50" name="Suspect_desc"  ></textarea>
      </td>
    </tr>
  </table>

  <input type="submit" value="Submit">
</form>
<p>
<?php
    if(empty($_POST['ps_state']) or empty($_POST['ps_district']) or empty($_POST['ps_city']) or empty($_POST['ps_name']) or empty($_POST['date'])or empty($_POST['month'])or empty($_POST['year'])or empty($_POST['ps_city']) or empty($_POST['Incident_desc']) or empty($_POST['Suspect_desc'])){
        echo "Input all values";
    }
    else{
        $state=$_POST['ps_state'];
        $district=$_POST['ps_district']; 
        $city=$_POST['ps_city'];
        $ps_name=$_POST['ps_name']; 
        $date=$_POST['date'];
        $month=$_POST['month'];
        $year=$_POST['year'];
        $city=$_POST['ps_city'];
        $in=$_POST['Incident_desc'];
        $ps_query = "select Police_Station_No from Police_Station where State like '%".$state."%' and District like '%".$district."%'and City like '%".$city."%'and Police_Station_Name like '%".$ps_name."%'"; 
        $temp = $conn->query($ps_query);
        $row = $temp->fetch_assoc();
        $ps_no=$row["Police_Station_No"];
        $sql = "INSERT INTO FIR (Police_Station_No, FIR_Description, Status,FIR_Date,Phone_Number) values('".$ps_no."','".$in."','Pending','".$year."-".$month."-".$date."', ".$phone.")";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $lost_arr = explode (";", $_POST["Lost_desc"]);
        $l_count = 1;
        foreach($lost_arr as $lo)
        {
            if(!empty($lo))
            {
                $sql = "select FIR_No from FIR where Police_Station_No =".$ps_no." AND FIR_Description = '".$in."' AND FIR_Date = '".$year."-".$month."-".$date."'";
                // echo $sql;
                $temp = $conn->query($sql);
                $row = $temp->fetch_assoc();
                $FIR_No = $row["FIR_No"];
                $sql="INSERT INTO Property (Property_No, Description,FIR_No) values('".$l_count."','".$lo."','".$FIR_No."')";
                $l_count = $l_count + 1;
                if ($conn->query($sql) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $sus_arr = explode (";", $_POST["Suspect_desc"]);
        $s_count = 1;
        foreach($sus_arr as $sus)
        {   
            $sql="INSERT INTO Suspect (Suspect_No, Description,FIR_No) values('".$s_count."','".$sus."','".$FIR_No."')";
            $s_count = $s_count + 1;
            if ($conn->query($sql) === TRUE) {
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // header("Location: index1.html");
         echo"<meta http-equiv='Refresh' content='2; url=../home.php'>";
        die();
    }

?>
<br>
<a href="home.php">Home</a>
</p>
</body>
</html>