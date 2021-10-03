<?php

include('server.php');
$image = $_SESSION['image'];
$image_location = "user profile images/$image";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Social Donors</title>
  <link rel="stylesheet" type="text/css" href="style66.css">
</head>
<style>
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

  <center><h2>User Profile</h2>
  <form method="post">
  <div class="input-group">
    <p> <img src="<?php echo("$image_location") ?>" width="250px">
    </div>
    <div class="input-group">
      <label></label>
      <input type="text" name="" value='<?php echo (''.$_SESSION['email']); ?> '>
    </div>
    <div class="input-group">
      <label></label>
      <input type="text" name="" value='<?php echo (''.$_SESSION['username']); ?> '>
    </div>
  	<div class="input-group">
  	  <label></label>
  	  <input type="password" name=""  value='<?php echo (''.$_SESSION['password']); ?> '>
  	</div>
  
  	<div class="input-group">
  	  <button type="submit" class="btn"  name="userupdate"><a href="userupdate.php">Update<a></button>
  	  <button type="submit" class="btn" name="userdelete"><a href="userdelete.php">Delete<a></button>
  	</div>
  	
    <p>
  	<a href="logout.php">Logout</a>
  	</p>
  </form></center>
</body>
</html>

