<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 

//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

$sql="INSERT INTO Users (email, password, name, uid) VALUES ('$_POST[email]','$_POST[pw]','$_POST[name]', '$_POST[uid]')";

if (!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
}
echo "Added user " .$_POST[name];
$_SESSION['User'] = $_POST[name];
?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
