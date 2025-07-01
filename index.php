<?php
if(!session_id()){
 	 session_start();
}// Load the database connexion file
include("connect.php");
include("db_pdo_connection.php");
include("admin_functions.php");
$user_data = check_login($connect_token);
//If remove a table button was clicked
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['empty_table'])){
	$selected_table = $_POST['selected_table'];


	if($selected_table !="na"){
		try {
			$sqlrequest = "TRUNCATE TABLE $selected_table";
			$response = $connect_token_pdo->query($sqlrequest);

		if($response == true){					
			$success_message = "Success, table has been successfully truncated";
		}else{
			$error_message = "Error. The table could not be truncated.";
		}
		}catch(\Throwable $e){
			$error_message = $e->getMessage();
		}
	}else{
		$error_message = "No table selected";
	}
}
?>	
<!DOCTYPE html>
<html lang="en-us">
<head>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/vendor/jquery.min.js"></script>
	<title>CSV Import</title>	
</head>
<body>
<?php
if(!isset($_SESSION['select_table'])){ $_SESSION['select_table'] = "table_1";}
if($_SERVER['REQUEST_METHOD'] == "GET" && strlen(implode(";",$_GET)) > 0){
	$_SESSION['select_table'] = $_GET['tb'];
}
$table = $_SESSION['select_table'];
$res_status = $res_msg = '';
$sqlrequest = "SELECT COUNT( ip_range_start ) AS nbr_entries FROM $table";

$response = $connect_token_pdo->query($sqlrequest);	
$data = $response->fetch();
$nbr_entries = intval($data['nbr_entries']);
$response->closeCursor(); 
// Get status message 
if(!empty($_SESSION['response'])){ 
    $status = $_SESSION['response']['status']; 
    $statusMsg = $_SESSION['response']['msg']; 
    unset($_SESSION['response']); 

}
?>
<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>

</div>
<?php } ?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="#!">Project</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="#!">About</a></li>

			</ul>
				<a href="logout.php" class="btn btn-info btn-lg">
				  <span class="glyphicon glyphicon-log-out"></span> Log out
				</a>
		</div>
	</div>
</nav>	
<div class="row">
    <!-- Import link -->
    <div class="container">
        <div class="d-flex justify-content-center">
			<h1 class="title">Welcome to the database CSV importer</h1>
        </div>
		<div class="d-flex justify-content-center">
            <?php if($nbr_entries > 0){ ?><h5 class="title">Showing 20 rows out of <?php echo $nbr_entries; ?> rows</h5><?php } ?>
        </div>
		<div class="d-flex justify-content-center import_case">
			
			<a href="javascript:void(0);" class="btn btn-primary btn-lg import_btn" onclick="formToggle('importFrm');"><i class="plus" ></i> Import a file</a>
			
		</div>
	<!-- CSV file upload formage -->	
	<div class="d-flex justify-content-center" style="margin-bottom:40px;">
		<div class="frame" id="importFrm" style="display: none;">
			<span id="message"></span>
			<form id="sample_form" name="upload" class="row g-2 float-end extra_params" method="post" enctype="multIPart/form-data">

				<div class="d-flex justify-content-center">
					<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="selected_table">
					  <option value="na" selected>Select database to store your data</option>
					  <option value="table_1">table 1</option>
					  <option value="table_2">table 2</option>
					  <option value="table_3">table 3</option>
					  
					  <option value="table_n">table n</option>
					</select>
				</div>
				<div class="d-flex justify-content-center">
					<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="selected_delimiter">
					  <option value="na" selected>Choose csv delimiter</option>
					  <option value="semicolon">; (Semicolon)</option>
					  <option value="comma">, (Comma)</option>
					  
					  <option value="tab">"__" (Tab)</option>
					  <option value="pipe">| (Pipe)</option>
					  <option value="colon">: (Colon)</option>
					</select>
				</div>
				<div class="col-auto">
					<input type="file" name="file" id="file" class="form-control" required accept=".csv, text/csv"/>
				</div>
				<div class="col-auto">
					<input type="hidden" name="hidden_field" value="1"/>
					<input type="submit" name="import" id="import" class="btn btn-success mb-3" value="Import CSV">
				</div>
				<div class="progress" style="margin-bottom:10px;">
				  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="90" style="width:0%"> 0%</div>
				</div>
				
				<p>Total Data: <span id="total_data">0</span></p>
				<p>Processed amount: <span id="process_data" >0</span></p>
				<p>Initial rows: <span id="initial_rows" >0</span></p>
				<p>Duration: <span id="duration" >0</span> seconds</p>
				<p>Output Logs: <span class="output_logs" ></span></p>
				
				
			</form>
		</div>	
	</div>		
		<div class="d-flex justify-content-center import_case">
			
			<a href="javascript:void(0);" class="btn btn-primary btn-lg import_btn" onclick="formToggle('emptyForm');"><i class="plus" ></i> Empty a Table</a>
			
		</div>
		<!-- CSV file upload formage -->
<div class="d-flex justify-content-center" style="margin-bottom:40px;">		
		<span id="message">
			
			<?php if(isset($success_message)){ ?><div class="alert alert-success"><?php echo $success_message; ?></div><?php } ?>
			<?php if(isset($error_message)){ ?><div class="alert alert-danger"><?php echo $error_message; ?></div><?php } ?>

		</span>			
</div>		
	<div class="d-flex justify-content-center" style="margin-bottom:40px;">

		<div class="frame" id="emptyForm" style="display: none;">

			<form id="empty_tables" name="empty_tables" class="row g-2 float-end extra_params" method="post" enctype="multIPart/form-data">

				<div class="d-flex justify-content-center">
					<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="selected_table">
					  <option value="na" selected>Select table you want to empty (irreversible)</option>
					  <option value="table 1">Table 1</option>
					  <option value="table 2">Table 2</option>
					  <option value="table 3">Table 3</option>
					  
					  <option value="table_n">Table N</option>
					</select>
				</div>
				<div class="col-auto">
					<input type="submit" name="empty_table" id="empty_table" class="btn btn-success mb-3" value="Empty Table">
				</div>
	
				
			</form>
		</div>		
	
	</div>

	<div class="d-flex justify-content-center db_style">
	<h2>Database is: <?php echo $_SESSION['select_table']; ?></h2>
	</div>
    	<div class="d-flex justify-content-center" style="margin-bottom:50px;">
			
			<div class="dropdown">
			  <a class="btn btn-secondary dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Select database
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="index.php?tb=table_1">table_1</a>
				<a class="dropdown-item" href="index.php?tb=table_2">table_2</a>
				<a class="dropdown-item" href="index.php?tb=table_3">table_3</a>
				<a class="dropdown-item" href="index.php?tb=table_n">table_n</a>
			  </div>
			</div>
		</div>
	</div>		
	<!-- Data list table --> 	
	
	<div class="container">
    <table class="table">
		<thead class="table-dark">
            
			<tr>
                <th>IP range start</th>
                <th>IP range end</th>
                <th>table code</th>
                <th>City</th>
                <th>Departement</th>
                <th>Municipality</th>
                <th>Postal code</th>
                <th>Latitude</th>
                <th>Longitude</th>
				<th>Timezone</th>
            </tr>
        </thead>
        <tbody>
        <?php 
		$response = $connect_token_pdo->query($sqlrequest);	
		$i = 0;
        
		// Fetch member records from database 
        $sqlrequest = "SELECT * FROM $table ORDER by ip_range_start ASC LIMIT 100";
		$response = $connect_token_pdo -> query($sqlrequest);
        if($nbr_entries > 0){
            while(($data = $response->fetch()) && $i < 20){ ?>
        
              <tr>
                <td><?php echo $data['ip_range_start']; ?></td>
                <td><?php echo $data['ip_range_end']; ?></td>
                <td><?php echo $data['table_code']; ?></td>
                <td><?php echo $data['city']; ?></td>
                <td><?php echo $data['departement']; ?></td>
                <td><?php echo $data['municipality']; ?></td>
                <td><?php echo $data['postcode']; ?></td>
                <td><?php echo $data['latitude']; ?></td>
                <td><?php echo $data['longitude']; ?></td>
                <td><?php echo $data['timezone']; ?></td>
              </tr>
			  
			  
			  <?php $i+=1; ?>
  <?php     } 
		
		}else{ ?>
            <tr><td colspan="5">No entry(ies) found...</td></tr>
  <?php } ?>
        </tbody>
    </table>
	
	</div>
</div>
<script src="assets/js/main.js"></script>
<script src="assets/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/popper.min.js"></script>
<script src="assets/js/jquery_main.js"></script>

</body>