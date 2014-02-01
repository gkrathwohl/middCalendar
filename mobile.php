<?php session_start(); ?>  
<meta name="viewport" content="width=device-width, user-scalable=yes">
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











//$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
$days = array('Sun', 'Mon', 'Tues', 'Wed','Thur','Fri', 'Sat');

$months = array('01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr','05'=>'May','06'=>'June', '07'=>'July', '08'=>'Aug', '09'=>'Sept', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');

echo "</br>";
echo "<div id='content'>";

echo "<div id='table1'>";

//echo "<div id='more'><a id='b1' href='javascript:toggle();'>Search</a></div>";
/////////////////////////////


echo "<div id='links'>";



//if session user is set (from logging in), show link to create event and log out
if(isset($_SESSION['User'])){
        echo "Welcome  ".$_SESSION['User']."</br>";
	echo "<a href='./MyEvents.php'>My Events</a></br>";
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
	document.getElementById('b1').innerHTML = "Search";
}else{
	$(links).show();
	document.getElementById('b1').innerHTML = "Less";
}

}

</SCRIPT>

<?php
echo "</div>";







//////////////////////////


echo "<table>";
echo "<tr>";
echo "<div id = 'title'> <a href='./about.html'>middCalendar</a> </div><br/>";

foreach($byDate as $key => $value)
  {
echo "</br>";
//echo "<td>";
  echo "<div class = 'date'>";
  //echo "<a href='./date.php?date=".$key."' >";
  echo $days[date( "w", strtotime($key))].", ";
  echo $months[date( "m", strtotime($key))]." ".intval(date( "d", strtotime($key)))."</br></br>";
//  echo "</a></div>";
echo "</div>";
  //array shift removes first value of array, which kept being current time for some reason.
  array_shift($value);

  //print out each event that occurs on day, as a link to more details
  foreach($value as $event){
	//Link: Name time location 
	echo "<div class='event'>";
        echo $event['name']." <span class='dateTime'>".date('g:i A',strtotime($event['time']))." ".$event['location']."</span>";
	//echo "<a href='./eventInfo.php?eid=".$event['eid']."'>".$event['name']."</a> ".date("l jS \of F Y h:i:s A",strtotime($event['time']))."<br>";

	echo "<div class = 'description' style='display:none;'>".substr($event['description'],0,200)."...</div>";
	echo "</div>";
echo "<div class='break'>------------------------ </div>";

  }
//echo "</td>";

echo "</br>";
echo "</br>";
  }

echo "</tr>";
echo "</table>";
echo "</div>";
echo "</div>";


mysql_close($con)


?>


<script>

$('div.event').click(function() {

  			//$('div.event').removeClass("selected");
			//$('div.event').removeClass("unselected");
  			//$(this).addClass("selected");
$(this).toggleClass("selected");
  $(this).find(".description").toggle();
$(".event").not(this).find(".description").hide();
$(".event").not(this).removeClass("selected");
 // $(this).css("background-color","#C4C4C4");
//$(".event").not(this).css("background-color","white");


//$(this).css("background","-webkit-linear-gradient(#C4C4C4, #C4C4C4, #C4C4C4, white");
});
</script>

</body>
</html>
<style>

::selection { background: transparent; }
::-moz-selection { background: transparent; }

html{
background: white;
}

.event{
color:black;
text-decoration:none;
font-size: 26;
-webkit-text-size-adjust: 270%;
}

.selected{
background-color: #EBEBEB;
}

#table1{
border-radius: 25px;
opacity: 1;
color: grey;
background-color: white;
  width: 1100px ;
  margin-left: auto ;
  margin-right: auto ;
text-align:left;
font-size: 17;
}

.break{
text-align:center;
}

div.date{
-webkit-text-size-adjust: 200%;
text-transform:uppercase;
font-weight:bold;
text-align:center;
color:black;
font-size:46;
}

#title{
-webkit-text-size-adjust: 200%;

text-align:center;
color:black;
font-size:46;
}

.dateTime{
color:gray;
font-size:22;
}

.description{
margin-top:20px;
text-indent:50px;
color: #313131;
font-size:26;
-webkit-text-size-adjust: 230%;
}
tr{
text-align:left;
}
table, th, td
{
font-size:20em;
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

a:link{
text-decoration:none;
color:black;
}


</style>
<!DOCTYPE HTML>
<html>

<title> Midd Events </title>
<body>

</body>
</html>
 

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46764554-3', 'middlebury.edu');
  ga('send', 'pageview');

</script>
