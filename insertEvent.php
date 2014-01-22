<?php session_start(); ?>

<!DOCTYPE HTML>
<?php 
    
    //set up the connection to the database
    define('DB_SERVER', 'panther.cs.middlebury.edu');
    define('DB_USERNAME', 'wschaaf');
    define('DB_PASSWORD', 'wschaaf');
    define('DB_DATABASE', 'wschaaf_Calendar');
    
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");
    $name = htmlspecialchars($_POST[name]);
    $time = htmlspecialchars($_POST[time]);
    $description = htmlspecialchars($_POST[description]);
    $building = htmlspecialchars($_POST[building]);
    $room = htmlspecialchars($_POST[room]);
    $uid = htmlspecialchars($_POST[uid]);
    $genre = htmlspecialchars($_POST[genre]);
    $date = htmlspecialchars($_POST[date]);
    $orgName = htmlspecialchars($_POST[orgName]);
    $sql="INSERT INTO Events (name, time, description, building, room, uid, genre, date, orgName) VALUES ('$name','$time','$description', '$building', '$room', '$uid', '$genre', '$date', '$orgName')";
    
    if (!mysqli_query($con, $sql)){
        die('Error: ' . mysqli_error($con));
    }
    echo "You created " .$name; 
?>

<html>
	</br>
	<a href='./events'>Back to events</a>
</html>
