<?php 
//Admin login functions here
function check_login($connect_token){
	if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";
		$result = mysqli_query($connect_token,$query);
		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}else{

		header("Location: login.php");
		die;
	}
}
?>