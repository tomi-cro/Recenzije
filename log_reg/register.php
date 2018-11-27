<?php
require 'db-conn.php';
session_start();
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	if ($_POST['pass'] === $_POST['pass2']) {
		$username = $conn->real_escape_string($_POST['username']);
		$password = md5($_POST['pass']);
		$email = $conn->real_escape_string($_POST['email']);
		$fname = $conn->real_escape_string($_POST['fname']);
		$lname = $conn->real_escape_string($_POST['lname']);
		$sql = "INSERT INTO users(uname, password, email, fname, lname) VALUES ('$username', '$password', '$email', '$fname', '$lname')";
		if ($conn->query($sql)) {
			$conn->close();
			$_SESSION['username'] = $username;
			$_SESSION['loged'] = true;
			$_SESSION['admin'] = false;
			$conn->close();
			header("Location: successfulreg.php");
		} else {
			$conn->close();
			header("Location: unsuccessful.php");
		}
	} 
	else {
		 echo "<script>
				alert('Not equal passwords');
			</script>";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="../slike/dvogled.png">
<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../style/style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RECENZIJE</title>
</head>
<body>
	<div class="container">
		<h1 class="text-center font">Registracija</h1>
			<form class="form-horizontal" action="register.php" method="post" role="form">
				<div class="form-group">
					<label for="fname" class="col-sm-3 control-label">Ime</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="fname" placeholder="First name" required />
					</div>
				</div>
				<div class="form-group">
					<label for="lname" class="col-sm-3 control-label">Prezime</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="lname" placeholder="Last name" required />
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-3 control-label">Korisnicko ime</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="username" placeholder="Username" required onkeyup="check_user(this.value)" />
					</div>
					<div class="col-sm-3">
						<span id="msg" class="col-sm-3"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<input class="form-control" type="email" name="email" placeholder="Email" required />
					</div>
				</div class="input-group input-group-md">
				<div class="form-group">
					<label for="pass" class="col-sm-3 control-label">Lozinka</label>
					<div class="col-sm-9">
						<input class="form-control" type="password" name="pass" placeholder="Password" required pattern=".{4,}"   required title="4 characters minimum"/>
					</div>
				</div>
				<div class="form-group">
					<label for="pass2" class="col-sm-3 control-label">Potvrda lozinke</label>
					<div class="col-sm-9">
						<input class="form-control" type="password" name="pass2" placeholder="Confirm password" required pattern=".{4,}"   required title="4 characters minimum"/>
					</div>
				</div>
				<div class="col-sm-3">
				</div>
				<div class="form-goroup col-sm-9">
					<input class="form-control btn" type="submit" name="Register" value="Registracija"/>
				</div>
			</form>
	</div>
	<a href="../index.php" class="btn btn-primary">Nazad</a>
	<script src="../js/jquery.min.js"></script>
	<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function check_user(val){
			$.ajax({
				type: "POST",
				url: "checkuser.php",
				data: 'username=' + val,
				success: function(data) {
					$("#msg").html(data);
				}
				
			})
			
		}
	</script>
</body>
</html>