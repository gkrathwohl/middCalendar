<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 



//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

$org_info = explode("&",$_POST[org]);
$member_info = explode("&",$_POST[user]);



$sql="INSERT INTO BelongsTo (orgName, uid) VALUES ('$org_info[0]','$member_info[0]')";

if (!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
}

$org_name = explode("&",$_POST[org]);
echo "Added user " .$member_info[1]." to organization " .$org_info[0]."</br>";

?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
