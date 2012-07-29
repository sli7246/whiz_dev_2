<?php

	// Start local sessions
	session_start();
	
	// Time out script
	$inactive = 600;
	
	// check to see if $_SESSION['timeout'] is set
	if(isset($_SESSION['timeout']) ) {
		$session_life = time() - $_SESSION['timeout'];
		
		if($session_life > $inactive)
			{ 
				session_destroy(); 
				header("Location: http://www.whizium.com/default.php"); }
			}
	$_SESSION['timeout'] = time();

?>