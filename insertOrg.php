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

	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	$stmt = $mysqli->prepare("INSERT INTO Organizations (name, description) VALUES (?,?)");

	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}
	$name = $_POST['name'];

	$description = $_POST['description'];


	if (!$stmt->bind_param("ss",$name,$description)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}

	$stmt2 = $mysqli->prepare("INSERT INTO BelongsTo (orgName, uid) VALUES (?,?)");

	if (!$stmt2){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}
	

	$uid = $_SESSION['uid'];


	if (!$stmt2->bind_param("ss",$name,$uid)){
		echo "Binding parameters failed: (" . $stmt2->errno . ")".$stmt2->error;
	}

	if (!$stmt2->execute()){
		echo "Execute failed: (" . $stmt2->errno . ")".$stmt2->error;
	}

	echo "Added organization " .$_POST[name];
	
}
?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>