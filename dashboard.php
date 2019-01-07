<!DOCTYPE html>
<html>
<head>
	<title>dASHboard - 1337bot.</title>

	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

	<script type="text/javascript" src="js/jquery.js"> </script>	
   
	<link rel="stylesheet" type="text/css" href="css/footerStyle.css">
	<link rel="stylesheet" type="text/css" href="css/buttonStyle.css">
	<link rel="stylesheet" type="text/css" href="css/wrapperStyle.css">

	<link rel="stylesheet" type="text/css" href="css/dashStyle.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/toggleNav.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

</head>

<?php 
		session_start();
		
		if (isset($_SESSION["forge_usn"]))
		{
		 	$username = $_SESSION["forge_usn"];
		}else
		{
		 	header('Location: '."index.php");
		}
?>
<body>

	<div id="header" style="text-align: center;">
		<?php include("assets/DashHeader.php"); ?>

	</div>

	<div class="container" style="width:95%;">
			
		<div class="alert" id="alertBar">
		  	<span class="closebtn" id="closeAlertBtn">&times;</span> 
	  		<strong>Welcome back to the hustle, <?=ucfirst($username); ?>!</strong>	
		</div>

		<div id="mutable"> 
<!-- This is a placeholder div to be populated by pagelets/dash.php on load-->	
		</div>


		<div id="tabGroup">	

			<ul class="tabrow">
			 <a href="#"> <li class="LikeByUrlBtn" id=""><strong>PowerPool</strong></li></a>

			  <a href="#"><li class="">TAB 2</li></a>

			  <a href="#"><li class="dashletBtn">DashBoard</li>	</a>		 

			</ul>


		</div>

	
	</div>

	<script type="text/javascript">
		
		$(document).ready(function(){          
		//
			loadPagelet('dash');			
			//
			$("li").click(function(e) {
			  e.preventDefault();
			  $("li").removeClass("selected");
			  $(this).addClass("selected");
			  $(".closebtn").click();		  

			});
			//
			$(".LikeByUrlBtn").click(function(){
			    // URL lower nav tab clicked
			    loadPagelet("AllLikeByUrl");   
			  });
			//
			$(".dashletBtn").click(function(){
			    // DASH lower nav tab clicked
			    loadPagelet("dash");   
			  });

			// Dismiss Alert Bar On 'X' click
			$("#closeAlertBtn").click(function(){
				$("#alertBar").slideUp();
			 });

			// Dismiss Alert Bar after 5 seconds
			setTimeout(function(){
				//alert('Timeout');
				//document.getElementbyId('alertBar').style.display = 'none';
			$("#alertBar").slideUp();
			}, 5000);
		//
		});

	
	function loadPagelet(pageName){		
		//
		compoundUrl = 'pagelets/'+ pageName + '.php';
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
		               $("#mutable").html(data);		              
		            },
		            error: function(data) {
		              	alert("Error! \ndata: \n"+data); 
		            },
		        });

		$header = document.getElementById("header");
		$header.scrollIntoView(true);
	}
	</script>
	
	<div id="footer" style="text-align: center">
		<?php include("assets/Footer.php"); ?>		
	</div>

</body>
</html>