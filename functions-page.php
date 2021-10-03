<?php
session_start();
// sever
$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "scibonostream";

 // 6jk/4ZSBR[u8x$@E

$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);

mysqli_select_db($conn, $dbname);


function stop(){
	die();
}

function sanitizeString($var) {    
	//  if (get_magic_quotes_gpc())

	// 	$var = stripsloashes($var);   
	// $var = htmlentities($var);    
	// $var = strip_tags($var); 

	// if (strlen($var) > 400 ) {
	// 	stop("Charachter break fatal error"); 
	// }
	// $var = addslashes($var);
	return $var; 
}


function go_to($var){

	echo("<script type=\"text/javascript\">
		window.location.replace(\"$var\");
		</script>");
	stop();
}

function redirect_back() {
	echo("<script type=\"text/javascript\">
		window.history.go(-1);
		</script>");
	stop();
}

function get_device() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


function get_ipaddress($ip = null, $purpose = "location", $deep_detect = TRUE) {
	///////////////////////////

	//whether ip is from share internet
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
	{
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	}
//whether ip is from proxy
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
	{
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
//whether ip is from remote address
	else
	{
		$ip_address = $_SERVER['REMOTE_ADDR'];
	}
	// return $ip_address;
	$ip = $ip_address;
	/////////////////////////
	$output = NULL;
	if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
		$ip = $_SERVER["REMOTE_ADDR"];
		if ($deep_detect) {
			if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	$continents = array(
		"AF" => "Africa",
		"AN" => "Antarctica",
		"AS" => "Asia",
		"EU" => "Europe",
		"OC" => "Australia (Oceania)",
		"NA" => "North America",
		"SA" => "South America"
	);
	if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
		if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
			switch ($purpose) {
				case "location":
				$output = array(
					"city"           => @$ipdat->geoplugin_city,
					"state"          => @$ipdat->geoplugin_regionName,
					"country"        => @$ipdat->geoplugin_countryName,
					"country_code"   => @$ipdat->geoplugin_countryCode,
					"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
					"continent_code" => @$ipdat->geoplugin_continentCode
				);
				break;
				case "address":
				$address = array($ipdat->geoplugin_countryName);
				if (@strlen($ipdat->geoplugin_regionName) >= 1)
					$address[] = $ipdat->geoplugin_regionName;
				if (@strlen($ipdat->geoplugin_city) >= 1)
					$address[] = $ipdat->geoplugin_city;
				$output = implode(", ", array_reverse($address));
				break;
				case "city":
				$output = @$ipdat->geoplugin_city;
				break;
				case "state":
				$output = @$ipdat->geoplugin_regionName;
				break;
				case "region":
				$output = @$ipdat->geoplugin_regionName;
				break;
				case "country":
				$output = @$ipdat->geoplugin_countryName;
				break;
				case "countrycode":
				$output = @$ipdat->geoplugin_countryCode;
				break;
			}
		}
	}
	return $output;
}

function reload() {
	echo("<script type=\"text/javascript\">
		location.reload();
		</script>");
}

function check_if_empty($var) {
	if (empty($var)) {
		alert("$var input left blank.");
		redirect_back();
		stop();
	}
}

function alert($var) {
	echo("<script type=\"text/javascript\">
		alert(\"$var\");
		</script>");
}

function get_number($var){
	$number = preg_replace('/\D+/', '', "$var");
	return $number;
}

function logout() {
	session_destroy();
}

function post_check($var){
	if (!isset($_POST[$var])) {
		alert("$var input left blank.");
		redirect_back();
	}
	$var = sanitizeString($_POST[$var]);
	check_if_empty($var);
	return $var;
}

function get_check($var){
	if (!isset($_GET[$var])) {
		alert("$var input left blank.");
		redirect_back();
	}
	$var = sanitizeString($_GET[$var]);
	check_if_empty($var);
	return $var;
}

function confirm_match($var,$var2) {
	if ($var === $var2) {
		//check
	} else {
		alert("Password do not match");
		redirect_back();
	}
}

function check_login_email(){

	if (isset($_SESSION['email'])) {
		$email = $_SESSION['email'];
		$name = $_SESSION['name'];
		$number = $_SESSION['number'];
		$account_status = $_SESSION['account_status'];
		# code...
	} else {
		$email =  'none';
		$name = 'none';
		$number = 'none';
		$account_status = 'none';

	}

	$session_details = array($email, $name, $number);
	return ($session_details);	
}

function check_if_exists($varconn,$dbname,$table,$row_title,$info){

	$query = "SELECT `$row_title` FROM `$table` WHERE `$row_title` = '$info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row > 0) {

		alert("The $info credential already exist");
		redirect_back();
		stop();

	}
}

function insert_info($varconn,$dbname,$table,$row_title,$info){
	
	$query = "INSERT INTO `$table` (`$row_title`) VALUES ('$info');";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// stop("$query");

}


function update_info($varconn,$dbname,$table,$row_title,$identifier_row,$info,$identifier_info){
	
	$query = "UPDATE `$table` SET `$row_title` = '$info' WHERE `$table`.`$identifier_row` = '$identifier_info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// stop("$query");
}

function pair_for_login($varconn,$table,$row_title,$info,$security_key,$security_key_info) {

	$query = "SELECT * FROM `$table` WHERE `$row_title` = '$info';";
	
	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
	
	//echo "$query";
	// stop();

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert("No account is registerd to this email");
		redirect_back();
	}

	// $email_verified = return_info($varconn,'users','email_verified',$row_title,$info);
	// if ($email_verified == null) {
	// 	alert('Please verify your email to login.');
	// 	redirect_back();
	// }

	$account_status = "";
	$security_key = "";
	
	while ($row = mysqli_fetch_assoc($result)) {
		// $account_status = $row['account_status'];
		$security_key = $row['password'];
	}
	
	// if ($account_status == 'not active') {
	// 	alert('Account not active');
	// 	redirect_back();
	// }

	if (password_verify($security_key_info, $security_key)){
		$security_key = $security_key_info;
	}
	
	if ($security_key !== $security_key_info ){
		alert("Password incorrect");
		redirect_back();
		stop();
	}

	$query = "SELECT * FROM `$table` WHERE `$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));


	while ($row = mysqli_fetch_assoc($result))
	{ 
		$email = $_SESSION['email'] = $row['email'];
		$name = $_SESSION['name'] = $row['name'];
		$number = $_SESSION['number'] = $row['number'];
		$surname = $_SESSION['surname'] = $row['surname'];
		$image = $_SESSION['image'] = $row['image'];
		$id = $_SESSION['id'] = $row['id'];
		// $account_status = $_SESSION['account_status'] = $row['account_status'];
	}
	// update_info($varconn,'','users','last_login','email',$date,$email);

	alert("You have been logged in");

	

}

function return_info($varconn,$table,$row_title,$identifier_row,$identifier_info){
	
	$query = "SELECT `$row_title` FROM `$table` WHERE `$table`.`$identifier_row` = '$identifier_info';";
	
	$result = mysqli_query($varconn, $query);
	
	// echo("$query");
	// stop();
	while ($row = mysqli_fetch_assoc($result)) {
		$value = $row["$row_title"];

	}

	return $value;
}


function remove($varconn,$dbname,$table,$row_title,$info){

	$query = "DELETE FROM `$table` WHERE `$table`.`$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

}

function show_products($varconn,$dbname,$table,$status){

	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_products.php");
}

function show_product_in_cart($varconn,$dbname,$table,$status,$id){

	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_product_in_cart.php");
}

function show_products_to_change($varconn,$dbname,$table,$status){

	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_products_to_change.php");
}

function show_products_in_catagory($varconn,$dbname,$table,$status,$catagory){

	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_products_in_catagory.php");
}

function show_one_product($varconn,$dbname,$table,$status,$id){
	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_one_product.php");
}

function users_action($varconn,$dbname,$table){
	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_users.php");
}

function orders_action($varconn,$dbname,$table){
	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show_orders.php");
}

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

function send_email($sender_email,$reciever_email,$reciever_name,$subject,$body){
	////////////////////////////////////////////////////////////////

	//Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = "$sender_email";                     //SMTP username
    $mail->Password   = 'hidden';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom("$sender_email", 'Noreply');
    $mail->addAddress("$reciever_email");     //Add a recipient
    $mail->addAddress("$sender_email");               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "$subject";
    $mail->Body    = "$body";
    $mail->AltBody = "$body";

    $mail->send();
    alert("We sent you an email, please see your inbox");
} catch (Exception $e) {
	alert("Oops. Something went wrong. You might not recieved an email");
}

	///////////////////////////////////////////////////////////////
}