
<html>

<head><title> College Database </title>
</head>

<body>

<br>

Create an Event: <br>
Please make something somewhat interesting

<br> <br>


<SCRIPT LANGUAGE="javascript">
function validate() {

	fm = document.thisForm

	//use validation here to make sure the user entered
	//the information correctly

	fm.submit()

}

</SCRIPT>

<!--This creates the insert boxes-->
<form action="insertEvent.php" method="post">
	Middlebury ID: <input type="text" name="uid" required /> <br>
	Event Name: <input type="text" name="name" required /> <br>
	Date: <input type="date" name="date" required /> <br>	
	Time: <input type="time" name="time" required /> <br>
	Building: <input type="text" name="building" required/> <br>
	Room: <input type="text" name="room" required /> <br>
	Genre: <input type="text" name="genre" required /> <br>
	<textarea name="description" rows="5" cols="40" required>Enter description here </textarea> <br>
	<input type="submit" value="Create Event!"/> <br> <br>
</form>

</body>

</html>


