<?php session_start(); ?>


<!DOCTYPE html>
<html>
	<head>
		<style>
		
			
			.logo {
				position: fixed;
				margin-top: 1%;
				margin-left: 38%;
				z-index: 2;
				opacity: .6;
			}
			.header {				

				position:fixed;				
				background-color:gray;
				opacity: .9;
				width:100%;
				height: 15px;
				padding-top: 20px;
				padding-bottom: 20px;
				padding-right: 10%;
				padding-left: 10%;
				border-width: 3px;
				border-color: black;
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
				height: 100px;
				padding-top: 5%;
				padding-bottom: 5%;
				padding-right: 10%;
				padding-left: 10%;
				border-width: 3px;
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
				font-size:20px;
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
			<img src=MiddleburyPanther.jpg width="400px" height="145px">	
		</div>		
		<div class="header">
		<?php
			
			echo "<div class=headerText><a href='./events.php'>Home</a></div>";
			echo "<div class=headerText><a href='./CreateUser.php'>Create User</a></div>";
			

			
			?>
		</div>
		<div class="main"> 
			<form action='checkpassword.php' method='post'> <p>Log In:</p>     
Email: <input type='text' name='email'></br>
Password: <input type='password' name='pw'></br>
<input type='submit' value='Submit'>
</form>
		</div>	
	</body>
</html>
