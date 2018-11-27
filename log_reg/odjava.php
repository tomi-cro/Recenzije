<?php
session_start();
session_destroy();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
session_destroy();
header("Location: ../index.php");
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="slike/dvogled.png">
<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../style/style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
	<header>
		<div class="navbar navbar-inverse fixed-top div1">
			<a class="navbar-brand" href="../index.php"><img src="../slike/log.jpg" class="img-responsive"></a>
			<div class="pull-right navbar-brand">
			</div>
		</div>
	</header>

	<h1>Dodite nam opet</h1>
	<a class="btn btn-primary" href="../index.php">Naslovna</a>
</div>
</body>
</html>