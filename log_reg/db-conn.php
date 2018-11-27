<?php 
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "recenzije";

	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

	if($conn->connect_error) {
		die("Connection to database failed: " . $conn->connect->error);
	}
?>