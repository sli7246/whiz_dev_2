<?php

//Confirm user is in the system
$useremail = $user_profile['email'];

require_once (MYSQL);

//Query the database to see if this user has already logged in
$q = "SELECT user_id FROM users WHERE email='$useremail'";	
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

//User has previously logged in and is approved
if (@mysqli_num_rows($r) == 1) {
    
    //Start user sessions
	
    //Pull in results from SQL Query
    $_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
	
    mysqli_free_result($r);
    
    //Identify that user is using FB login -- not needed immediately
    $_SESSION['LoginMethod'] = FB;
}

else {

	//Check that user school has been approved
	
	/*
	// Pull in school list from user's facebook page
	$i = 0;
	while (isset($user_profile['education'][$i])) {
		$school[$i] = $user_profile['education'][$i]['school']['name'];
		$i = $i+1;
	}
	
	//Conversion to sql query list
	$schoollist = "'";
	for ($j = 0; $j < $i; $j++) {
		if ($j == 0) {
			$schoollist = $schoollist . $school[$j];
		}
		else {
			$schoollist = $schoollist . "', '" . $school[$j];
		}
	}
	$schoollist = $schoollist . "'";
	
	$q = "SELECT school_id FROM ApprovedSchools WHERE school in ($schoollist)";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	//If school is approved, register the user
	if (@mysqli_num_rows($r) >= 1) {
	*/
		
    	mysqli_free_result($r);
		
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date, login_method) VALUES ('$user_profile[first_name]'
			, '$user_profile[last_name]', '$useremail', SHA1('N/A'), NOW(), 'facebook')";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		// !!!! Need an error handler here !!!!
		
		$q = "SELECT user_id FROM users WHERE email='$useremail'";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC);
		mysqli_free_result($r);
		
    	$_SESSION['LoginMethod'] = FB;
		$_SESSION['Approved'] = true;
	/*}	
	else {
		session_destroy();
	}*/
}
mysqli_close($dbc);
ob_end_clean();
?>