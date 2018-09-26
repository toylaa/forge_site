<?php 
	session_start();
	$newURL = $_SESSION['newUrl'];
	header('Location: '.$newURL);
 ?>