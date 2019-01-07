<?php 
	session_start();
	
	if(isset($_GET['postUrl']))
	{
		$username = $_SESSION["forge_usn"].trim();
		//
		$forge_url = $_GET['postUrl'];
		$ferr = '';
		// DATASTORE checks
		// DROPFILES for now, SQL in production ?

		// TBD - Check URL against acct data files for duplicates
		$d_url    = "/home/toylaa/Documents/Forgione/accounts" ;
		$f_url    = $d_url . "/" . $username;
		#
		$userf_exists = file_exists($f_url);
		if ($userf_exists != true) {
			// Return User not Found Error Message
			$ferr = 'Invalid UserName';
		}
		else{
			//user file found			
			//
			$fhandle = fopen($f_url, "a") or die('fail^Cannot Open User File. Contact Administrator.');
			$userf_contents = file($f_url);
			//
			$valid = true;
			$f_linecount = 0;
			$url_ID_incoming = explode('/',$forge_url)[4];
			//
			//Check each line in the User File for URL duplicates
			foreach($userf_contents as $userf_line)
			{
				$f_linecount = $f_linecount+1 ; 
				$url_ID_onfile = explode('/',$userf_line)[4];
				//
				if ($url_ID_onfile == $url_ID_incoming)
					{
						//Invalidate post & set loop termination conditions
						$valid = false;						
					}
			}	
		}
		
		$elements = explode("/" , $forge_url);
		/*
		$elements[0]: https:
		$elements[1]: 
		$elements[2]: www.instagram.com
		$elements[3]: p
		$elements[4]: BU7SuvAlbcY
		$elements[5]: ?taken-by=toylaa
		*/
		$YMD = date("Ymd");
		//$drop_filename = $YMD . '-' . $username . '.txt';
		$drop_filename = $username . '-' . $elements[4] . '.txt';
		// TBD - Check User against data for "Limits"

        //  Check FileName against dropfile Queue
		$dropf_exists = file_exists($drop_filename);
		if ($dropf_exists == true) {
			// FAIL^ duplicate Submission
			$ferr = 'Duplicate URL Submission';
		}
		 
		// TBD - IF no Errors
		if ( $ferr == '' )
		{
			if ($valid ){
				// BUILD url 'dropfile' & write to server 'DataStore'
				//
				// TBD - Append NEw Url To ACCT DATA if accepted	
				fwrite( $fhandle , ("\n". $forge_url).trim() );
				//
				// /var/www/html/bot/DataStore/20181031_toylaa.txt
				$drop_file_path = '/var/www/html/bot/DataStore/'.$drop_filename ;
				$drop_file = fopen( $drop_file_path, 'a') or die('fail^Cannot Open File: ' . $drop_file_path);
				fwrite( $drop_file , $forge_url.trim() );
				//
				// SEND (echo) response data [ Success/Fail ]
				echo 'success^' . $drop_file_path ;
			}else
			{
				echo 'fail^This URL has already been processed.';
			}			
		}else
		{
			echo 'fail^'. $ferr ;
		}		
	//
	}else{
		//postUrl not set = FAIL !
		echo 'fail^postUrl not set !';
	}
fclose($fhandle);
fclose($drop_file);
?>