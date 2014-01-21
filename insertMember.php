<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 



//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

$sql="INSERT INTO Organization (name, description, uid) VALUES ('$_POST[org]','','$_POST[user]')";

if (!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
}

echo "Added user " .$_POST[user]." to organization " .$_POST[org]."</br>";

?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
