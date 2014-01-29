<?php session_start(); ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Event Updated</title>
</head>

<body>
	<?php
		//set up the connection to the database
		define('DB_SERVER', 'panther.cs.middlebury.edu');
		define('DB_USERNAME', 'wschaaf');
		define('DB_PASSWORD', 'wschaaf');
		define('DB_DATABASE', 'wschaaf_Calendar');
		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		$eid = htmlspecialchars($_POST[eid]);
		$name = htmlspecialchars($_POST[name]);
		$time = htmlspecialchars($_POST[time]);
		$desc = htmlspecialchars($_POST[description]);
		$location = htmlspecialchars($_POST[location]);
		$genre = htmlspecialchars($_POST[genre]);
		$date = htmlspecialchars($_POST[date]);
		$orgName = htmlspecialchars($_POST[orgName]);
		$sql = 'UPDATE Events SET name="'.$name.'", time="'.$time.'", description="'.$desc.'", location="'.$location.'", genre="'.$genre.'", date="'.$date.'", orgName="'.$orgName.'" WHERE eid="'.$eid.'"';
		if (!mysqli_query($con, $sql)) {
		    die('Error: ' .mysqli_error());
		}
		else {
		   echo "Thank you for updating " .$name .".</br>";
		}
	?>
	<a href='./events'>Back to home</a>
</body>
</html>
