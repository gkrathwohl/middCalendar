<?php 
	session_start();

	function encrypt_decrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'This is my secret key';
		$secret_iv = 'This is my secret iv';
		// hash
		$key = hash('sha256', $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}	

	//set up the connection to the database
	define('DB_SERVER', 'panther.cs.middlebury.edu');
	define('DB_USERNAME', 'wschaaf');
	define('DB_PASSWORD', 'wschaaf');
	define('DB_DATABASE', 'wschaaf_Calendar');
	$email = htmlspecialchars($_POST[email]);
	$pw = encrypt_decrypt('encrypt', htmlspecialchars($_POST[pw]));
	$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");
	$sql = "SELECT * FROM Users WHERE email='$email' AND password='$pw'";
	if (!mysqli_query($con, $sql)) {
	    die('Error: ' . mysqli_error($con));
	}
	else {
		$result = mysqli_query($con, $sql);
		$user = mysqli_fetch_array($result);
		if($user == null) {
		        echo "Sorry your username or password was incorrect.</br>";
		}
		else {
		       	
		        $_SESSION['User'] = $user['name'];        
		        $_SESSION['uid'] = $user['uid'];
		        Header("Location: ./events.php");                
		}
		
	}
?>

<!DOCTYPE HTML>
<html>
<head>
</head>

<body>
	</br>
	<a href='./events'>Back to events</a>
</body>
</html>
