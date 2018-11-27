<?php
require '../log_reg/db-conn.php';
if (isset($_GET['id'])) {
	$id = $conn->real_escape_string($_GET['id']);
	$query = "SELECT * FROM recenzije WHERE id='$id'";
	$result = $conn->query($query);
	if ($result->num_rows == 0) {
		echo 'oops';
	}
	else {
		$row = $result->fetch_assoc();
	}
}
else {
	header("Location: index.php");
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
		<header>
			<div class="navbar navbar-inverse fixed-top div1">
				<a class="navbar-brand" href="../index.php"><img src="../slike/log.jpg" class="img-responsive"></a>
				<div class="pull-right navbar-brand">
					<?php 
					session_start();
					if(isset($_SESSION['username']) || !empty($_SESSION['username'])) {
						if($_SESSION['admin']) {
							echo '<span class="color">Dobrodošao: <span class="font admin">'.$_SESSION['username'].'</span></span>';
							echo ' <a id="out" href="../log_reg/odjava.php" class="btn btn-primary izbor">Odjava</a>';
						}
						else {
							echo '<span class="color">Dobrodošao: <span class="font">'.$_SESSION['username'].'</span></span>';
							echo ' <a id="out" href="../log_reg/odjava.php" class="btn btn-primary izbor">Odjava</a>';
						}
					}
					else {
						echo '<div class="btn btn-group">';
						echo '<a id="log" href="../log_reg/login.php" class="btn btn-primary btn-xs">Prijava </a>';
						echo '<a id="reg" href="../log_reg/register.php" class="btn btn-primary btn-xs">Registriracija </a>';
						echo '</div>';
					}
				?>
				</div>
			</div>
		</header>
		<div>
			<h4 class="inline"><b>Ime proizvoda:</b></h4>
			<h4 class="inline"><?=$row['ime']?></h4><br><br>
		</div>
		<div class="row">
			<div class="form-group col-sm-6">
				<h4><b>Mišljenje:</b></h4>
				<div>
					<p class="misljenje"><?=$row['oProizvodu']?></p><br>
				</div>
			</div>
			<div class="panel panel-default col-sm-6 col-xs-12 pull-right cent">
				<img src="<?=$row['slika']?>" class="img-responsive center-block"></td>
			</div>
		</div>
		<div class="form-group">
			<h4 class="inline"><b>Od kad se koristi:</b></h4>
			<h3 class="inline"> <?=$row['vrijemeKoristenja']?></h3><br><br>
		</div>
		<div class="form-group">
			<h4 class="inline"><b>Ocijena recenzenta:</b></h4>
			<h3 class="inline"> <?=$row['star']?></h3><br><br>
		</div>
		<div class="form-group">
			<h4 class="inline"><b>Recenzent:</b></h4>
			<a class="inline" href="recenzent.php?user=<?=$row['recenzent']?>"><h4 class="inline font1"> <?=$row['recenzent']?></h4></a><br><br>
		</div>
		<?php
			function get_client_ip() {
				$ipaddress = '';
				if (getenv('HTTP_CLIENT_IP'))
					$ipaddress = getenv('HTTP_CLIENT_IP');
				else if(getenv('HTTP_X_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
				else if(getenv('HTTP_X_FORWARDED'))
					$ipaddress = getenv('HTTP_X_FORWARDED');
				else if(getenv('HTTP_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_FORWARDED_FOR');
				else if(getenv('HTTP_FORWARDED'))
				   $ipaddress = getenv('HTTP_FORWARDED');
				else if(getenv('REMOTE_ADDR'))
					$ipaddress = getenv('REMOTE_ADDR');
				else
					$ipaddress = 'UNKNOWN';
				return $ipaddress;
			}
			$ip=get_client_ip();
			$query = "SELECT * FROM ocjene WHERE recenzija_id='$id'";
			$result = $conn->query($query);
			if($result->num_rows > 0) {
				$brojac = 0;
				$ukupno = 0;
				$prosjek = 0;
				$korime = array();
				$iptab = array();
				while($row = $result->fetch_assoc()) {
					$brojac ++;
					$ukupno += $row['ocjena'];
					$korime[] = $row['user_id'];
					$iptab[] = $row['ip'];
				}
				$prosjek = $ukupno / $brojac;
				echo '<div class="form-group pull-right"><h4 class="inline"><b>Ocjena korisnika:</b></h4><h4 class="font inline">'.$prosjek.'</h4></div><br> ';
			}
			else {
				echo '<div class="form-group pull-right"><h4 class="inline"><b>Ocjena korisnika:</b></h4><h4 class="inline"> Nije ocijenjeno</h4></div><br>';
			}
			if(isset($korime)) {
				if(isset($_SESSION['username'])){
					for($i = 0; $i < count($korime); $i++) {
						$glas = 0;
						if($korime[$i] == $_SESSION['username']) {	
							$glas = 1;
							break;
						}
					}
					if($glas == 0) {
						echo '<div class="form-group"><form action="ocijeniti.php?id='.$id.'&ip='.$ip.'" method="POST">
							<h4><b>Ocijenite:</b></h4>
							<div class="col-sm-10">
								<input type="radio" name="star" required value="1" /> 1
								<input type="radio" name="star" value="2" /> 2
								<input type="radio" name="star" value="3" /> 3
								<input type="radio" name="star" value="4" /> 4
								<input type="radio" name="star" value="5" /> 5
								<button name="ocjena" type="submit" value="ocjena" class="btn btn-primary">Ocijeni</button><br><br><br>
						</form></div>';
					}
					else {

						echo '<div class="pull-right"><h4 class="inline pull-right"><b>Glasali ste</b></h4><div><br><br><br>';
					}
						
				}
				else {
					for($i=0; $i<count($iptab); $i++) {
						$glas = 0;
						if($iptab[$i] == $ip) {
							$glas = 1;
							break;
						}
					}
					if($glas == 0) {
						echo '<div class="form-group"><form action="ocijeniti.php?id='.$id.'&ip='.$ip.'" method="POST">
								<h4><b>Ocijenite:</b></h4>
								<div class="col-sm-10">
									<input type="radio" name="star" required value="1" /> 1
									<input type="radio" name="star" value="2" /> 2
									<input type="radio" name="star" value="3" /> 3
									<input type="radio" name="star" value="4" /> 4
									<input type="radio" name="star" value="5" /> 5 <br>
									<button name="ocjena" type="submit" value="ocjena" class="btn btn-primary">Ocijeni</button><br><br><br>
							</form></div>';
					}
					else {
						echo '<div class="pull-right"><h4 class="inline pull-right"><b>Glasali ste</b></h4><div><br><br><br>';
					}
				}
			}
			else {
				echo '<div class="form-group"><form action="ocijeniti.php?id='.$id.'&ip='.$ip.'" method="POST">
					<label for="star" class="col-sm-2 control-label">OCIJENITE</label>
					<div class="col-sm-10">
						<input type="radio" name="star" required value="1" /> 1
						<input type="radio" name="star" value="2" /> 2
						<input type="radio" name="star" value="3" /> 3
						<input type="radio" name="star" value="4" /> 4
						<input type="radio" name="star" value="5" /> 5 <br>
						<button name="ocjena" type="submit" value="ocjena" class="btn btn-primary">Ocijeni</button>
				</form></div>';
			}
		?>
		<?php
			if(isset($_SESSION['admin']) && $_SESSION['admin']){
				echo '<div><form action="delete.php?id='.$id.'" method="POST">';
				echo '<button name="recDel" type="submit" value="recenzijaDelete" class="btn btn-danger">Izbrisi recenziju</button> ';
				echo '</form></div>';
			}
		?>
		<table class="table">
		<?php
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$query = "SELECT * FROM komentari WHERE recenzija_id='$id'";
				$result = $conn->query($query);
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$user = $row['user_id'];
						$sadrzaj = $row['sadrzaj'];
						$komId = $row['kom_id'];
						echo '<tr><div class="container">';
						echo '<td><div class="col-md-2"><a class="font" href="recenzent.php?user='.$user.'">'.$user.'</a></div></td>';
						echo '<div class="col-md-6"><td><p class="komentar">'.$sadrzaj."</p></td></div>";
						echo '<td><p>'.$row['kadJeKomentirano'].'</p></td>';
						if(isset($_SESSION['admin']) && $_SESSION['admin']) {
							echo '<td><div><form action="delete.php?komid='.$komId.'&recid='.$id.'" method="POST">';
							echo '<button name="komDel" type="submit" value="komentarDelete" class="btn-xs btn-danger">Izbrisi komentar</button> ';
							echo '</div></form></td>';
						}
						
						echo '</div></tr>';
					}
				}
				else {
					echo '<td><p>NEMA KOMENTARA</p></td>';
				}
			}
		?>
		</table>
		<form method="POST" action="komentar.php?id=<?=$id?>">
			<div class="container">
				<div class="col-md-8">
					<textarea name="komentar" class="form-control" rows="6" cols="50" maxlength="299" required></textarea>
				</div>
				<div class="col-md-4">
					<input type="submit" value="KOMENTIRAJ">
				</div>
			</div>
		</form><br>
		<footer>
			<div class="navbar navbar-inverse">
				<p class="color font text-center">Copyright 2017 Tomislav Cajbert</p>
			</div>
			<script src="../js/jquery.min.js"></script>
			<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
		</footer>
	</div>
</body>
</html>