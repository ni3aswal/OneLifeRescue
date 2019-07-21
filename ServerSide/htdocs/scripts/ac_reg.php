<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $description = $_POST["description"];
 $category= $_POST["category"];
 $img = $_POST["img"];
 $lat = $_POST["lat"];
 $lon = $_POST["lon"];
 $tableName = "ambulance_reg";
$origLat =  $_POST["lat"];
$origLon =  $_POST["lon"];
$dist = 20000; // This is the maximum distance (in miles) away from $origLat, $origLon in which to search
$query = "SELECT a_id, name, regno,mobile, 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - lat)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(lat*pi()/180)
          *POWER(SIN(($origLon-lon)*pi()/180/2),2))) 
          as distance FROM $tableName WHERE busy=0 and
          lon between ($origLon-$dist/cos(radians($origLat))*69) 
          and ($origLon+$dist/cos(radians($origLat))*69) 
          and lat between ($origLat-($dist/69)) 
          and ($origLat+($dist/69)) 
          having distance < $dist ORDER BY distance limit 1"; 
$result =mysqli_query($con,$query) or die("Query Not Executed " . mysqli_error($con));
$data_array = array();
    while($rows = mysqli_fetch_assoc($result))
    {
        $data_array[] = $rows;
    }
	
	$a_id=$data_array[0]['a_id'];
	$query = "Update ambulance_reg set busy=1 where a_id='$a_id'"; 
$result =mysqli_query($con,$query) or die("Query Not Executed " . mysqli_error($con));

	//$data_array[0]['state'];																		
//echo json_encode($data_array);

$tableName = "hospital_reg";
$origLat =$lat;
$origLon =  $lon;
$dist = 20000;
$query = "SELECT h_id,h_name,regno,mobile, 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - lat)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(lat*pi()/180)
          *POWER(SIN(($origLon-lon)*pi()/180/2),2))) 
          as distance FROM $tableName WHERE 
          lon between ($origLon-$dist/cos(radians($origLat))*69) 
          and ($origLon+$dist/cos(radians($origLat))*69) 
          and lat between ($origLat-($dist/69)) 
          and ($origLat+($dist/69)) 
          having distance < $dist ORDER BY distance limit 1"; 
$result =mysqli_query($con,$query) or die("Query Not Executed " . mysqli_error($con));
$data_array = array();
    
	while($rows = mysqli_fetch_assoc($result))
    {   $data_array[] = $rows; 
	} 
		$h_id=$data_array[0]['h_id'];
		$Sql_Query="insert into acc_reg(description,category,img,a_lat,a_lon,a_id,h_id) values('$description','$category','$img','$lat','$lon','$a_id','$h_id')";
		$q= mysqli_query($con,$Sql_Query);
	if($q)
{ 

		$Sql_Query="SELECT * FROM assigned where a_id='$a_id' AND h_id='$h_id' order by created_at DESC limit 1; ";
		$result =mysqli_query($con,$Sql_Query) or die("Query Not Executed " . mysqli_error($con));	
		if($result){
			$data_array1 = array();
		while($rows = mysqli_fetch_assoc($result))
		{   $data_array1[] = $rows; 
		} 
			//echo json_encode($data_array1);
		$data_array1[0]['state']=0;
		
		if(isset($data_array1) && $data_array1!=[] && $data_array1!='null')
		{
		$data_array1[0]['state']=1;
		echo json_encode($data_array1);
		
		}

		else
		{
			echo 0;
		} 
		}
}
		mysqli_close($con); }
	else
	{ echo "Error";	}
?>  