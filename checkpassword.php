<!DOCTYPE HTML>
<?php 
session_start();
// Print_r ($_SESSION);


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
	//print_r($user);
	if($user == null) {
		echo "Sorry your username or password was incorrect.</br>";
	}
	else {
		//print_r($_POST);
		echo "Welcome " .$_POST[email]."</br>";
		$_SESSION['User'] = $_POST[email];	
		$_SESSION['uid'] = $user['uid'];
		//print_r($_SESSION);		
	}
	
}
?>


<html>
</br>
<a href='./events'>Back to events</a>

</html>
