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
		<div>
			<table class="table table-hover">
				<tbody>
					<?php
						if(isset($_GET['kategorija'])) {
							require_once '../log_reg/db-conn.php';
							$kategorija = $conn->real_escape_string($_GET['kategorija']);
							$query = "SELECT * FROM recenzije WHERE kategorija='$kategorija' ORDER BY id DESC";
							$result = $conn->query($query);
							echo '<h4><bd>Recenzije:</bd><h4>';
							while($row = $result->fetch_assoc()) {
								$id = $row['id'];
								$slika = $row['slika'];
								echo '<tr>';
								echo '<td><img src="'.$slika.'" style="width:150px; height:150px;"></td>';
								echo '<td><a class="font2" href="recenzija.php?id='.$id.'">'.$row['ime'].'</a></td>';
								echo '</tr>';
							}
						}
						

					?>
				</tbody>
			</table>
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
