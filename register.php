<?php 
include('server.php');
if(isset($_POST['submit'])){
  
    $email = $_POST['email'];
    $username = $_POST['username'];
    $ip = gethostbyname("localhost");
	
    $password = $_POST['password'];
  

    $sql = "INSERT INTO `users` (email,username,password,ipAddress) values('$email', '$username', '$password')";
    $result = mysqli_query($con,$sql);
    if($result){
        // echo "Data inserted successfully";
        header('location:');
    }else{
        die(mysqli_error($con));
    }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Social Donors</title>
  <link rel="stylesheet" type="text/css" href="style66.css">
</head>
<style>
	h2{
		color:white;
	}
</style>
<body class="bodyy"><br><br><br><br>
  
  <center><h2>Register</h2>
  
	
  <form method="post" action="register.php" enctype='multipart/form-data'>
  	<div class="input-group">
  	  <label></label>
  	  <input type="text" name="username" placeholder=" Enter username" >
  	</div>
  	<div class="input-group">
  	  <label></label>
  	  <input type="email" name="email" placeholder="Enter your email" >
  	</div>
  	<div class="input-group">
  	  <label></label>
  	  <input type="password" name="password_1" placeholder="Enter your password" >
  	</div>
  	<div class="input-group">
  	  <label></label>
  	  <input type="password" name="password_2" placeholder="Confirm your password">
  	</div>
	  <div class="input-group">
	  <input type='file' name='image' class='button' accept='image/*' id="image">
	</div>
	
	<div class="form-group mb-3">
    <label for=""></label>
    <input type="datetime-local" name="event_dt" class="form-control">
    </div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form></center>
</body>
</html>