<?php session_start(); ?>

<?php 


//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$sql="SELECT supervisor FROM Users WHERE uid = ".$_SESSION[uid];

if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 $result = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($result);

if($row['supervisor']==0){
	echo "must be supervisor to approve events";
}else{


$sql="SELECT * FROM Events WHERE date >= CURDATE() AND approved = 0";

if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

echo "</br>All unapproved events (where date >= curdate): </br>";
if(count($result) == 0){
echo "There are no unapproved events";
}else{
while ($row = mysqli_fetch_array($result)) {
 
 //print result
 echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a> <a href='./approve.php?eid=".$row['eid']."'>Approve</a> <br>";
}
}




}
}




?>