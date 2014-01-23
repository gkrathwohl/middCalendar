

<?php session_start(); ?>


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

	<form action="insert1.php" method="post">
  	<label for="midd_search_query">Search</label>
  	<input type="search" id="midd_search_query" class="search_query x-webkit-speech" name="Search" placeholder="Search Calendar" x-webkit-speech 	required>
  	<input type="submit" value="Go">
  	<!--<input type="hidden" id="midd_ajax_search_url" value="/go/search">-->
	</form> 

<!--This creates the insert boxes
<form action="insert1.php" method="post">
Search: <input type="text" name="Search"  /> <br> <br>
<input type="submit" value="Search"/> <br> <br>
</form>-->


<!--This creates the drop down list-->
<form name="thisForm" method="POST" action="query.php">
<p>Select Genre: <select size="1" name="my_dropdown">
<option value="Dance"> Dance </option>
<option value="Party"> Party </option>
<option value="Clam Bake"> Clam Bake </option>
<option value="Pineapple"> Pineapple </option>
<option value="drinking"> drinking </option>
<option value="sports"> sports </option>
<input type="button" value="Go" name="btm_submit" onclick="validate()">
</select></p>
<p>
</p>
</form>



</body>

</html>
