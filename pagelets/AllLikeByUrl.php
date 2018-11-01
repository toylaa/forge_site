<?php 
 session_start(); 
	if (isset($_SESSION["forge_usn"]))
	{
		$username = $_SESSION["forge_usn"];
	    echo '<div style="display:none;" id="forge_usn">'.$username.'</div>';
	}else
	{
	  	header('Location: '."index.php");
	}

 
?>


<div class="jumbotron">
	<h1>PowerPooling by URL </h1>
<h4><!--Got a new post?--> Let's generate some power likes.</h4>



</div>



<div class="jumbotron">

	<h3 style="text-align:left;">Guidelines</h3>
	<hr style="width:50%;float:left;background-color: white;">
	<div style="clear:left;"></div>
	<ul style="text-align:left;">
		<li> Navigate to <a href="http://Instagram.com/<?=$username; ?>" target="_blank" >Instagram.com/<?=$username; ?></a></li>
		<li> Click on the image you wish to PowerPool</li>
		<li> Copy the FULL <span>URL</span> of any post you wish to submit.</li>
		<li> MAKE SURE your URL is valid <strong>BEFORE</strong> submission.</li>
		<li>If you submit the same post twice, nothing will happen.</li>
		
	</ul>
	<?php echo '<input type="URL" id="urlIn" style="width:100%;" placeholder="https://www.instagram.com/p/XXXXXXXXXXX/?taken-by='. $username .'">';
	  ?>
	


	<br>
	<button class="btn" id="UrlSubmitBtn" style="float:right;">Drop this URL into PowerPool QUEUE</button>
	<br>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		//alert('loaded');
		$("#UrlSubmitBtn").click(function(){
			//alert('clicked');
			validateUrl();
		});
	});

	function validateUrl(){
		//Valid URL looks like this
		//https://www.instagram.com/p/Bld4KMtB2By/?taken-by=toylaa
		$thisUrl = document.getElementById("urlIn").value;
		//alert('Validating: '+ $thisUrl);
		$elements = $thisUrl.split("/");
		/*
		$elements[0]: https:
		$elements[1]: 
		$elements[2]: www.instagram.com
		$elements[3]: p
		$elements[4]: BU7SuvAlbcY
		$elements[5]: ?taken-by=toylaa
		*/
		$ErrMsg = '';
		//URL formatting checks.
		if ($elements[0] != 'https:' ){ $ErrMsg = '\n- URL not Secure. Please use HTTPS.';}
		//if ($elements[1] != '' )                 { $ErrMsg += '\n- URL not properly formed.';}
		if ($elements[2] != 'www.instagram.com' ){ $ErrMsg += '\n- URL not properly formed.';}
		//check 'taken by ='user in question
		$forge_usn = $("#forge_usn").html();
		if (typeof $elements[5] !== 'undefined' )
		{ 
			$takenByArr = $elements[5].split("=");
			$takenBy = $takenByArr[1];
			//
			if ( $takenBy != $forge_usn ){ $ErrMsg += '\n- You may only Submit posts taken by '+$forge_usn;}	
		}else 
		{
			$ErrMsg += '\n- URL not properly formed.';
		}
		//
		if ($ErrMsg != ''){
			alert('ERROR' + $ErrMsg);
		}
		else if($ErrMsg == ''){			
			submitUrl($thisUrl);
		}
	}

function submitUrl(thisUrl){
	$sbmUrl = thisUrl;
	/*   */
	//alert('Good Link Submitted !');
	/*   */
	jQuery.ajax({
				//
	            type:"get",
	            //dataType:"json",
	            url: "assets/queuer.php",//compoundUrl,
	            //data: {postUrl: $sbmUrl, info: info},
	            data: {postUrl: $sbmUrl},
	            success: function(data) {
	              // Pseudo-Multi-Value
	              results = data.trim().split('^');

	              if (results[0] != 'fail')
	              {
	              	swal ('Ajax Success!', 'results[1]: ' + results[1] );
	              }else
	              {
	              	swal ('FAIL');
	              }

	              
	              //TBD - CHECK response data for Success/Fail 





	            },
	            error: function(data) {
	              	alert("Ajax Error! \ndata: \n"+data); 
	              	//Errors caused by ajax url [level] typically 
	            },
	        });

	

}

</script>