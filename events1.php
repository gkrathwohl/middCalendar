<?php session_start(); ?>  

<?php 


//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$today  = date_create("$today");
$date1 = $today;
$date2 = date_add($today,date_interval_create_from_date_string("6 days"));

//sql query selects all events between today's date and 6 days from now
$sql="SELECT * FROM Events WHERE date BETWEEN '".date_format($date,"Y-m-d")."' AND '".date_format($date1,"Y-m-d")."' AND approved=1";


if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

echo "<pre id = 'events' >";

while ($row = mysqli_fetch_array($result)) {
 print_r($row);
 echo "<br>";
}
echo "hi";
echo "</pre>";

?>