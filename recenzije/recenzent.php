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
			<?php
				require_once '../log_reg/db-conn.php';
				if(isset($_GET['user'])){
					$user = $conn->real_escape_string($_GET['user']);
					$query = "SELECT * FROM users WHERE uname='$user'";
					$result = $conn->query($query);
					if($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$uname = $row['uname'];
						$fname = $row['fname'];
						$lname = $row['lname'];
						$email = $row['email'];
						echo '<div>';
						echo '<h4><b>Korisnik:</b> '.$uname.'<br><br></h4>';
						echo '<h4><b>Ime:</b> '.$fname.'</h4>';
						echo '<h4><b>Prezime:</b> '.$lname.'</h4>';
						echo '<h4><b>Email:</b> '.$email.'<br><br><br><br></h4>';
						echo '</div>';						
					}
					else echo '<h4>Korisnik nepostoji</h4>';
				}
				else {
					echo '<h3>oops</h3>';
				}
			?>
		</div>
	</div>
	<div>
		<div>
			<table class="table table-hover">
				<tbody>
					<?php
						require '../log_reg/db-conn.php';
						if(isset($_GET['user'])){
							echo '<h4 ><b>Recenzije:</b></h4>';
							$user = $conn->real_escape_string($_GET['user']);
							$query = "SELECT * FROM recenzije WHERE recenzent='$user'";
							$result = $conn->query($query);
							if($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
										$id = $row['id'];
										$slika = $row['slika'];
										echo '<tr>';
										echo '<td><img src="'.$slika.'" style="width:150px; height:150px;"></td>';
										echo '<td><a href="recenzija.php?id='.$id.'">'.$row['ime']."</a></td>";
										echo '</tr>';
								}
							}
							else echo '<td><h4>Nema recenzija</h4></td>';
						}
						else {
							echo '<h3>oops</h3>';
						}
					?>
				</tbody>
			</table>
			<?php
				if(isset($_SESSION['admin'])){
					echo '<div><form action="delete.php?user='.$user.'" method="POST">';
					echo '<button name="korisnik" type="submit" value="korisnikDel" class="btn btn-danger">Izbrisi korisnika</button> ';
					echo '</form></div>';
			}
			?>
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