
<!DOCTYPE html>
<html>
<head>
	<title>HOme - 1337bot.</title>

	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

	<script type="text/javascript" src="js/jquery.js"> </script>	
   
	<link rel="stylesheet" type="text/css" href="css/footerStyle.css">
	<link rel="stylesheet" type="text/css" href="css/buttonStyle.css">
	<link rel="stylesheet" type="text/css" href="css/wrapperStyle.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/toggleNav.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

</head>

<body>
	
	<div id="header" style="text-align: center;">
		<?php include("assets/Header.php"); ?>
	</div>
    
	<div class=" bgimg-forger" style="text-align:center">
	<!--form action="loginhandler.php" -->		

		<div style="height:300px;"><!--Empty space for dramatic effect (y) --></div>
		
		<div style="text-align:center;">			
		 	<input type="text" id="username" name="username" placeholder="Account" autocomplete='off'>
			<br>	
					  
			<input type="password" id="userpass" name="userpass" placeholder="*******" autocomplete='off'>
			<br>
	        <!--td> <input type="submit"  name="login_submit"></td-->
			<button style="margin:5px;" id="loginbtn" name="login" class="btn" type="submit"><i class="fa fa-refresh fa-spin"></i> Rip it!</button>
		</div>	

		<br>
		&nbsp;
		<br>
	</div>

	<div id="footer" style="text-align: center">
		<?php include("assets/Footer.php"); ?>		
	</div>

</body>

<script type="text/javascript">
	$(document).ready(function(){


		$("#loginbtn").click(function(){
			//Login button clicked
			login();
		});

		$("#userpass").keyup(function(e) {
			if(e.which == 13) {
			    // enter pressed
			    login();
		  	}
		});

	});

	function login(){

		var this_usn = $("#username").val().trim();
		var this_pass = $("#userpass").val().trim();

		isValid = 	ValidateInputs(this_usn,this_pass);
		if (isValid) 
		{
			//
			compoundUrl = 'assets/loginhandler.php?usnme='+this_usn+'&uspss='+this_pass;
			//
			//Make aJax Request
			jQuery.ajax({
						//
			            type:"get",
			            //dataType:"json",
			            url: compoundUrl,
			            //data: {action: 'submit_data', info: info},
			            success: function(data) {
			                //;
			                response = data.trim();
			                if (response == 'Login Success!')
			                {
			                	window.location = "securityrelay.php";
			                	//swal('Successful Response - Redirect');

			                }else {
			                	swal({
								  title: "Invalid Credentials...",
								  text: "..And he kicked the Fattest Rocks all the way home. ",
								  icon: "warning",
								  //buttons: true,
								  dangerMode: true,
								})
			                }
			            },
			            error: function(data) {
			              	swal("Error! \ndata: \n"+data); 
			            },
			        });
			
		}

	}


	function ValidateInputs(usn,pass){
		 this_usn = usn;
		 this_pass = pass;
		//
		// this_usn = $("#username").val().trim();
		// this_pass = $("#userpass").val().trim();
		//alert ('usn: '+this_usn+'\npass: '+this_pass);
		//		
		if (this_usn == '' || typeof this_usn == 'undefined' ) {
			swal('Uhh.. what?','You must enter a Username.', 'info');
			return false;
		}
		if (this_pass == '' || typeof this_pass == 'undefined') {
			swal('Uhh.. what?', 'You must enter a Password.', 'info');
			return false;
		}	
		return true;
	}


</script>

</html>