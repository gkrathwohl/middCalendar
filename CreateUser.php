<?php session_start(); ?>
<html>

<head><title> College Database </title>
</head>

<body>
<div id='content'>
<br>

Create an Account:
Please use a different password from your Middlebury account
</div>
<br> <br>

<div id='content1'>
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
	<input type="text" name="name" placeholder="Name" required /> <br>
	<input type="text" name="email" placeholder="Email" required /> <br>
	<input type="text" name="uid" required placeholder="Middlebury College ID"/> <br>
	<input type="password" name="pw" placeholder="Password" required /> <br>
	<input type="submit" value="Create User"/> <br> <br>
</form>
</div>
</body>

</html>
<style>
#content {
  width: 500px ;
  margin-left: auto ;
  margin-right: auto ;
}
#content1 {
  width: 200px ;
  margin-left: auto ;
  margin-right: auto ;
}
</style>

