<?php session_start(); ?>

<!DOCTYPE HTML>








<?php 
	session_start(); 
	//set up the connection to the database
	define('DB_SERVER', 'panther.cs.middlebury.edu');
	define('DB_USERNAME', 'wschaaf');
	define('DB_PASSWORD', 'wschaaf');
	define('DB_DATABASE', 'wschaaf_Calendar');
	$events = $_POST['events'];

	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$stmt = $mysqli->prepare("INSERT INTO BelongsTo (orgName, uid) VALUES (?,?)");
	if (!$stmt) {
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}

	$e = htmlspecialchars($events);
	echo $e;

	//print_r($_POST);
/*
	if (!$stmt->bind_param("ss",$orgName,$memberUid)) {
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}
	else {
		echo "Added user " .$member_info ." to organization " .$orgName."</br>";
	}*/
?>

<html>
<head>
	<title>New Member</title>
</head>

<body>
	</br>
	<a href='./events'>Back to events</a>
</body>
</html>
