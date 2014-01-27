<?php
        session_start();
    //set up the connection to the database
    define('DB_SERVER', 'panther.cs.middlebury.edu');
    define('DB_USERNAME', 'wschaaf');
    define('DB_PASSWORD', 'wschaaf');
    define('DB_DATABASE', 'wschaaf_Calendar');
    
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

    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ("could not connect");
    $email = htmlspecialchars($_POST[email]);
    $pw = htmlspecialchars($_POST[pw]);
        $encryptpw = encrypt_decrypt('encrypt', $pw);
    $name = htmlspecialchars($_POST[name]);
    $uid = htmlspecialchars($_POST[uid]);
    $sql="INSERT INTO Users (email, password, name, uid) VALUES ('$email','$encryptpw','$name', '$uid')";
    if (!mysqli_query($con, $sql)){
         die('Error: ' . mysqli_error($con));
    }
    else {
        $_SESSION['User'] = $name;
	$_SESSION['uid'] = $uid;
	Header("Location: ./events.php");
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

