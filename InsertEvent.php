<?php 
	session_start();
	//set up the connection to the database
	define('DB_SERVER', 'panther.cs.middlebury.edu');
	define('DB_USERNAME', 'wschaaf');
	define('DB_PASSWORD', 'wschaaf');
	define('DB_DATABASE', 'wschaaf_Calendar');
	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$stmt = $mysqli->prepare("INSERT INTO Events (name, time, description, location, uid, genre, date, orgName) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}

	$name = htmlspecialchars($_POST[name]);
	$time = htmlspecialchars($_POST[time]);
	$desc = htmlspecialchars($_POST[description]);
	$location = htmlspecialchars($_POST[location]);
	$uid = htmlspecialchars($_POST[uid]);
	$genre = htmlspecialchars($_POST[genre]);
	$date = htmlspecialchars($_POST[date]);
	$orgName = htmlspecialchars($_POST[orgName]);

	if (!$stmt->bind_param("ssssdsss",$name, $time, $desc, $location, $uid, $genre, $date, $orgName)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}
	echo "Added event " .$_POST[name];



?>

<html>
<head>
	<title>Event Created</title>
</head>

<body>
	</br>
	<a href='./events'>Back to events</a>
</body>
</html>
