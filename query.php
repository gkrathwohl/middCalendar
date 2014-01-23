<?php 
	session_start();
	//set up the connection to the database
	define('DB_SERVER','panther.cs.middlebury.edu');
	define('DB_USERNAME','wschaaf');
	define('DB_PASSWORD','wschaaf');
	define('DB_DATABASE','wschaaf_Calendar');

	$genre = htmlspecialchars($_POST[my_dropdown]);
	$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
	$sql="SELECT * from Events WHERE genre = '$genre'";
	if (!mysqli_query($con,$sql)) {
		die('Error: ' . mysqli_error());
	}
	else {
		//execute the SQL query
		$result = mysqli_query($con,$sql);
	}
	
	echo $genre.":<br>";
	while ($row = mysqli_fetch_array($result)) {
		echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
		echo "Date: ".$row[date]."<br>";
	
	}
	//close connection
	mysql_close($con)
?>

<html>
<head>
	<title>Search Results</title>
</head>

<body>
	</br>
	<a href='./events'>Back to events</a>
</body>
</html>
