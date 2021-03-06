<?php
try{
 //$ip=$_GET['ip'];
 $statusCode='';
 $ipAddress='';
 $countryCode='';
 $countryName='';
 $regionName='';
 $zipCode='';
 $latitude='';
 $longitude='';
 $timeZone='';
 $apikey='UPDATE YOUR API KEY HERE';
 $url = 'http://api.ipinfodb.com/v3/ip-city/?key='.$apikey.'&format=json&ip='.$ip;
 $response = file_get_contents($url);
  $json_array=json_decode($response,true);
  
  
	function insert_into_database($statusCode,$statusMessage,$ipAddress,$countryCode,$countryName,$regionName,$cityName,$zipCode,$latitude,$longitude){
		require_once('db_config.php');
		if($statusCode=='OK'){
			$sql='insert into ip_location(statusCode,ipAddress,countryCode,countryName,regionName,zipCode,latitude,longitude,timeZone) value (?,?,?,?,?,?,?,?,?)';
			$stm=mysqli_prepare($conn,$sql);
			mysqli_stmt_bind_param($stm,"sssssssss",$statusCode,$ipAddress,$countryCode,$countryName,$regionName,$zipCode,$latitude,$longitude,$timeZone);
			mysqli_stmt_execute($stm);
		}
	} 

	 
 function display_array_recursive($json_rec){
		if($json_rec){
			foreach($json_rec as $key=> $value){
				if(is_array($value)){
					display_array_recursive($value);
				}else{
					echo $key.'--'.$value.'<br>';
					
					if($key=='statusCode'){
						$statusCode=$value;
					}
					if($key=='statusMessage'){
						$statusMessage=$value;
					}
					if($key=='ipAddress'){
						$ipAddress=$value;
					}
					if($key=='countryCode'){
						$countryCode=$value;
					}
					if($key=='countryName'){
						$countryName=$value;
					}
					if($key=='regionName'){
						$regionName=$value;
					}
					if($key=='cityName'){
						$cityName=$value;
					}
					if($key=='zipCode'){
						$zipCode=$value;
					}
					if($key=='latitude'){
						$latitude=$value;
					}
					if($key=='longitude'){
						$longitude=$value;
						insert_into_database($statusCode,$statusMessage,$ipAddress,$countryCode,$countryName,$regionName,$cityName,$zipCode,$latitude,$longitude);
					}
				}	
			}	
		}	
	}
  	display_array_recursive($json_array);
}catch(Exception $e){
    echo $e->getMessage();
}
?>