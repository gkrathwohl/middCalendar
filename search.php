
<?php
//start PHP section

//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','achristman');
define('DB_PASSWORD','password');

define('DB_DATABASE','achristman_College');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

?>



<html>

<head><title> College Database </title>
</head>

<body>




<SCRIPT LANGUAGE="javascript">
function validate() {

	fm = document.thisForm

	//use validation here to make sure the user entered
	//the information correctly

	fm.submit()

}

</SCRIPT>

<!--This creates the insert boxes-->
<form action="insert1.php" method="post">
Search: <input type="text" name="Search"  /> <br> <br>
<input type="submit" value="Search"/> <br> <br>
</form>


<!--This creates the drop down list-->
<form name="thisForm" method="POST" action="query.php">
<p>Select: <select size="1" name="my_dropdown">
<option value="Dance"> Dance </option>
<option value="Party"> Party </option>
<option value="Clam Bake"> Clam Bake </option>
<option value="Pineapple"> Pineapple </option>
<option value="drinking"> drinking </option>
<option value="sports"> sports </option>
</select></p>
<p><input type="button" value="Submit" name="btm_submit" onclick="validate()">
</p>
</form>



</body>

</html>
