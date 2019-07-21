<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 $name = $_POST["name"];
 $mobile = $_POST["mobile"];
 $age= $_POST["age"];
 $gender= $_POST["gender"];
 $email= $_POST["email"];
 $password = $_POST["password"];
 $city = $_POST["city"];
        $Sql_Query ="insert into user_data(name,mobile,age,gender,email,password,city) values('$name','$mobile','$age','$gender','$email','$password','$city');"; 
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