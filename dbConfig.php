<?php
session_start()
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "mydb";


$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n".mysqli_connect_error());
echo "Connected Successfully";
return $conn;

mysqli_connect_error();

?>