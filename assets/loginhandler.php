
<?php 
	session_start();
	#
	$username=trim($_REQUEST['usnme']);
	$userpass=trim($_REQUEST['uspss']);
	#
	$d_url    = "/home/toylaa/Documents/Forgione/accounts" ;
	$f_url    = $d_url . "/" . $username;
	#
	$userf_exists = file_exists($f_url);
	if ($userf_exists != true) {
		// Return User not Found Error Message
		echo 'Invalid UserName';
	}else {
		//user file found
		$f_array = file($f_url);
		//
		$line1 = explode(':',$f_array[0]);
		$s_usn = trim($line1[1]);
		//
		$line2 = explode(':',$f_array[1]);
		$s_pass = trim($line2[1]);
		//
		if ($userpass == $s_pass) {
			$_SESSION["forge_usn"] = $username;
			$_SESSION["newUrl"] = 'dashboard.php';
			echo 'Login Success!';
			//echo '<br> $userpass: '.$userpass;
			//echo '<br> $s_pass: '.$s_pass;
		}else{
			echo 'Login Failed!';
			//echo '<br> $userpass: '.$userpass;
			//echo '<br> $s_pass: '.$s_pass;
		}
	}
?>