<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 


//set up the connection to the database
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'wschaaf');
define('DB_PASSWORD', 'wschaaf');
define('DB_DATABASE', 'wschaaf_Calendar');

$org_info = explode("&",$_POST[org]);
$member_info = explode("&",$_POST[user]);


$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	$stmt = $mysqli->prepare("INSERT INTO BelongsTo (orgName, uid) VALUES (?,?)");

	if (!$stmt){
		echo "Prepare failed: (".$mysqli->errno . ") ".$mysqli->error;
	}
	$orgName = $org_info[0];
	$memberUid = $member_info[0];



	if (!$stmt->bind_param("ss",$orgName,$memberUid)){
		echo "Binding parameters failed: (" . $stmt->errno . ")".$stmt->error;
	}
	if (!$stmt->execute()){
		echo "Execute failed: (" . $stmt->errno . ")".$stmt->error;
	}else{
	  $org_name = explode("&",$_POST[org]);
echo "Added user " .$member_info[1]." to organization " .$org_info[0]."</br>";
	}






?>

<html>
</br>
<a href='./events'>Back to events</a>

</html>
