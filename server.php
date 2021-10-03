<?php 

session_start();

$con = mysqli_connect('localhost', 'root', '', 'mydb');

//////////////////////////////////////////////////////////////////////////////////////////
function image_process($varconn,$dir,$image,$file_type,$file_size,$file_tem_loc){


	if (is_dir($dir) === false){
			mkdir($dir);
		}
	switch($file_type)
	{
		case 'image/jpeg':  $ext = 'jpg';   break;
		case 'image/gif':   $ext = 'gif';   break;
		case 'image/png':   $ext = 'png';   break;
		case 'image/tiff':  $ext = 'tiff';  break;	
		case 'image/jfif':  $ext = 'jpg';  break;	
		default:       
		alert("$file_type is not a valid image file $image unallowed");
		redirect_back();
	} 

	if ($ext)
	{	

		$file_store = "$dir/$image";

		move_uploaded_file($file_tem_loc, $file_store);

		return "$image";

	}
	else
	{
		alert("Something went wrong with the upload. Try a different one.");
		redirect_back();

	}

}
/////////////////////////////////////////////////////////////////////

// REGISTER USER
if (isset($_POST['reg_user'])) {

  $original_file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$image = $original_file_name;
	$file_type = $file_type;
	$file_size = $_FILES['image']['size']; 	
	$file_tem_loc = $_FILES['image']['tmp_name'];

  // receive all input values from the form
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array

  $errors = 0;

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM `users`;";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  // if (count($errors) == 0) {
  	// $password = md5($password_1);//encrypt the password before saving in the database
  	$password = $password_1; 

    $dir = 'user profile images';

  	$image = image_process($con,$dir,$image,$file_type,$file_size,$file_tem_loc);

  	$query = "INSERT INTO `users`(`username`, `email`,`password`,`image`, )
  			  VALUES('$username', '$email', '$password','$image');";
  	mysqli_query($con, $query);
   
  	header('location: login.php');
  // }
}

// ... 


// LOGIN USER
if (isset($_POST['login_user'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
  
    // if (empty($email)) {
    //     array_push($errors, "email is required");
    // }
    // if (empty($password)) {
    //     array_push($errors, "Password is required");
    // }
  
    //if (count($errors) == 0) {
       
        $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password`='$password';";


        $result = mysqli_query($con, $query);

        $number_of_rows = mysqli_num_rows($result);

        if ($number_of_rows == 1) {
            while ($row = mysqli_fetch_assoc($result)) { 
               $_SESSION['email'] = $row['email'];
               $_SESSION['username'] = $row['username'];
               $_SESSION['password'] = $row['password'];
               $_SESSION['image'] = $row['image'];
               $_SESSION['id'] = $row['id'];
            }


          header('location: profile.php');
          
          
        } else {
            echo "error";
         
    }
  }
  
  ?>