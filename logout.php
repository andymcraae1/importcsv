<?php
	session_start();
	include("connect.php");
	include("admin_functions.php");
	if(isset($_SESSION['user_id'])){
		unset($_SESSION['user_id']);
	}
	header("Location: login.php");
	die;
?>