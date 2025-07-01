<?php
ini_set('memory_limit', '1280M'); 
session_start();
if(isset($_POST['hidden_field'])){

	$error = '';
	$total_line = '';

 if($_FILES['file']['name'] != ''){
  $allowed_extension = array('csv');
  $file_array = explode(".", $_FILES["file"]["name"]);
  $extension = end($file_array);  

  if(in_array($extension, $allowed_extension)){
   $new_file_name = rand() . '.' . $extension;
   $_SESSION['csv_file_name'] = $new_file_name;
   $_SESSION['selected_country'] = $_POST['selected_country'];
   $_SESSION['selected_delimiter'] = $_POST['selected_delimiter'];
   if($_SESSION['selected_country'] !="na"){
	   if($_SESSION['selected_delimiter'] !="na"){
			move_uploaded_file($_FILES['file']['tmp_name'], 'file/'.$new_file_name);
			$file_contents = file('file/'. $new_file_name, FILE_SKIP_EMPTY_LINES);
			$total_line = count($file_contents);
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
			$selected_country = $_SESSION['selected_country'];
			$query = "SELECT * FROM $selected_country";
			$statement = $connect->prepare($query);
			$statement->execute();
			
			$initial_row_count = $statement->rowCount();
	   }else{
		   $error = "No delimiter has been selected";
	   }
   }else{
	   $error = 'No country has been selected';
   }

  }
  else
  {
	$error = 'Only CSV file format is allowed';
  }
 }else{
	$error = 'Please Select File';
 }

 if($error != ''){
  $output = array(
   'error'  => $error
  );
 } 
 else{
  $output = array(
   'success'  => true,
   'total_line' => ($total_line - 1),  
   'initial_rows' => $initial_row_count,
   
   'selected_country' => $_SESSION['selected_country']
   );
 }

	echo json_encode($output);
}
session_write_close();
?>