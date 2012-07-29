<?php
	//Facebook Cookie
	require 'plugins/fbSDK/src/facebook.php';
	$facebook = new Facebook(array(
		'appId'  => '294194807346006',
		'secret' => '2ce6cc90709fcf26821dd350e7a74f50',
	));

	// Load logic for session variables
	require_once ('includes/php_session_header.php');
	
	// See if there is a user from a cookie
	$user = $facebook->getUser();
	
	// Pull in login server login parameters
	require_once ('includes/config.inc.php');
	
	if ($user) {
		
		try {
			$user_profile = $facebook->api('/me');	
			require_once('includes/authentication.php');
		} 
		catch (FacebookApiException $e) {
			//echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			$user = null;
			$_SESSION['LoginMethod'] = 'NA';
		}
	}
	else {
		$_SESSION['LoginMethod'] = 'NA';	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Whizium!</title>

  <!-- LinkedIn Plugin -->
  <script type="text/javascript" src="http://platform.linkedin.com/in.js">
  	api_key: 9sckowtomh3l
  	authorize: false	
  </script>
  	
  <link href="css/mainstyle.css" rel="stylesheet" type="text/css"> 
  
  <!-- LaunchRock Meta Data-->
	<meta property="og:title" content="Project Name - How do you describe your project in one line?" />
    <meta property="og:type" content="company" />
    <meta property="og:site_name" content="Project Name" />
    <meta property="og:url" content="http://www.whizium.com/default.php" />
    <meta property="og:image" content="null" />
    <meta property="og:description" content="Imagine what someone else would want to post on your wall about signing up for your project." />

</head>



<body>
<div id="fb-root"><!-- you must include this div for the JS SDK to load properly --></div>
<strong></strong>
<div class="container">
  
  <!-- Main Navigation Bar -->
  <?php require("nav_bars/MainNavigation.html"); ?>
  
  <!-- Pull in side bar modules -->
  <div class="sidebar">
  
  		<?php 
  		require("nav_bars/SidebarInterest.php");
        require("nav_bars/SidebarLogin.php"); 
		require("nav_bars/LinkedIn_Login.html");?>
	
  <!-- end .sidebar1 -->
  </div>

	
    
  <div class="content">
    
    <!-- Main Video -->
    
    <!-- Not sure we're doing a video this time around -->
    <!--<video width="587" height="440" controls="controls">
      	<source src="includes/SwapLingo Video 1.mp4" type="video/mp4" />
      	<source src="includes/SwapLingo Video 1.ogv" type="video/ogg" />
      	<source src="includes/SwapLingo Video 1.webm" type="video/webm" />
        <object data="includes/SwapLingo Video 1.swf" width="587" height="440">
        <embed src="includes/SwapLingo Video 1.swf" width="587" height="440">
		Your browser does not support video
		</embed>
		</object> 
	</video>-->
    
    </div>
    
    <!-- end .content -->
  	<div class="footer">
  	<hr noshade size=5 color= #7EC0EE />
    <p></p>
    </div>
    <!-- end .footer -->
  	<!-- end .container --></div>
</body>
</html>
