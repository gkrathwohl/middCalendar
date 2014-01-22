<?php 
	session_start();    
    //set up the connection to the database
    define('DB_SERVER', 'panther.cs.middlebury.edu');
    define('DB_USERNAME', 'wschaaf');
    define('DB_PASSWORD', 'wschaaf');
    define('DB_DATABASE', 'wschaaf_Calendar');
    
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");
    $email = htmlspecialchars($_POST[email]);
    $pw = htmlspecialchars($_POST[pw]);
    $name = htmlspecialchars($_POST[name]);
    $uid = htmlspecialchars($_POST[uid]);
    $sql="INSERT INTO Users (email, password, name, uid) VALUES ('$email','$pw','$name', '$uid')";
    
    if (!mysqli_query($con, $sql)){        
		die('Error: ' . mysqli_error($con));
    }
	else {
		Header("Location: ./events.php");		
		$_SESSION['User'] = $_POST[name];	
	}
?>

<!DOCTYPE HTML>


<html>
<head>
</head>

<body>
	</br>
	<a href='./events'>Back to events</a>
</body>
</html>
