<?php session_start(); ?>
<!DOCTYPE html>
<html>
        <head>
		<title>Update Event</title>
                <style>
                        .logo {
                                position: fixed;
                                margin-top: 1%;
                                width: 24%;
                                height: 15%;
                                margin-left: 38%;
                                z-index: 2;
                                opacity: .6;
                        }
                        .header {                                

                                                position:absolute;                                
                                background-color:gray;
                                opacity: .9;
                                width:100%;
                                height: 2%;
                                padding-top: 1%;
                                padding-bottom: 1%;
                                padding-right: 10%;
                                padding-left: 10%;
                                //border-width: 3%;
                                //border-color: black;
                                margin-top: 10%;
                                margin-right: 0%;
                                margin-left: -1%;
                                z-index: 1;
                        }
                        .headerText {
                                float: left;
                                color: white;
                                width: 13%
                        }
                        .center {
                                color:black;
                                text-align:center;
                        }
                        .main {
                                position: fixed;
                                background-color: white;
                                opacity: .9;
                                width: 60%;
                                height: 40%;
                                overflow-y: scroll;
                                padding-top: 5%;
                                padding-bottom: 5%;
                                padding-right: 10%;
                                padding-left: 10%;
                                border-width: 3%;
                                border-color: black;
                                border-radius: 25px;
                                margin-top: 15%;
                                margin-bottom: 5%;
                                margin-right: 10%;
                                margin-left: 10%;
                                z-index = -1;
                        }
                        p {
                                font-family:"Times New Roman";
                                font-size:150%;
                        }
                        a:link {
                                font-size: 1em;
                                font-weight: normal;
                                color: white;
                                text-decoration:none;
                                
                        }
                        a:visited {
                                font-size: 1em;
                                font-weight: normal;
                                color: white;
                                text-decoration:none;
                        }
                        a:hover {
                                font-size: 1.2em;
                                font-weight: bold;
                                color: white;
                                text-decoration:none;
                        }
                        a:active {
                                font-size: 1.2em;
                                font-weight: bold;
                                color: white;
                                text-decoration:none;
                        }
                </style>
        </head>
        
        <body background=1003background1.png>
                <div class="logo">
                        <img src=MiddleburyPanther.jpg width="100%" height="100%">                
                </div>                
                <div class="header">
                        <?php
                                define('DB_SERVER','panther.cs.middlebury.edu');
                                define('DB_USERNAME','wschaaf');
                                define('DB_PASSWORD','wschaaf');
                                define('DB_DATABASE','wschaaf_Calendar');
                                $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
                                if(isset($_SESSION['User'])){
                                        echo "<div class=headerText>Welcome ".$_SESSION['User']."</div>";
                                        echo "<div class=headerText><a href='./events.php'>Home</a></div>";
                                        echo "<div class=headerText><a href='./CreateEvent.php'>Create Event</a></div>";
                                        echo "<div class=headerText><a href='./CreateOrganization.php'>Create Organization</a></div>";
                                        echo "<div class=headerText><a href='./addMembers.php'>Add Members to Org</a></div>";
                                        $sql2="SELECT supervisor FROM Users WHERE uid = '$_SESSION[uid]'";
                                         if (!mysqli_query($con,$sql2)) {
                                                die('Error: ' . mysqli_error());
                                         }
                                         else {
                                                 //execute the SQL query
                                                $result2 = mysqli_query($con,$sql2);        
                                         }
                                        $row = mysqli_fetch_array($result2);
                                        if($row['supervisor']==1) {
                                                echo "<div class=headerText><a href='./approveEvents.php'>Approve Events</a></div>";
                                        }
                                        echo "<div class=headerText><a href='./logout.php'>Logout</a></div>";
                                }
                                else {
                                        //if session user is not set, show link to log in and to create user
                                        $_SESSION['User'] = null;
                                        echo "<div class=headerText><a href='./events.php'>Home</a></div>";
                                        echo "<div class=headerText><a href='./login.php'>Log In</a></div>";
                                        echo "<div class=headerText><a href='./CreateUser.php'>Create User</a></div>";
                                }
                        ?>
                </div>



                <div class="main">
                        <?php
							if(isset($_GET["eid"])) {
								$eid = $_GET["eid"];
							}
							define('DB_SERVER','panther.cs.middlebury.edu');
							define('DB_USERNAME','wschaaf');
							define('DB_PASSWORD','wschaaf');
							define('DB_DATABASE','wschaaf_Calendar');
							$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
							if(isset($_SESSION['User'])) {
								$sql = "SELECT * FROM Events WHERE eid='".$eid ."' AND uid='" .$_SESSION['uid'] ."'";
								if (!mysqli_query($con,$sql)) {
									die('Error: ' . mysqli_error());
								}
								else {
									$result = mysqli_query($con,$sql);
									while ($row = mysqli_fetch_row($result)) {
										$genres = array("Dance", "Party", "Clam Bake", "Pineapple", "Sports");
										echo "<form action='correctEvent.php' id='updateEvent' method='post'>";
										echo "<input type='hidden' name='eid' value='".$eid."'/> <br>";
										echo 'Event Name: <input type="text" name="name" value="'.$row[1].'"/> <br>';
										echo "Date: <input type='date' name='date' value='".$row[9]."'/> <br>";       
										echo "Time: <input type='time' name='time' value='".$row[2]."'/> <br>";
										echo 'Location: <input type="text" name="location" value="'.$row[5].'"/> <br>';
										echo "Select Genre: <select name='genre' form='updateEvent'>";
										foreach($genres as $g) {
											if($g == $row[8]) {
												echo "<option value='".$g."' default selected>".$g."</option>";
											}
											else {
												echo "<option value='".$g."'>".$g."</option>";
											}
										}
										echo "</select> <br>";
										echo "Organization: <select name='orgName' form='updateEvent'>";				
										$sql2="SELECT * FROM BelongsTo WHERE uid='".$_SESSION['uid']."'";
										if (!mysqli_query($con,$sql2)) {
											die('Error: ' . mysqli_error());
										}
										else {
											$result2 = mysqli_query($con,$sql2);
										}
										while ($row2 = mysqli_fetch_array($result2)) {
											if($row2[orgName] == $row[10]) {
												echo "<option value='".$row2[orgName]."' default selected>".$row2[orgName]."</option>";
											}
											else {
												echo "<option value='".$row2[orgName]."'>".$row2[orgName]."</option>";
											}
										}
										echo "</select><br>";
										echo '<textarea name="description" rows="5" cols="40">'.$row[4].'</textarea> <br>';
										echo "<input type='submit' value='Update Event!'/> <br> <br>";	
									}
								}
							}
							else {
								echo "<p>Sorry you must be logged in to update events.</p>";
							}
					?>
                </div>        
        </body>
</html>
