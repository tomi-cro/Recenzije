<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style/style.css">
<title>Page Title</title>
</head>
<body>
	<div>
		<h1>Successful Register <?= $_SESSION['username'] ?></h1>
	</div>
	<a  href="../index.php">Naslovna</a>
</body>
</html>