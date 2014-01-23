<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 


//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

	$mysqli =  new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$stmt = $mysqli->prepare("INSERT INTO Events (name, time, description, building, room, uid, genre, date, orgName) VALUES (?,?,?,?,?,?,?,?,?)");
	
	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}
	$name = htmlspecialchars($_POST[name]);
	    $time = htmlspecialchars($_POST[time]);
	    $desc = htmlspecialchars($_POST[description]);
	    $building = htmlspecialchars($_POST[building]);
	    $room = htmlspecialchars($_POST[room]);
	    $uid = htmlspecialchars($_POST[uid]);
	    $genre = htmlspecialchars($_POST[genre]);
	    $date = htmlspecialchars($_POST[date]);
	    $orgName = htmlspecialchars($_POST[orgName]);
	
	if (!$stmt->bind_param("sssssdsss",$name,$time,$desc,$building,$room,$uid,$genre,$date,$orgName)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}

//$sql="INSERT INTO Events (name, time, description, building, room, uid, genre, date, orgName) VALUES ('$_POST[name]','$_POST[time]','$_POST[description]', '$_POST[building]', '$_POST[room]', '$_POST[uid]', '$_POST[genre]', '$_POST[date]', '$_POST[orgName]')";

//if (!mysqli_query($con, $sql)){
//    die('Error: ' . mysqli_error($con));
//}
echo "Added event " .$_POST[name];



?>

<html>
	</br>
	<a href='./events'>Back to events</a>
</html>
