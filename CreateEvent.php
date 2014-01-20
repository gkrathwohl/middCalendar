<html>
<?php
session_start();
echo "You are currently logged in as ".$_SESSION['User'];

//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$sql="SELECT * FROM Locations";

if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

echo "</br>";

while ($row = mysqli_fetch_array($result)) {
 //print result
 print_r($row['Building']);
}

?>



<head><title> College Database </title>
</head>

<body>

<br>

Create an Event: <br>
Please make something somewhat interesting

<br> <br>


<SCRIPT LANGUAGE="javascript">
function validate() {

	fm = document.thisForm

	//use validation here to make sure the user entered
	//the information correctly

	fm.submit()

}

</SCRIPT>

<!--This creates the insert boxes-->
<form action="insertEvent.php" method="post">
	Middlebury ID: <input type="text" name="uid" required value =" 
<?php echo $_SESSION['uid'];
 ?>

"/> 
<br>
	Event Name: <input type="text" name="name" required /> <br>
	Date: <input type="date" name="date" required /> <br>	
	Time: <input type="time" name="time" required /> <br>
	Building: <input type="text" name="building" required/> <br>
<select>
<php?

?>
	</select>
	Room: <input type="text" name="room" required /> <br>

 <!--This creates the drop down list-->
        <form name="thisForm" method="POST" action="insertEvent.php">
        <p>Select Genre: <select size="1" name="my_dropdown">
        <option value="Dance"> Dance </option>
        <option value="Party"> Party </option>
        <option value="Clam Bake"> Clam Bake </option>
        <option value="Pineapple"> Pineapple </option>
        <option value="drinking"> drinking </option>
         <option value="sports"> sports </option>

        </select></p>

	<textarea name="description" rows="5" cols="40" placeholder="Enter description here " required></textarea> <br>
	<input type="submit" value="Create Event!"/> <br> <br>
</form>

</body>

</html>


