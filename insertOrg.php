<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 

if ($_SESSION[User] == null){
	echo "Must be logged in to create an orgasmization";
}
else{
	//set up the connection to the database
	define('DB_SERVER', 'panther.cs.middlebury.edu');
	define('DB_USERNAME', 'wschaaf');
	define('DB_PASSWORD', 'wschaaf');
	define('DB_DATABASE', 'wschaaf_Calendar');

	$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");

	$sql="INSERT INTO Organizations (name, description) VALUES ('$_POST[name]','$_POST[description]')";

	$sql2="INSERT INTO BelongsTo (orgName, uid) VALUES ('$_POST[name]','$_SESSION[uid]')";

	if (!mysqli_query($con, $sql)){
		die('Error: ' . mysqli_error($con));
	}
	if (!mysqli_query($con, $sql2)){
		die('Error: ' . mysqli_error($con));
	}
	echo "Added organization " .$_POST[name];
	
}
?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
