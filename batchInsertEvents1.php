<?php

//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

	$mysqli =  new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);



//print_r($_POST);

$all = explode("****",$_POST[everything]);

foreach ($all as $event)
  {
  $attribs = explode("%^&",$event);
print_r($attribs);



	$stmt = $mysqli->prepare("INSERT INTO Events (name, time, description, building, room, uid, genre, date, orgName, approved) VALUES (?,?,?,?,?,?,?,?,?,1)");
	
	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}
	$name = htmlspecialchars($attribs[0]);
	    $time = htmlspecialchars($attribs[3]);
	    $desc = htmlspecialchars($attribs[8]);
	    $building = htmlspecialchars("220 college street");
	    $room = htmlspecialchars("202");
	    $uid = htmlspecialchars(2);
	    $genre = htmlspecialchars($attribs[6]);
	    $date = htmlspecialchars($attribs[2]);
	    $orgName = htmlspecialchars("Casual Tuesdays");
	
	if (!$stmt->bind_param("sssssdsss",$name,$time,$desc,$building,$room,$uid,$genre,$date,$orgName)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}






  }















//print_r( $a);


?>