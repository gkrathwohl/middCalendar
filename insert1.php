<!DOCTYPE HTML>
<?php 

//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

$sql="SELECT * FROM Events WHERE name = '$_POST[Search]'";

if (!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

while ($row = mysqli_fetch_array($result)) {
 
 //print result
	echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
 	echo "Date: ".$row[date]."<br>";
 	
}

?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
