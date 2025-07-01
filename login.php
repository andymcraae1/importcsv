<?php
	session_start();
	include("connect.php");
	include("admin_functions.php");
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$algorithm = "tiger160,3";
		$password_hash = hash($algorithm,$password);
		//echo "Data given is $user_name - $password";
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
			//Read from the database
			
			$query = "select * from users where user_name = '$user_name' limit 1";	
			$result  = mysqli_query($connect_token,$query);
			if($result){
				if($result && mysqli_num_rows($result)> 0){
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] == $password_hash){
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}else{
						$error_msg = "Wrong password entered";
					}
				}else{
					$error_msg = "No user found";
				}
			}
		}else{
			$error_msg = "Please enter some valid information";
		}
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Admin Portal</title> 
    
	<link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/fontawesome/css/all.min.css">
  </head>
  <body>
    <div class="container">
      
	  <div class="wrapper">
		
        <div class="title">Admin Portal</div>
        <form id="formulaire" method="post">
          <div class="row">
            <i class="fas fa-user"></i>
             <input type="text" name="user_name" placeholder="Login">
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
          <?php if (isset($error_msg)) { 
			?>
			  <div class="pass" style="color:red;"><?php echo $error_msg; ?></div>
			<?php
		  }?>		  
          <div class="pass"><a href="#">Forgotten Password?</a></div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
		  <div class="signup-link">Not a member?<a href="#">Inscription</a></div>
        </form>
      </div>
    </div>
  </body>
</html>