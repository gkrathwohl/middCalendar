<!DOCTYPE HTML>
<?php 

//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

$sql = "SELECT * FROM Users WHERE email='$_POST[email]' AND password='$_POST[pw]'";


if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
}
else {
	$result = mysqli_query($con, $sql);
	$user = mysqli_fetch_array($result);
	//echo $result;
	if($user == null) {
		echo "Sorry your username or password was incorrect.";
	}
	else {
		echo "Welcome " .$_POST[name];
		$_SESSION['User'] = $_POST[name];		
	}
	
}
?>


<html>
</br>
<a href='./events'>Back to events</a>

</html>

