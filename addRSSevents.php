
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

//     \d\d?(:\d\d)?\s?(AM|PM|am|pm)?\s?-\s?\d\d?(:\d\d)?\s?(AM|PM|am|pm)



foreach($items as $event){

	$stmt = $mysqli->prepare("INSERT INTO Events (name, time, description, location, uid, genre, date, orgName, approved) VALUES (?,?,?,?,?,?,?,?,1)");
	
	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}

//get event name from description
preg_match('/Event Title.*?<br/', (string) $event->description, $matches);
$name = htmlspecialchars(substr($matches[0],22,-4));
	    
//get date from catagories
$date = htmlspecialchars(str_replace("/","-",substr($event->category, 0, 10)));



//$time = htmlspecialchars("4:34");

	
	   
	$a =  explode("<br/>", $event->description);
	$location = $a[0];
	$desc = $a[3];



//good ole regular expression to find the time. 
preg_match("/\d\d?(:\d\d)?(am|pm|AM|PM)?&nbsp;&ndash;&nbsp;\d\d?(:\d\d)?(am|pm|AM|PM)/", $event->description, $matches1);
//echo htmlspecialchars($items[41]->description);
echo "time </br>";

//split off before the & (of &nbsc;)
$atime = explode("&",$matches1[0]);
preg_match("/[^a-z]*/", $atime[0], $timeWithoutampm);
//echo $timeWithoutampm[0];

//see if is format 3:00 or 3. Needs to be 3:00
preg_match("/:/", $timeWithoutampm[0], $f);
if(count($f[0]) < 1){
$timeFormatted = $timeWithoutampm[0].":00";
}else{
$timeFormatted = $timeWithoutampm[0];
}

preg_match("/(pm|am|AM|PM)/", $matches1[0], $ampm);
//echo $atime[0];
//echo $ampm[0];
//echo "</br>";


$time = date("G:i", strtotime($timeFormatted." ".$ampm[0]));



	   // $building = htmlspecialchars("220 college street");
	   // $room = htmlspecialchars("202");
	    $uid = htmlspecialchars(1122334455);
	    $genre = htmlspecialchars("OldCalendar");
	    
	    $orgName = htmlspecialchars("Casual Tuesdays");
	
	if (!$stmt->bind_param("ssssdsss",$name,$time,$desc,$location,$uid,$genre,$date,$orgName)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}
}






?>
