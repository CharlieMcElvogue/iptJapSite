<?php

require 'dbConnect.php';

function getConn() {
	global $dbserver, $dbusername, $dbpassword, $dbname;
	$conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if (!$conn) {
		die("Failed to connect to MySQL: " .mysqli_connect_error());
	}
	return $conn;
}

?>