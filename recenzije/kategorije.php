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
	<div class="container center">
		<div class="row">
			<div class="col-md-6" ">
				<a href="recenzije.php?kategorija=informatika"><img src="../slike/informatika.jpg" alt="informatika" class="kategorije"></a><br>
				<a href="recenzije.php?kategorija=informatika"><label class="font1 col-md-6">Informatika</label></a>				
			</div>			
			<div class="col-md-6" >
				<a href="recenzije.php?kategorija=audio-video"><img src="../slike/audio_video.jpg" alt="audio-video" class="kategorije"></a><br>
				<a href="recenzije.php?kategorija=audio-video"><label class="font1 col-md-6">Audio-video</label></a>				
			</div>			
		</div>
		<div class="row">
			<div class="col-md-6">
				<a href="recenzije.php?kategorija=mobiteli"><img src="../slike/mobitel.jpg" alt="mobiteli" class="kategorije"></a><br>				
				<a href="recenzije.php?kategorija=mobiteli"><label class="font1 col-md-6">Mobiteli</label></a>
			</div>
			<div class="col-md-6">
				<a href="recenzije.php?kategorija=kucanski aparati"><img src="../slike/kucanski_aparati.jpg" alt="kućanski aparati" class="kategorije"></a><br>			
				<a href="recenzije.php?kategorija=kucanski aparati"><label class="font1 col-md-6">Kucanski aparati</label></a>
			</div>
		</div>
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
