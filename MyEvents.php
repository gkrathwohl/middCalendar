<?php session_start(); ?>
<!DOCTYPE html>
<html>
        <head>
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
                                opacity: .8;
                                width: 60%;
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
                                font-size:1em;
                        }
                        .header a:link {
                                font-size: 1em;
                                font-weight: normal;
                                color: white;
                                text-decoration:none;
                                
                        }
                        .header a:visited {
                                font-size: 1em;
                                font-weight: normal;
                                color: white;
                                text-decoration:none;
                        }
                        .header a:hover {
                                font-size: 1.2em;
                                font-weight: bold;
                                color: white;
                                text-decoration:none;
                        }
                        .header a:active {
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
				define('DB_SERVER','panther.cs.middlebury.edu');
				define('DB_USERNAME','wschaaf');
				define('DB_PASSWORD','wschaaf');
				define('DB_DATABASE','wschaaf_Calendar');
				$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect");
				if(isset($_SESSION['User'])) {						
					$sql="SELECT * FROM Events WHERE uid='".$_SESSION['uid']."'";
					if (!mysqli_query($con,$sql)) {
						die('Error: ' . mysqli_error());
					}
					else {
						$result = mysqli_query($con,$sql);
						while ($row = mysqli_fetch_array($result)) {						
							echo "<b>Name:</b> ".$row['name'];
							echo "</br> <b>Location:</b> ".$row['location'];
							echo "</br> <b>Date:</b> ".$row['date'];
							echo "</br> <b>Time:</b> ".$row['time']; 
							echo "</br> <b>Genre: </b> ".$row['genre'];
							echo "</br><b>Description: </b> ".$row['description'];
							echo "</br><a href='./UpdateEvent.php?eid=".$row['eid']."'>Update ".$row['name']."</a></br>"; 
						}
					}
				}
				else {
					echo "Sorry you must be logged in to see your events.";
				}
			?>
                </div>        
        </body>
</html>
