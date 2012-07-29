<?php # Script 16.4 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

// Set the database access information as constants:
DEFINE ('DB_USER', 'whiz7543');
DEFINE ('DB_PASSWORD', 'Jjg12.Lwl');
DEFINE ('DB_HOST', 'whiz7543.db.9577042.hostedresource.com');
DEFINE ('DB_NAME', 'whiz7543');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$dbc) {
	trigger_error ('Could not connect to MySQL: ' . mysqli_connect_error() );
}

?>
