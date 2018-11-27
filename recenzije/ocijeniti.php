<?php
	require '../log_reg/db-conn.php';
	session_start();
	if(isset($_SESSION['loged'])) {
		if(isset($_POST['ocjena']) && $_POST['ocjena'] == 'ocjena') {
			$query = "INSERT INTO ocjene (recenzija_id, user_id, ocjena) VALUES ('".$_GET['id']."', '".$_SESSION['username']."', '".$_POST['star']."' )";
			if($conn->query($query)){
				header("Location: ../recenzije/recenzija.php?id=".$_GET['id']."");
			}
			else {
				echo 'fail';
			}
		}
		else {
			echo 'fail';
		}
	}
	else {
		if(isset($_POST['ocjena']) && $_POST['ocjena'] == 'ocjena') {
			$query = "INSERT INTO ocjene (recenzija_id, ip, ocjena) VALUES ('".$_GET['id']."', '".$_GET['ip']."', '".$_POST['star']."' )";
			if($conn->query($query)){
				header("Location: ../recenzije/recenzija.php?id=".$_GET['id']."");
			}
			else {
				echo 'faii';
			}
		}
		else {
			echo 'fail';
		}			
	}
?>