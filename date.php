<?php session_start(); ?>

<?php

if(isset($_GET["date"]))
    {
        $date = $_GET["date"];
    }


//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

$sql="SELECT * FROM Events WHERE date = '".$date."' AND approved = 1";

if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}


while ($row = mysqli_fetch_array($result)) {
 //print result
 echo "Name: ".$row['name']."  </br> Location: ".$row['building']."  </br> Date: ".$row['date']."  </br> Time: ".$row['time']." </br> Genre: ".$row['genre']." </br> Description: ".$row['description']."</br> </br>";
}


?>



<html>
</br>
<a href='./events'>Back to events</a>

</html>
