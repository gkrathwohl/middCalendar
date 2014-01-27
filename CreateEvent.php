<?php session_start(); ?>

<html>
<head>
	<title>Create Event</title>
</head>

<body>
	<p>Create an Event:</p>
	<p>Please make something somewhat interesting</p><br>
	<form action='InsertEvent.php' id='newEvent' method='post'>
	    Middlebury College ID:<input type="text" name="uid" value ="<?php echo $_SESSION['uid'];?>" required/><br>
		Event Name: <input type="text" name="name" required /> <br>
		Date: <input type="date" name="date" placeholder="yyyy-mm-dd"required /> <br>        
		Time: <input type="time" name="time" placeholder="--:-- --" required /> <br>
		Location: <input type="text" name="location" required /> <br>
		Select Genre: <select name="genre" form='newEvent'>
			<option value="Dance"> Dance </option>
			<option value="Party"> Party </option>
			<option value="Clam Bake"> Clam Bake </option>
			<option value="Pineapple"> Pineapple </option>
			<option value="sports"> sports </option>
		</select> <br>
		Organization: <select name='orgName' form='newEvent'>
			<?php
				define('DB_SERVER','panther.cs.middlebury.edu');
				define('DB_USERNAME','wschaaf');
				define('DB_PASSWORD','wschaaf');
				define('DB_DATABASE','wschaaf_Calendar');
				$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
				$sql="SELECT * FROM Organizations";
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error());
				}
				else {
					$result = mysqli_query($con,$sql);
				}
				echo "";
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='".$row[name]."'>".$row[name]."</option>";
				}
			?>
		</select><br>
	    <textarea name="description" rows="5" cols="40" placeholder="Enter description here" required></textarea> <br>
	    <input type="submit" value="Create Event!"/> <br> <br>
	</form>
</body>

</html>


