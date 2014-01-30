<?php session_start(); ?>
<!DOCTYPE html>
<html>
        <head>
        		<title>Logout</title>
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
                        		//Destroys the session
								session_destroy();
                                define('DB_SERVER','panther.cs.middlebury.edu');
                                define('DB_USERNAME','wschaaf');
                                define('DB_PASSWORD','wschaaf');
                                define('DB_DATABASE','wschaaf_Calendar');
								echo "<div class=headerText><a href='./events.php'>Home</a></div>";
								echo "<div class=headerText><a href='./login.php'>Log In</a></div>";
								echo "<div class=headerText><a href='./CreateUser.php'>Create User</a></div>";
                        ?>
                </div>



                <div class="main"> 
                        <p>Thank you for logging out!</p>
                </div>        
        </body>
</html>
