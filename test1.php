
<?php


//get contents of events feed
$xmlString = file_get_contents('http://25livepub.collegenet.com/calendars/all-campus-events.rss');

//
$xml = new SimpleXMLElement($xmlString);

//print_r($xml->channel->item[4]);

$items = $xml->channel->item;


//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$mysqli =  new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


//print_r(explode("<br/>",$items[70]->description));

//echo (string) ($items[40]->description);


//print_r($items[55]);

//echo "<br/>";

preg_match('/Event Title.*?<br/', (string) $items[40]->description, $matches);

//echo htmlspecialchars(substr($matches[0],22,-4));

//echo "</br>";
$date = htmlspecialchars(str_replace("/","-",substr($items[40]->category, 0, 10)));
//echo $date;


//$desc = htmlspecialchars(preg_match("/<br[/]><br[/]>"/, $event->description, $matches);
//echo $matches[0];


foreach($items as $event){

	$stmt = $mysqli->prepare("INSERT INTO Events (name, time, description, building, room, uid, genre, date, orgName, approved) VALUES (?,?,?,?,?,?,?,?,?,1)");
	
	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}

//get event name from description
preg_match('/Event Title.*?<br/', (string) $event->description, $matches);
$name = htmlspecialchars(substr($matches[0],22,-4));
	    
//get date from catagories
$date = htmlspecialchars(str_replace("/","-",substr($event->category, 0, 10)));



$time = htmlspecialchars("4:34");

	
	   
	$a =  explode("<br/>", $event->description);
	$desc = $a[3];




	    $building = htmlspecialchars("220 college street");
	    $room = htmlspecialchars("202");
	    $uid = htmlspecialchars(2);
	    $genre = htmlspecialchars("dance");
	    
	    $orgName = htmlspecialchars("Casual Tuesdays");
	
	if (!$stmt->bind_param("sssssdsss",$name,$time,$desc,$building,$room,$uid,$genre,$date,$orgName)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}
}






?>
