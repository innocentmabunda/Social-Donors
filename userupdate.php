<?php 
include 'server.php';
$image = $_SESSION['image'];
$image_location = "user profile images/$image";

if(isset($_POST['changes'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = "UPDATE `users` SET `username` = '$username' WHERE `users`.`email` = '$email';";
    $result = mysqli_query($con,$sql);

    $sql = "UPDATE `users` SET `password` = '$password' WHERE `users`.`email` = '$email';";

    $result = mysqli_query($con,$sql);
    if($result){
        echo("<script type=\"text/javascript\">
		alert(\"Your profile has been updated. Please log in again to see changes\");
		</script>");
    }else{
       echo"not done";
    }
}

if(isset($_POST['image'])){
  
    $email = $_POST['email'];

    $original_file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$image = $original_file_name;
	$file_type = $file_type;
	$file_size = $_FILES['image']['size']; 	
	$file_tem_loc = $_FILES['image']['tmp_name'];

    
    $dir = 'user profile images';

  	$image = image_process($con,$dir,$image,$file_type,$file_size,$file_tem_loc);

    $sql = "UPDATE `users` SET `image` = '$image' WHERE `users`.`email` = '$email';";

    $result = mysqli_query($con,$sql);
    if($result){
        echo("<script type=\"text/javascript\">
		alert(\"Your profile image has been updated. Please log in again to see changes\");
		</script>");
    }else{
       echo"not done";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style66.css">
</head>
<style>
    h1 {
        color: white;
    }
    P {
        color: white;
    }
   
img{
  border: 2px solid;
  color: white;
  border-bottom-left-radius:25px;
  border-bottom-right-radius:25px;
  border-top-left-radius:25px;
  border-top-right-radius:25px;
  
}
h2{
  color: white;
}
</style>



<body class="bodyy">

	<center>
		<form action="userupdate.php" method="post" enctype='multipart/form-data'>
			<span>* Email cannot be changed at this time*</span>
			<input type="text" hidden name='email' value='<?php echo("". $_SESSION['email']); ?>'>
			<h1>Welcome <?php echo("". $_SESSION['username']); ?></h1><br>
			
			<!-- <p>Profile Picture<br> <img src="<?php echo("$image_location") ?>" width="300px">
			<br>
			<input type='file' name='image' accept='image/*' id="image">
			<br>
			<input type="submit" name="update_profile_picture" value="Update my profile picture">

			</p> -->
            <p><br> <img src="<?php echo("$image_location") ?>" width="250px">
            <p><input type='file' name='image' class='button' accept='image/*' id="image"></p>
			<input type="submit" name="image" class="button" value="Update profile photo">
			<p>Username <input type="text" class="s_sign_up" name="username" value='<?php echo("". $_SESSION['username']); ?>'></p>
			
			<p>Password <input type="text" class="s_sign_up" name="password" value='<?php echo("". $_SESSION['password']); ?>'></p>
            
			<input type="submit" name="changes" class="button" value="Update my info"><br>
            
			<a href="logout.php">Logout</a><br>
            <a href="userdelete.php">Delete</a>
            
			
		</form>
        
		<!-- <input type="button" class="b_button" name="" value="Save changes"> -->
		<p> </p>
	</body>
</center>
</html>
