<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 $name = $_POST["name"];
 $regno = $_POST["regno"];
 $mobile = $_POST["mobile"];
 $email= $_POST["email"];
 $password = $_POST["password"];
 $address = $_POST["address"];
  $lat = $_POST["lat"];
  $lon = $_POST["lon"];
        $Sql_Query ="insert into hospital_reg(name,regno,mobile,email,password,address,lat,lon) 
		values('$name','$regno','$mobile','$email','$password','$address','$lat','$lon');"; 
		$q= mysqli_query($con,$Sql_Query);
		if($q)
		{
		echo 1;
		}
		mysqli_close($con);
	}
	
	else
	{
		echo "Error";
	}

 ?>  