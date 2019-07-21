<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
  $img = $_POST["img"];
 $name = $_POST["name"];
 $mobile = $_POST["mobile"];
 $description= $_POST["description"];
 $location = $_POST["location"];
 $status = $_POST["status"];
        $Sql_Query ="insert into people_data(img,name,mobile,description,location,status) values('$img','$name','$mobile','$description','$location','$status');"; 
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