<?php
require_once '../log_reg/db-conn.php';
require_once '../lib/class.upload.php';
session_start();
if($_SESSION['loged'] == false) {
	header("Location: ../log_reg/login.php");
}
if($_SERVER['REQUEST_METHOD'] == 'POST'	) {
	$rand = rand (1000, 9999);
	$ime = $conn->real_escape_string($_POST['ime']);
	$vrijemeKoristenja = $conn->real_escape_string($_POST['vrijemeKoristenja']);
	$oProizvodu = $conn->real_escape_string($_POST['oProizvodu']);
	$kategorija = $conn->real_escape_string($_POST['kategorija']);
	$star = $conn->real_escape_string($_POST['star']);
	$imeSlike = 'i'.$rand;
	$putDoSlike = $conn->real_escape_string('../recenzije/slikeProizvoda/'.$imeSlike.$_FILES['slika']['name']);
	$recenzent=$_SESSION['username'];
	
	if(preg_match("!image!", $_FILES['slika']['type'])) {
		
		$handle = new upload($_FILES['slika']);
		if($handle->uploaded) {	
			$handle->file_name_body_pre = $imeSlike;
			$handle->image_resize          = true;
			$handle->image_ratio           = true;
			$handle->image_y               = 350;
			$handle->image_x               = 350;		 
			$handle->process('../recenzije/slikeProizvoda');
			if($handle->processed) {				
				$query = "INSERT INTO recenzije(ime, vrijemeKoristenja, oProizvodu, star, slika, recenzent, kategorija) VALUES ('$ime', '$vrijemeKoristenja', '$oProizvodu', '$star', '$putDoSlike', '$recenzent', '$kategorija') ";
				if($conn->query($query)) {
					echo 'uneseno';
					header("Location: ../recenzije/recenzije.php?kategorija=".$kategorija."");		   
					$handle->clean();
			}
			else{		 
				echo 'error : ' . $handle->error;
			}
			}
		}
	else {
		echo 'nije slika';
	}
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
	<header>
		<div class="navbar navbar-inverse fixed-top div1">
			<a class="navbar-brand" href="../index.php"><img src="../slike/log.jpg" class="img-responsive"></a>
			<div class="pull-right navbar-brand">
				<?php 
					if(isset($_SESSION['username']) || !empty($_SESSION['username'])) {
						if($_SESSION['admin']) {
							echo '<span class="color">Dobrodošao: <span class="font admin">'.$_SESSION['username'].'</span></span>';
							echo ' <a id="out" href="log_reg/odjava.php" class="btn btn-primary izbor">Odjava</a>';
						}
						else {
							echo '<span class="color">Dobrodošao: <span class="font">'.$_SESSION['username'].'</span></span>';
							echo ' <a id="out" href="log_reg/odjava.php" class="btn btn-primary izbor">Odjava</a>';
						}
					}
					else {
						echo '<div class="btn btn-group">';
						echo '<a id="log" href="log_reg/login.php" class="btn btn-primary btn-xs">Prijava </a>';
						echo '<a id="reg" href="log_reg/register.php" class="btn btn-primary btn-xs">Registriracija </a>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</header>
	<div>
		<form class="form-horizontal" role="form" method="post" action="submit.php" enctype="multipart/form-data" autocomplete="off">
			<div class="form-group">
				<label for="ime" class="col-sm-2 control-label">Ime</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="ime" required placeholder="Ime proizvoda" />
				</div>
			</div>
			<div class="form-group">
				<label for="vrijemeKoristenja" class="col-sm-2 control-label">Od kad se koristi</label>
				<div class="col-sm-10">
					<input class="form-control" type="date" name="vrijemeKoristenja" required placeholder="Od kada ga koristite" /><br>
				</div>
			</div>
			<div class="form-group">
				<label for="oProizvodu" class="col-sm-2 control-label">Mišljenje</label>
				<div class="col-sm-10">
					<textarea class="form-control" name="oProizvodu" rows="6" cols="50" maxlength="999"></textarea><br>
				</div>
			</div>
			<div class="form-group">
				<label for="star" class="col-sm-2 control-label">Ocijena</label>
				<div class="col-sm-10">
					<input type="radio" name="star" required value="1" /> 1
					<input type="radio" name="star" value="2" /> 2
					<input type="radio" name="star" value="3" /> 3
					<input type="radio" name="star" value="4" /> 4
					<input type="radio" name="star" value="5" /> 5 <br>
				</div>
			</div>
			<div class="form-group">
				<label for="kategorija" class="col-sm-2 control-label">Odaberi kategoriju</label>
				<div class="col-sm-10">
					<select name="kategorija">
						<option value="informatika">Informatika</option>
						<option value="audio-video">Audio-video</option>
						<option value="mobiteli">Mobiteli</option>
						<option value="kucanski aparati">Kucanski aparati</option>
					</select> <br>
				</div>
			</div>
			<div class="form-group">
				<label for="slika" class="col-sm-2 control-label">Dodaj sliku</label>
				<div class="col-sm-10">
					<input class="form-control" type="file" name="slika" accept="image/*" required /> <br>
				</div>
			</div>
			<div class="form-group">
				<div>
					<input class="form-control" type="submit" value="Postavi"> <br>
				</div>
			</div>
		</form>
	</div>
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