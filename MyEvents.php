<?php session_start(); ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>My Events</title>
</head>

<body>
	<?php
		define('DB_SERVER','panther.cs.middlebury.edu');
		define('DB_USERNAME','wschaaf');
		define('DB_PASSWORD','wschaaf');
		define('DB_DATABASE','wschaaf_Calendar');
		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		if(isset($_SESSION['User'])) {						
			$sql="SELECT * FROM Events WHERE uid='".$_SESSION['uid']."'";
			if (!mysqli_query($con,$sql)) {
				die('Error: ' . mysqli_error());
			}
			else {
				$result = mysqli_query($con,$sql);
				while ($row = mysqli_fetch_array($result)) {						
					echo "<b>Name:</b> ".$row['name'];
					echo "</br> <b>Location:</b> ".$row['location'];
					echo "</br> <b>Date:</b> ".$row['date'];
					echo "</br> <b>Time:</b> ".$row['time']; 
					echo "</br> <b>Genre: </b> ".$row['genre'];
					echo "</br><b>Description: </b> ".$row['description'];
					echo "</br><a href='./UpdateEvent.php?eid=".$row['eid']."'>Update ".$row['name']."</a></br>"; 
				}
			}
		}
		else {
			echo "Sorry you must be logged in to see your events.";
		}
	?>
</body>
</html>
