<?php session_start(); ?>
<html>
<head>
	<title> Create User </title>
	<style>
	#content {
	  width: 500px ;
	  margin-left: auto ;
	  margin-right: auto ;
	}
	#content1 {
	  width: 400px ;
	  margin-left: auto ;
	  margin-right: auto ;
	}
	</style>
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
			var goodColor = "#66cc66";
			var badColor = "#ff6666";
			function checkEmail() {
				var email = document.getElementById('email');
				var message = document.getElementById('emailConfirm');
				var emailRegex = /\S+@\S+\.\S+/;
				if(emailRegex.test(email.value)) {
					email.style.backgroundColor = "#ffffff";
					message.style.color = goodColor;
					message.innerHTML = "Valid";
					submitButton.type = "submit";
				}
				else {
					email.style.backgroundColor = badColor;
					message.style.color = badColor;
					message.innerHTML = "Not valid email!";
					submitButton.type = "hidden";
				}
			}		
			function checkPass() {
				//Store the password field objects into variables ...
				var pass1 = document.getElementById('pass1');
				var pass2 = document.getElementById('pass2');
				//Store the Confimation Message Object ...
				var message = document.getElementById('passwordConfirm');
				var submitButton = document.getElementById('submit');
				var passRegex = /\W?\w+/;
				if(!passRegex.test(pass1.value)) {
					pass2.style.backgroundColor = badColor;
					message.style.color = badColor;
					message.innerHTML = "Your password does not match the requirements.";
					submitButton.type = "hidden";
				}			
				else if((pass1.value == pass2.value)){
					//The passwords match.
					pass2.style.backgroundColor = goodColor;
					message.style.color = goodColor;
					message.innerHTML = "Passwords Match!";
					submitButton.type = "submit"
				}
				else{
					//The passwords do not match.
					pass2.style.backgroundColor = badColor;
					message.style.color = badColor;
					message.innerHTML = "Passwords Do Not Match!";
					submitButton.type = "hidden";
				}
			} 
		</SCRIPT>
		<!--This creates the insert boxes-->
		<form action="insertUser.php" method="post">
			<input type="text" name="name" placeholder="Name" required /> <br>
			<div class="fieldWrapper">
			    <input type= "text" name="email" id="email" placeholder="Email" onkeyup="checkEmail(); return false;" type="text" required>
			    <span id="emailConfirm" class="confirmMessage"></span>
			</div>
			<input type="text" name="uid" placeholder="Middlebury College ID" required /> <br>
		    	<input type="password" name="pw" id="pass1" placeholder="Password" required> <br>
			<div class="fieldWrapper">
			    <input type="password" name="pass2" id="pass2" placeholder="Confirm Password" onkeyup="checkPass(); return false;" type="password" required>
			    <span id="passwordConfirm" class="confirmMessage"></span>
			</div>
			<input type="hidden" id="submit" value="Create User!"/>	
			<br> <br>
		</form>
	</div>
</body>

</html>


