<?php

//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$date = getdate();
$today = $date['year']."-".$date['mon']."-".$date['mday'];
$today7 = $date['year']."-".$date['mon']."-".$date['mday'];


echo "Today is ".$today."</br>";


$date=date_create("$today");
date_add($date,date_interval_create_from_date_string("6 days"));
echo "Seven days from now is: ".date_format($date,"Y-m-d")."</br>";

$date1 = date_create("$today");


$sql="SELECT * FROM Events WHERE date BETWEEN '".date_format($date1,"Y-m-d")."' AND '".date_format($date,"Y-m-d")."' ";


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
 
 //print result
 echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
}

echo "</br></br><a href='./search.php'>Search Events</a></br>";

//Create a session varible to store user data

$SID = session_id(); 
if(empty($SID)) session_start() or exit(basename(__FILE__).'(): Could not start session'); 


if(isset($_SESSION['User'])){
	echo "Welcome  ".$_SESSION['User']."</br>";
	echo "<a href='./CreateEvent.php'>Create Event</a></br>";
	echo "<a href='./logout'>Don't forget to logout</a><br>";
}
else{
	
	$_SESSION['User'] = null;
	echo "<a href='./login.php'>Log In</a></br>";
	echo "<a href='./CreateUser.php'>Create User</a></br>";
}
	

print_r($_SESSION);


//close connection
mysql_close($con)


?>

<style>
tr{
height:100;
}
td{
width:100;
}

</style>


<html>
<body>
</br>
Next seven days:	
<table border=1>
<tr>
<td>
1
</td>
<td>
2
</td>
<td>
3
</td>
<td>
4
</td>
<td>
5
</td>
<td>
6
</td>
<td>
7
</td>
</tr>
</table>



</body>
</html>