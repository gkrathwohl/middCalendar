  <?php 
session_start();
//start session
//must happen before anything else on the page

//print_r($_SESSION);

//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

//get todays date in form (y-m-d)
$date = getdate();
$today = $date['year']."-".$date['mon']."-".$date['mday'];
$date1 = date_create("$today");


//make array of week
$t = date_create("$today");
for ($x=1; $x<=6; $x++)
  {
   date_add($t,date_interval_create_from_date_string("1 days"));
   $days[]=date_format($t,"Y-m-d");
  } 
//print_r($days);

//get date 6 days from today (to create a week, including today)
$date=date_create("$today");
date_add($date,date_interval_create_from_date_string("6 days"));
//echo "Seven days from now is: ".date_format($date,"Y-m-d")."</br>";

//sql query selects all events between today's date and 6 days from now
$sql="SELECT * FROM Events WHERE date BETWEEN '".date_format($date1,"Y-m-d")."' AND '".date_format($date,"Y-m-d")."' AND approved=1";


if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}


echo "</br>Events in the Next 7 days: </br>";
while ($row = mysqli_fetch_array($result)) {
 //for each event, display its name as a link to detailed event info, with eid in the url
// echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
$byDate[$row['date']][]=$row;
}

//print_r($byDate);

$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');

echo "</br>";
echo "<table border=1>";
echo "<tr>";
foreach($byDate as $key => $value)
  {
echo "<td>";
  echo $key."</br>";
  echo $days[date( "w", strtotime($key))]."</br></br>";
  foreach($value as $event){
	echo "<a href='./eventInfo.php?eid=".$event['eid']."'>".$event['name']."</a><br>";
  }
echo "</td>";
  }
echo "</tr>";
echo "</table>";


//Display events
//echo "</br>Events in the Next 7 days: </br>";
//while ($row = mysqli_fetch_array($result)) {
 //for each event, display its name as a link to detailed event info, with eid in the url
// echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
//}




//link to search page
echo "</br></br><a href='./search.php'>Search Events</a></br>";


//if session user is set (from logging in), show link to create event and log out
if(isset($_SESSION['User'])){
	echo "Welcome  ".$_SESSION['User']."</br>";
	echo "<a href='./CreateEvent.php'>Create Event</a></br>";
	echo "<a href='./logout.php'>Don't forget to logout</a><br>";
	echo "<a href='./approveEvents.php'>Approve Events</a></br>";
}
else{ //if session user is not set, show link to log in and to create user
	$_SESSION['User'] = null;
	echo "<a href='./login.php'>Log In</a></br>";
	echo "<a href='./CreateUser.php'>Create User</a></br>";
}
	

//view session data:
//print_r($_SESSION);


//close connection
mysql_close($con)


?>
<style>
table{
border=1;
border-collapse:collapse;
}
td{
vertical-align:top;
}
</style>
<!DOCTYPE HTML>
<html>


<body>

</body>
</html>
