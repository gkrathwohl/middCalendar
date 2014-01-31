<?php session_start(); ?>  

<?php 
//start session
//must happen before anything else on the page

//print_r($_SESSION);

//set up the connection to the database
define('DB_SERVER','panther.cs.middlebury.edu');
define('DB_USERNAME','wschaaf');
define('DB_PASSWORD','wschaaf');

define('DB_DATABASE','wschaaf_Calendar');

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");

//get todays date in form (y-m-d)
$date = getdate();
$today = $date['year']."-".$date['mon']."-".$date['mday'];	
$date1 = date_create("$today");


//make array of week
$t = date_create("$today");
$byDate[date_format($t,"Y-m-d")][]=' ';
for ($x=1; $x<=6; $x++)
  {
   date_add($t,date_interval_create_from_date_string("1 days"));
   $byDate[date_format($t,"Y-m-d")][]=' ';
  } 

//get date 6 days from today (to create a week, including today)
$date=date_create("$today");
date_add($date,date_interval_create_from_date_string("6 days"));
//echo "Seven days from now is: ".date_format($date,"Y-m-d")."</br>";

//sql query selects all events between today's date and 6 days from now
$sql="SELECT * FROM Events WHERE date BETWEEN '".date_format($date1,"Y-m-d")."' AND '".date_format($date,"Y-m-d")."' AND approved=1 ORDER BY date, time";


if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}


//$byDate needs to be initialized first so that days with no events still show up...
function sortFunction( $a, $b ) {
    return strtotime($a['date']) - strtotime($b["date"]);
}


while ($row = mysqli_fetch_array($result)) {
$result1[] = $row;
}

//usort($result1, "sortFunction");

//while ($row = mysqli_fetch_array($result)) {
 //for each event, display its name as a link to detailed event info, with eid in the url
// echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
foreach($result1 as $row){
  $byDate[$row['date']][]=$row;
}
//}

//print_r($byDate);











$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
$months = array('01'=>'January', '02'=>'February', '03'=>'March', '04'=>'April','05'=>'May','06'=>'June', '07'=>'July', '08'=>'August', '09'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');

echo "</br>";
echo "<div id='content'>";

echo "<div id='table1'>";

echo "<div id='more'><a id='b1' href='javascript:toggle();'>More</a></div>";
/////////////////////////////


echo "<div id='links'>";



//if session user is set (from logging in), show link to create event and log out
if(isset($_SESSION['User'])){
        echo "Welcome  ".$_SESSION['User']."</br>";
        echo "<a href='./CreateEvent.php'>Create Event</a></br>";
        echo "<a href='./CreateOrganization.php'>Create Organization</a></br>";
        echo "<a href='./addMembers.php'>Add Members to Org</a></br>";
        $sql2="SELECT supervisor FROM Users WHERE uid = '$_SESSION[uid]'";
  if (!mysqli_query($con,$sql2))
  {
    die('Error: ' . mysqli_error());
  }
  else
  {
 //execute the SQL query
    $result2 = mysqli_query($con,$sql2);
        
  }
        
        $row = mysqli_fetch_array($result2);
      if($row['supervisor']==1){
        
              echo "<a href='./approveEvents.php'>Approve Events</a></br>";
      }
 
        echo "<a href='./logout.php'>Don't forget to logout</a><br>";
}
else{ //if session user is not set, show link to log in and to create user
        $_SESSION['User'] = null;
        echo "<a href='./login.php'>Log In</a></br>";
        echo "<a href='./CreateUser.php'>Create User</a></br>";
}

//link to search page

?>
<html>

<body>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<SCRIPT LANGUAGE="javascript">
$(links).hide();
function toggle() {
if($(links).is(':visible')){
$(links).hide();
document.getElementById('b1').innerHTML = "More";
}else{
$(links).show();
document.getElementById('b1').innerHTML = "Less";
}

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
<?php
echo "</div>";







//////////////////////////


echo "<table>";
echo "<tr>";
foreach($byDate as $key => $value)
  {
echo "</br>";
//echo "<td>";
  echo "<div class = 'date'>";
  echo "<a href='./date.php?date=".$key."' >";
  echo $days[date( "w", strtotime($key))]."</br>";
  echo $months[date( "m", strtotime($key))]." ".date( "d", strtotime($key))."</br></br>";
  echo "</a></div>";
  //array shift removes first value of array, which kept being current time for some reason.
  array_shift($value);

  //print out each event that occurs on day, as a link to more details
  foreach($value as $event){
        echo "<a href='./eventInfo.php?eid=".$event['eid']."'>".$event['name']."</a> ".date('g:i A',strtotime($event['time']));
	//echo "<a href='./eventInfo.php?eid=".$event['eid']."'>".$event['name']."</a> ".date("l jS \of F Y h:i:s A",strtotime($event['time']))."<br>";

	echo "<div class = 'description'>".substr($event['description'],0,35)."...</div>";
  }
//echo "</td>";
  }
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</div>";

//Display events
//echo "</br>Events in the Next 7 days: </br>";
//while ($row = mysqli_fetch_array($result)) {
 //for each event, display its name as a link to detailed event info, with eid in the url
// echo "<a href='./eventInfo.php?eid=".$row['eid']."'>".$row['name']."</a><br>";
//}




//view session data:
//print_r($_SESSION);


//close connection
mysql_close($con)


?>
<style>
html{
background: #737373;
background-image:url('./1003background1.png');
background-attachment: fixed;
}

a:visited, a:link{
color:#0066CC;
}

#links{
border-radius: 25px;
color: pink;
//position:fixed;				
background-color:black;
opacity: .90;
width:50%;
//padding-top: 20px;
padding-bottom: 20px;
padding-right: 10%;
//padding-left: 10%;
border-width: 3px;
border-color: black;
margin-top: 10%;
margin-right: 20%;	
//margin-left: 65%;
z-index: 1;
//float:left;
//width: 200px ;
//background: white;
//opacity:0.9;
}
#content{
//float:left;
}
#table1{
border-radius: 25px;
opacity: .9;
color: pink;
background-color: black;
  width: 1100px ;
  margin-left: auto ;
  margin-right: auto ;
text-align:center;
font-size: 28;
}
div.date a:link,div.date a:visited{
text-transform:uppercase;
font-weight:bold;
color:white;
font-size:35;
}
.description{
color: #585858;
font-size:22;
}
tr{
text-align:center;
}
table, th, td
{
font-size:20;
border: 1px solid black;
text-align:center;
}
td{
vertical-align:top;
width:200;
}
#more{
text-align:left;
}


</style>
<!DOCTYPE HTML>
<html>

<title> Midd Events </title>
<body>

</body>
</html>
 
