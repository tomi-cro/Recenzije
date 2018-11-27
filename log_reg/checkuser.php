<?php
require 'db-conn.php';
$username = $conn->real_escape_string($_POST['username']);
$query = "SELECT * FROM users WHERE uname ='".$username."'";
$result=$conn->query($query);
$num_rows = $result->num_rows;

if($num_rows > 0) {
	echo '<p class="font" style="color:red;">Username alredy exist</p>';
}
else {
	echo '<p class="font" style="color:green;">Username available</p>';
}

?>