<?php
include 'server.php';

    $email = $_SESSION['email'];

    $sql = "DELETE FROM `users` WHERE `email` = '$email';";

    $result = mysqli_query($con,$sql);
    if($result){
        echo("<script type=\"text/javascript\">
		alert(\"Your profile has been deleted.\");
		</script>");
        header('location:index.php');
    }else{
        echo"Note deleted";
    }


?>