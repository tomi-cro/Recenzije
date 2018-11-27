<?php
	require '../log_reg/db-conn.php';
	session_start();
	if ($_SESSION['loged']){
		if(isset($_POST['komentar'])) {
			$date = date('Y-m-d H:i:s');
			$query = "INSERT INTO komentari(sadrzaj, recenzija_id, user_id, kadJeKomentirano) VALUES ('".$_POST['komentar']."', '".$_GET['id']."', '".$_SESSION['username']."', '".$date."')" ;
			if($conn->query($query)) {
				header("Location: ../recenzije/recenzija.php?id=".$_GET['id']."");		   
			}
			else{		 
				echo 'error : ';
			}
		}
	}
	else {
		header("Location: ../log_reg/login.php");
	}
?>