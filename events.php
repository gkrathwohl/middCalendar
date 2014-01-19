<?php

//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$sql="SELECT * FROM Events";

if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

echo "Events: <br>";
while ($row = mysqli_fetch_array($result)) {
 
 //print result
 echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
}

//Create a session varible to store user data
session_start();
if(isset($_SESSION['User']))
	echo "Welcome  .$_SESSION['User']<br>";
	echo "<a href='./CreateEvent.php'>Create Event</a></br>"
	echo "<a href='./logout'>Don't forget to logout</a><br>";
else
	$_SESSION['User'] = null;
	echo "<a href='./login.php'>Log In</a></br>"
	echo "<a href='./CreateUser.php'>Create User</a></br>"
	

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
