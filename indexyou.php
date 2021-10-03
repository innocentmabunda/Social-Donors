<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . "/scibonostream/functions-page.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Social Donars</title>
	<link rel="stylesheet" href="style10.css">
</head>
<style type="text/css">
	input{
		display: block;
		padding: 10px;
		margin: 10px;
	}
</style>
<body class="body4">
<!-- <h1>Social Donars</h1> -->

<?php 
	if (isset($_SESSION['email'])) {
		$email = $_SESSION['email'];
		$name = $_SESSION['name'];
		$number = $_SESSION['number'];
		$id = $_SESSION['id'];
		$image = $_SESSION['image'];
		$surname = $_SESSION['surname'];

		// alert('you are logged in');

		include_once($_SERVER['DOCUMENT_ROOT'] . "/registration - Copy/profile-form.php");
	}
	

?>
<!-- <h2>See all users</h2>
<form action="load-page.php" method="post">
	<input type="submit" name="all_users">
</form> -->
<br><br><br>
<center><h2>Sign up form</h2>
<form action="load-page.php" method="post" enctype='multipart/form-data'>
	<input type="email" name="email" placeholder="Email">
	<input type="text" name="name" placeholder="Name">
	<input type="text" name="number" placeholder="Number">
	<input type="text" name="surname" placeholder="Surname">
	<input type="password" name="password" placeholder="Password">
	<input type="password" name="confirm_password" placeholder="Confirm Password">
	<input type='file' name='image' accept='image/*'>
	<input type="submit" name="register">
</form>

<h2>Login form</h2>
<form action="load-page.php" method="post">
	<input type="text" name="email" placeholder="Email">
	<input type="password" name="password" placeholder="Password">
	<input type="submit" name="login">
</form></center>
</body>
</html>