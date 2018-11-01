<?php 
	session_start();
	
	if(isset($_GET['postUrl']))
	{
		$username = $_SESSION["forge_usn"].trim();
		//
		$url = $_GET['postUrl'];
		$ferr = '';
		// DATASTORE checks
		// DROPFILES for now, SQL in production ?

		// TBD - Check URL against data for duplicates
			$YMD = date("Ymd");
			$drop_filename = $YMD . '-' . $username .'-'. '.txt'
		// TBD - Check User against data for "Limits"			
		 
		// TBD - IF no Errors
		if ( $ferr == '' )
		{
			$YMD = date("Ymd");
			$drop_filename = $YMD . '_' . $username . '.txt'
			// BUILD url 'dropfile' & write to server 'DataStore'
			 ;
			// /var/www/html/bot/DataStore/20181031_toylaa.txt
			$drop_file_path = '/var/www/html/bot/DataStore/'.$drop_filename ;
			$drop_file = fopen( $drop_file_path, 'w') or die('fail^Cannot Open File: ' . $drop_file_path);
			fwrite( $drop_file , $url.trim() );

			// SEND (echo) response data [ Success/Fail ]
			echo 'success^' . $drop_file_path ;
		}else
		{
			echo 'fail^' ;
		}
		
	//
	}else{
		//postUrl not set = FAIL !
		echo 'fail^';
	}



?>

