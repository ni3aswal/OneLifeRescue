<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 $name = $_POST["name"];
 $regno = $_POST["regno"];
 $mobile = $_POST["mobile"];
 $email= $_POST["email"];
 $password = $_POST["password"];
        $Sql_Query ="insert into ambulance_reg(name,regno,mobile,email,password) values('$name','$regno','$mobile','$email','$password');"; 
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