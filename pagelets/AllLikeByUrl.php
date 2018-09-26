<?php 
 session_start(); 
 $username = $_SESSION["forge_usn"];
 echo '<div style="display:none;" id="forge_usn">'.$username.'</div>';
?>


<div class="jumbotron">
	<h1>PowerPooling by URL </h1>
<h4>Got a new post? Let's generate some power likes.</h4>



</div>



<div class="jumbotron">

	<h3 style="text-align:left;">Guidelines</h3>
	<hr style="width:50%;float:left;background-color: white;">
	<div style="clear:left;"></div>
	<ul style="text-align:left;">
		<li> Go to Instagram.com/<?=$username; ?></li>
		<li> Copy the FULL URL of any post you wish to submit.</li>
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
		$url = document.getElementById("urlIn").value;
		$elements = $url.split("/");
		/*
		$elements[0]: https:
		$elements[1]: 
		$elements[2]: www.instagram.com
		$elements[3]: p
		$elements[4]: BU7SuvAlbcY
		$elements[5]: ?taken-by=toylaa
		*/
		ErrMsg = '';
		//URL formatting checks.
		if ($elements[0] != 'https:' ){ ErrMsg = '-URL not Secure. Please use HTTPS.';}
		if ($elements[1] != '' )                 { ErrMsg = '-URL not properly formed.';}
		if ($elements[2] != 'www.instagram.com' ){ ErrMsg = '-URL not properly formed.';}
		//check 'taken by ='user in question
		$forge_usn = $("#forge_usn").html();
		$takenByArr = $elements[5].split("=");
		$takenBy = $takenByArr[1];
		//
		if ( $takenBy != $forge_usn ){ ErrMsg += '\nYou may only Submit posts taken by '+$forge_usn;}	
		//
		if (ErrMsg != ''){
			swal('ERROR', ErrMsg);
		}
		else if(ErrMsg == ''){			
			submitUrl($url);
		}	
	}

function submitUrl(){
	swal("Good Link submitted! ", $url);
	//TBD - do something with aJax()?
	/**/
}

</script>