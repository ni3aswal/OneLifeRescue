<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $mobile1 = $_POST["mobile1"];
 $mobile2 = $_POST["mobile2"];
 $mobile3 = $_POST["mobile3"];
 $mobile4 = $_POST["mobile4"];
 $mobile5 = $_POST["mobile5"];
 $user_name= $_POST["user_name"];

   
		$Sql_Query="insert into sos(mobile1,mobile2,mobile3,mobile4,mobile5,user_name) values('$mobile1','$mobile2','$mobile3','$mobile4','$mobile5','$user_name');";
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