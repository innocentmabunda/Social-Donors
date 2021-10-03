<?php  
include_once($_SERVER['DOCUMENT_ROOT'] . "/registration - Copy/functions-page.php");


if (isset($_POST['register'])) {
	$email = post_check("email");
	$email = sanitizeString($email);
	$surname = post_check("surname");
	$surname = sanitizeString($surname);
	$number = post_check("number");
	$number = sanitizeString($number);
	$password = post_check("password");
	$password = sanitizeString($password);
	$name = post_check("name");
	$name = sanitizeString($name);
	$confirm_password = post_check("confirm_password");
	$confirm_password = sanitizeString($confirm_password);

	$original_file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$image = sanitizeString($original_file_name);
	$file_type = sanitizeString($file_type);
	$file_size = $_FILES['image']['size']; 	
	$file_tem_loc = $_FILES['image']['tmp_name'];

	confirm_match($password,$confirm_password);
	$password = password_hash($password, PASSWORD_DEFAULT);
	// $active = "";
	$id = rand(10000,99999);
	check_if_exists($conn,$dbname,'users','email',$email);
	check_if_exists($conn,$dbname,'users','id',$id);
	// $verification_code = rand(1000,9999);
	insert_info($conn,$dbname,'users','email',$email);
	// insert_info($conn,$dbname,'orders','id',$id);

	$dir = 'images';

	$image = image_process($conn,$dir,$image,$file_type,$file_size,$file_tem_loc);
	update_info($conn,$dbname,'users','id','email',$id,$email);
	update_info($conn,$dbname,'users','name','email',$name,$email);
	update_info($conn,$dbname,'users','number','email',$number,$email);
	update_info($conn,$dbname,'users','surname','email',$surname,$email);
	update_info($conn,$dbname,'users','image','email',$image,$email);

	// update_info($conn,$dbname,'users','last_email_verification_code','email',$verification_code,$email);
	// update_info($conn,$dbname,'users','verificated','email','no',$email);
	// update_info($conn,$dbname,'users','email','email',$email,$email);
	update_info($conn,$dbname,'users','password','email',$password,$email);
	alert('Account created sucessfully please check your email inbox');

	///////////////////////////////////////////////////////////////

	// send_email('kpautoreplyservice@gmail.com',"$email","$name",'Kingproteas registration',"Thank you for registering to Kingproteas. Click here to verify your account. Your verification code is $verification_code <a href='https://intown-lubrication.000webhostapp.com/verification-page.php'>Verify me</a>");

	///////////////////////////////////////////////////////////////
	$location = "indexyou.php";
	go_to($location);
}

if (isset($_POST['login'])) {
	$email = post_check("email");
	$email = sanitizeString($email);
	$password = post_check("password");
	$password = sanitizeString($password);
	pair_for_login($conn,'users',"email",$email,"password",$password);
	$ipaddress = get_ipaddress();

	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$surname = $_SESSION['surname'];
	$id = $_SESSION['id'];
	$datetime = "Date " . date("Y-m-d @ h:i:s a");
	$logs_id = rand(10000,99999);

	$name = $_SESSION['name'];
	$surname = $_SESSION['surname'];
	$datetime = "Date " . date("Y-m-d @ h:i:s a");
	$ipaddress = get_ipaddress();
	//$ipaddress = implode(" ",$ipaddress);
	$device = get_device();
	insert_info($conn,$dbname,'logs_in','id',$logs_id);
	update_info($conn,'','logs_in','name','id',$name,$logs_id);
	update_info($conn,'','logs_in','device','id',$device,$logs_id);
	update_info($conn,'','logs_in','email','id',$email,$logs_id);
	update_info($conn,'','logs_in','surname','id',$surname,$logs_id);
	update_info($conn,'','logs_in','ipaddress','id',$ipaddress,$logs_id);
	update_info($conn,'','logs_in','datetime','id',$datetime,$logs_id);
	
	$location = "indexyou.php";
	go_to($location);

}

if (isset($_POST['all_users'])) {
	
	$query = "SELECT * FROM `users`;";
	
	// echo"$query"; 
	// stop();

	$result = mysqli_query($conn, $query);

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		echo "Nothing here";
	} else {


		while ($row = mysqli_fetch_assoc($result)) {
			$name = $row['name'];
			$email = $row['email'];
			$number = $row['number'];
			$id = $row['id'];
			$surname = $row['surname'];
			$image = $row['image'];
			$account_status = $row['account_status'];
			$register_date = $row['register_date'];
			$email_verified = $row['email_verified'];
			$last_login = $row['last_login'];
			$address_line_1 = $row['address_line_1'];
			$address_line_2 = $row['address_line_2'];
			$city_district = $row['city_district'];
			$state_province = $row['state_province'];
			$zip_postal_code = $row['zip_postal_code'];
			$country = $row['country'];

			echo "<table border='1'>
			<tr>
			<td>Name</td>
			<td>$name</td>
			</tr>
			<tr>
			<td>Surname</td>
			<td>$surname</td>
			</tr>
			<tr>
			<td>Number</td>
			<td>$number</td>
			</tr>
			<tr>
			<td>Email</td>
			<td>$email</td>
			</tr>
			</tr>
			<td>image</td>
			<td><img src='images/$image' width='300px'>;</td>
			</tr>
			<tr>
			<td>id</td>
			<td>$id</td>
			</tr>
			</table><br><br>";
		}
	}
	$location = "index.php";
	go_to($location);

}

if (isset($_POST['logout'])) {
	$datetime = "Date " . date("Y-m-d @ h:i:s a");

	$ipaddress = get_ipaddress();

	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$surname = $_SESSION['surname'];
	$id = $_SESSION['id'];
	$logs_id = rand(10000,99999);
	$ipaddress = get_ipaddress();
	//$ipaddress = implode(" ",$ipaddress);
	$device = get_device();
	insert_info($conn,$dbname,'logs_out','id',$logs_id);
	update_info($conn,$dbname,'logs_out','name','id',$name,$logs_id);
	update_info($conn,$dbname,'logs_out','device','id',$device,$logs_id);
	update_info($conn,$dbname,'logs_out','email','id',$email,$logs_id);
	update_info($conn,$dbname,'logs_out','surname','id',$surname,$logs_id);
	update_info($conn,$dbname,'logs_out','ipaddress','id',$ipaddress,$logs_id);
	update_info($conn,$dbname,'logs_out','datetime','id',$datetime,$logs_id);
	logout();
	alert('you have been logged out');
	$location = "index.php";
	go_to($location);
}

if (isset($_POST['close'])) {

	$email = $_SESSION['email'];

	$sql = "DELETE FROM `users` WHERE `email` = '$email';";

	$result = mysqli_query($conn,$sql);
	if($result){
		echo("<script type=\"text/javascript\">
			alert(\"Your profile has been deleted.\");
			</script>");
		logout();
		$location = "index.php";
		go_to($location);
	}else{
		alert("Note deleted");
		redirect_back();
	}
}

if (isset($_POST['changes'])) {
	$name = post_check("name");
	$name = sanitizeString($name);
	$email = post_check("email");
	$email = sanitizeString($email);
	$number = post_check("number");
	$number = sanitizeString($number);
	$surname = post_check("surname");
	$surname = sanitizeString($surname);

	update_info($conn,$dbname,'users','email','email',$email,$email);
	
	update_info($conn,$dbname,'users','name','email',$name,$email);
	update_info($conn,$dbname,'users','number','email',$number,$email);
	
	update_info($conn,$dbname,'users','surname','email',$surname,$email);
	alert('Your profile has been updated please login again');
	logout();
	$location = "index.php";
	go_to($location);
}

if (isset($_POST['update_profile_picture'])) {
	$email = post_check("email");
	$email = sanitizeString($email);

	$original_file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$image = sanitizeString($original_file_name);
	$file_type = sanitizeString($file_type);
	$file_size = $_FILES['image']['size']; 	
	$file_tem_loc = $_FILES['image']['tmp_name'];

	$old_image = return_info($conn,'users','image','email',$email);

	$dir = 'images';

	if (unlink($dir.'/'.$old_image)) {
		alert("$old_image has been deleted");
	}
	else {
		alert("$old_image cannot be deleted due to an error");
		// redirect_back();
	}
	$image = image_process($conn,$dir,$image,$file_type,$file_size,$file_tem_loc);
	update_info($conn,$dbname,'users','image','email',$image,$email);

	$dir = 'images';

	$image = image_process($conn,$dir,$image,$file_type,$file_size,$file_tem_loc);

	update_info($conn,$dbname,'users','image','email',$image,$email);

	alert('Your profile has been updated please login again');

	logout();
	$location = "index.php";
	go_to($location);
}