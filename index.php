
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="../slike/dvogled.png">
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style/style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RECENZIJE</title>
</head>
<body>
<div class="container">
	<header>
		<div class="navbar navbar-inverse fixed-top div1">
			<a class="navbar-brand" href="index.php"><img src="slike/log.jpg" class="img-responsive"></a>
			<div class="pull-right navbar-brand">
				<?php 
					session_start();
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
		
		<div id="theCarousel" class="carousel slide vel" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#theCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#theCarousel" data-slide-to="1" ></li>
			<li data-target="#theCarousel" data-slide-to="2" ></li>
		</ol>
			<div>
				<div class="carousel-inner">
					<div class="item active">
					<img id="slika" class="first-slide img-responsive slika" src="slike/alati.jpg" alt="First slide">
					<div class="slide1"></div>
					<div class="container">
					<div class="carousel-caption">
						<h1 class="font">KUPUJTE PAMETNO</h1>
					</div>
					</div>
					</div>
					
					<div class="item">
					<img id="slika" class="second-slide img-responsive slika" src="slike/auti.jpg" alt="First slide">
					<div class="slide2"></div>
					<div class="carousel-caption">
						<h1 class="font">KUPUJTE JEFTINO</h3>
					</div>
					</div>
					
					<div class="item">
					<img id="slika" class="third-slide img-responsive slika" src="slike/ladica.jpg" alt="First slide">
					<div class="slide3"></div>
					<div class="carousel-caption">
						<h1 class="font">UŠTEDITE VRIJEME</h1>
					</div>
					</div>
				</div>
				<a class="left carousel-control" href="#theCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a>
				<a class="right carousel-control" href="#theCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
		</div>
	<section>
		<div class="row">
			<div class="col-xs-12 col-sm-12 btn-group-horizontal">
				<a href="recenzije/kategorije.php" class="btn btn-default btn-block">Pregledaj recenzije</a>
			</div>
			<div class="col-xs-12 col-sm-12 btn-group-horizontal">
				<a href="recenzije/submit.php" class="btn btn-default btn-block">Napravi recenziju</a>
			</div>
		</div>
	</section>
	<footer>
		<div class="navbar navbar-inverse">
			<p class="color font text-center">Copyright 2017 Tomislav Cajbert</p>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	</footer>
</div>
</body>

</html>