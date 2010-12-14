<?php session_start();
//print_r($_SESSION);

function adminheader()  {
?>  
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
	   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		
		<title>open - lifestyle linking</title>
		<meta name="description" content="Main Page" />
		<meta name="page-topic" content="Homepage" />
		
		<meta name="robots" content="all" />
		<meta name="author" content="" />
		<meta name="author" content="" />
		<meta name="Keywords" content="" /> 	
		
		<!--Main Style Sheet-->
		<!--session selector to pick which stylesheet based on context if this header is in a php function-->
		<link href="css/admin.css" type="text/css" rel="stylesheet" id="stylesheet" />
		
	</head>
	
	<?php   
}  // closes pageheader()  

adminheader();

?>

<body>

	<div id="container"> <!--is closed in footer.php-->

<div class="controlheader">
<a href="controlpanel/index.php">HOME</a>
<a href="controlpanel/dailyupdate.php">Dailyupdate</a>
<a href="controlpanel/flickrdaily.php">Daily flickr photos</a>
<!--<a href="/lifestylelinking/oauth/oauth-php-r50/test/firstinstantance.php">OAuth</a> -->
Youtube done live
<a href="controlpanel/definitioncontrol.php">Definitions Control</a> 
<!-- <a href="/lifestylelinking/crawl/rsscrawlauto.php">Crawl centre</a>  -->
<a href="controlpanel/newdata.php">Add newdata</a>  
<a href="controlpanel/peercontrol.php">Peer group Control</a>
<a href="controlpanel/themes.php">Themes</a>
<a href="controlpanel/login/logout.php">logout</a>
</div>  <!-- closes controlheader class -->



