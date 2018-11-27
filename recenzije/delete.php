<?php
	require '../log_reg/db-conn.php';
	session_start();
	if(!$_SESSION['admin']){
		header("Location: ../index.php");
	}
	else {
		if(isset($_POST['recDel']) && $_POST['recDel'] == 'recenzijaDelete') {
			$query = "DELETE FROM recenzije WHERE id=".$_GET['id']."";
			if($conn->query($query)){
				echo 'obrisano';
				header("Location: ../index.php");
			}
		}
		
		elseif(isset($_POST['komDel']) && $_POST['komDel'] == 'komentarDelete') {
			$query = "DELETE FROM komentari WHERE kom_id=".$_GET['komid']."";
			if($conn->query($query)){
				echo 'obrisano';
				header("Location: ../recenzije/recenzija.php?id=".$_GET['recid']."");
			}
		}
		
		elseif(isset($_POST['korisnik']) && $_POST['korisnik']  == 'korisnikDel') {
			$user = $_GET['user'];
			$query = "DELETE FROM users WHERE uname='$user'";
			if($conn->query($query)){
				echo 'obrisano';
			}
			else {
				echo 'notok';
			}
		}
		else {
			echo 'nije dobro';
		}
	
	}

?>