
<html>

<head><title> College Database </title>
</head>

<body>

<br>

Create an Account:
Please use a different password from your Middlebury account

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
<form action="insert.php" method="post">
	Name: <input type="text" name="name" required /> <br>
	Email: <input type="text" name="email" required /> <br>
	Middlebury College ID: <input type="text" name="uid" required /> <br>
	Password: <input type="password" name="pw" required /> <br>
	<input type="submit" value="Insert into Database"/> <br> <br>
</form>

</body>

</html>


