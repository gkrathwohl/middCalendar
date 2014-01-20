<!DOCTYPE HTML>
<?php 

//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

$sql="INSERT INTO Events (name, time, description, building, room, uid, genre, date) VALUES ('$_POST[name]','$_POST[time]','$_POST[description]', '$_POST[building]', '$_POST[room]', '$_POST[uid]', '$_POST[my_dropdown]', '$_POST[date]')";

if (!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
}
echo "Added event " .$_POST[name];
?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
