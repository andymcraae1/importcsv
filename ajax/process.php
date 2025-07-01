<?php
//process.php
ini_set('memory_limit', '1280M');
try{
	// prevent caching
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$dbuser = "root";
		$dbpass = "";
		
		$dbhost ="mysql:host=localhost;dbname=my_database;charset=utf8mb4";
		$connect = new PDO($dbhost, $dbuser, $dbpass, $pdo_options);
	}catch(Exception $e){		
		print "Error!: " . $e->getMessage() . "<br/>";
		die('Error : '.$e->getMessage());
	}
	$selected_country = $_POST['user_selected_country'];
	$query = "SELECT * FROM $selected_country";
	$statement = $connect->prepare($query);
	$statement->execute();
	echo $statement->rowCount();
}catch(\throwable $e){		
	echo "Error: ".$e->getMessage();
}
?>