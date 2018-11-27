<?php
session_start();
require 'db-conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string(md5($_POST['password']));
	$query = "SELECT * FROM users WHERE uname='$username' AND password='$password'";
	$result = $conn->query($query);
	if ($result->num_rows == 0) {
		$conn->close();
		header("Location: unsuccessful.php");
	}
	else {
		$row = $result->fetch_assoc();
		if($row['administrator'] == 'da') {
			$_SESSION['username'] = $username;
			$_SESSION['loged'] = true;
			$_SESSION['admin'] = true;
			header("Location: ../index.php");
		}
		else {
			$_SESSION['username'] = $username;
			$_SESSION['loged'] = true;
			$_SESSION['admin'] = false;
			header("Location: ../index.php");
		}
	}
	
}
?>

<?php
require_once __DIR__ . '/src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '113183566071043',
  'app_secret' => '89065b732f8d986368ebe4104fa83043',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/New%20folder/moja/log_reg/login-callback.php', $permissions);

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
		<div class="row vertical-offset-100">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Prijava</h3>
						<div class="panel-body">
							<form method="post" action="login.php"/>
								<fieldset>
									<div class="form-group">
										<input class="form-control" type="text" name="username" required placeholder="username"/>
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" required placeholder="password"/>
									</div>
									<input class="btn btn-lg btn-success" type="submit" value="Prijava"/>
									<a class="btn btn-lg btn-primary" href="../log_reg/register.php">Registracija</a><br><br>
									<a class="btn btn-lg btn-primary" href="<?=$loginUrl?>">Log in with Facebook!</a>
									<a class="btn btn-md btn-info" href="../index.php" style="margin-left:1em">Nazad</a>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>