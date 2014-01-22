<?php session_start(); ?>

<?php 


echo "Welcome ".$_SESSION['User'];

echo "</br> all users: ";


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

$sql="SELECT * FROM Users";

if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

echo "</br>";
echo "<form action=insertMember.php method='post' id='newMember'>";
echo "<select name='user' form='newMember'><option>Select User</option>";
while ($row = mysqli_fetch_array($result)) {
 echo "<option value='".$row[uid]."&".$row[name]."'>".$row[name]."</option>";
}
echo "</select>";


$sql="SELECT orgName FROM BelongsTo WHERE uid=".$_SESSION[uid];
if (!mysqli_query($con,$sql))
{
  die('Error: ' . mysqli_error());
}
else
{
 //execute the SQL query
 $result = mysqli_query($con,$sql);
}

echo "</br>";
echo "<select name='org' form='newMember'><option>Select Organization</option>";

while ($row = mysqli_fetch_array($result)) {
 echo "<option value='".$row[orgName]."&".$row[description]."'>".$row[orgName]."</option>";
}
echo "</select></br><input type='submit' value='Add member to organization!'/>";

echo "</form>";




?>