<?php session_start(); ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Update Events</title>
</head>

<body>
	<?php
		if(isset($_GET["eid"])) {
			$eid = $_GET["eid"];
		}
		define('DB_SERVER','panther.cs.middlebury.edu');
		define('DB_USERNAME','wschaaf');
		define('DB_PASSWORD','wschaaf');
		define('DB_DATABASE','wschaaf_Calendar');
		$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
		if(isset($_SESSION['User'])) {
			$sql = "SELECT * FROM Events WHERE eid='".$eid ."' AND uid='" .$_SESSION['uid'] ."'";
			if (!mysqli_query($con,$sql)) {
				die('Error: ' . mysqli_error());
			}
			else {
				$result = mysqli_query($con,$sql);
				while ($row = mysqli_fetch_row($result)) {
					$genres = array("Dance", "Party", "Clam Bake", "Pineapple", "Sports");
					echo "<form action='correctEvent.php' id='updateEvent' method='post'>";
					echo "<input type='hidden' name='eid' value='".$eid."'/> <br>";
					echo 'Event Name: <input type="text" name="name" value="'.$row[1].'"/> <br>';
					echo "Date: <input type='date' name='date' value='".$row[9]."'/> <br>";       
					echo "Time: <input type='time' name='time' value='".$row[2]."'/> <br>";
					echo 'Location: <input type="text" name="location" value="'.$row[5].'"/> <br>';
					echo "Select Genre: <select name='genre' form='updateEvent'>";
					foreach($genres as $g) {
						if($g == $row[8]) {
							echo "<option value='".$g."' default selected>".$g."</option>";
						}
						else {
							echo "<option value='".$g."'>".$g."</option>";
						}
					}
					echo "</select> <br>";
					echo "Organization: <select name='orgName' form='updateEvent'>";				
					$sql2="SELECT * FROM BelongsTo WHERE uid='".$_SESSION['uid']."'";
					if (!mysqli_query($con,$sql2)) {
						die('Error: ' . mysqli_error());
					}
					else {
						$result2 = mysqli_query($con,$sql2);
					}
					while ($row2 = mysqli_fetch_array($result2)) {
						if($row2[orgName] == $row[10]) {
							echo "<option value='".$row2[orgName]."' default selected>".$row2[orgName]."</option>";
						}
						else {
							echo "<option value='".$row2[orgName]."'>".$row2[orgName]."</option>";
						}
					}
					echo "</select><br>";
					echo '<textarea name="description" rows="5" cols="40">'.$row[4].'</textarea> <br>';
					echo "<input type='submit' value='Update Event!'/> <br> <br>";	
				}
			}
		}
		else {
			echo "<p>Sorry you must be logged in to update events.</p>";
		}
	?>
</body>
</html>
