<?php
//import.php
ini_set('memory_limit', '1280M');
header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
set_time_limit(0);
ob_implicit_flush(1);

session_start();
if(isset($_SESSION['csv_file_name'])){
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

	$file_data = fopen('file/' . $_SESSION['csv_file_name'], 'r');
	$delimiters_list = array("semicolon"=>";","comma"=>",","tab"=>"\t","pipe"=>"|","colon"=>":");
	fgetcsv($file_data);
	// Use ";" delimiter. Otherwise change to "," or the correct one of the file, otherwise data will not be processed correctly
	$delimiter = $delimiters_list[$_SESSION['selected_delimiter']];
	while($row = fgetcsv($file_data,null,$delimiter)){
		$data = array(
		':ip_range_start' => $row[0],
		':ip_range_end' => $row[1],
		':country_code' => $row[2],
		':city' => $row[3],
		':departement' => $row[4], 
		':municipality' => $row[5],
		':postcode' => $row[6],
		':latitude' => $row[7],
		
		':longitude' => $row[8],
		':timezone' => $row[9]
		);
		$selected_country = $_SESSION['selected_country'];
		$query = "INSERT INTO $selected_country (ip_range_start, ip_range_end, country_code, city, departement, municipality, postcode, latitude, longitude, timezone) VALUES (:ip_range_start, :ip_range_end, :country_code, :city, :departement, :municipality, :postcode, :latitude, :longitude, :timezone)";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		if(ob_get_level() > 0){
			ob_end_flush();
		}		
	}
	$filepath_to_delete = "file/".$_SESSION['csv_file_name'];	
	
	unlink($filepath_to_delete);
	unset($_SESSION['csv_file_name']);
	session_write_close();
}
?>