<?php
	session_start();
	unset($_SESSION['fap_uid']);
	unset($_SESSION['fap_utype']);
	unset($_SESSION['fap_uemalid']);
	header('Location: index.php');
?>