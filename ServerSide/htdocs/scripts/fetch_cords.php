<?php  
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
 $req_id = $_POST["req_id"];
$sql = "SELECT * FROM `assigned` WHERE req_id='$req_id'";
 $res = mysqli_query($con,$sql) or die("Query Not Executed " . mysqli_error($con));
    $data_array = array();
	$final = array();
	
    while($rows =mysqli_fetch_assoc($res))
    {
        $data_array[] = $rows;
    }

		$a_id=$data_array[0]['a_id'];
		$h_id=$data_array[0]['h_id'];
		$user_id=$data_array[0]['user_id'];
	$sql1 = "SELECT * FROM `ambulance_reg` WHERE a_id='$a_id'";
 $res1 = mysqli_query($con,$sql1) or die("Query Not Executed " . mysqli_error($con));
    $data_array1 = array();
    while($rows =mysqli_fetch_assoc($res1))
    {
        $data_array1[] = $rows;
    }
		$final[0]['a_id']=$data_array1[0]['a_id'];
		$final[0]['a_lat']=$data_array1[0]['lat'];
		$final[0]['a_lon']=$data_array1[0]['lon'];
	
	$sql2 = "SELECT * FROM `hospital_reg` WHERE h_id='$h_id'";
 $res2 = mysqli_query($con,$sql2) or die("Query Not Executed " . mysqli_error($con));
    $data_array2 = array();
    while($rows =mysqli_fetch_assoc($res2))
    {
        $data_array2[] = $rows;
    }
		$final[0]['h_id']=$data_array2[0]['h_id'];
		$final[0]['h_lat']=$data_array2[0]['lat'];
		$final[0]['h_lon']=$data_array2[0]['lon'];
		
	$sql3 = "SELECT * FROM `acc_reg` WHERE user_id='$user_id'";
 $res3 = mysqli_query($con,$sql3) or die("Query Not Executed " . mysqli_error($con));
    $data_array3 = array();
    while($rows =mysqli_fetch_assoc($res3))
    {
        $data_array3[] = $rows;
    }
		$final[0]['user_id']=$data_array3[0]['user_id'];
		$final[0]['user_lat']=$data_array3[0]['lat'];
		$final[0]['user_lon']=$data_array3[0]['lon'];	
		
$final[0]['req_id']=$req_id;	
		
	
$data_array[0]['state']=0;	
if(isset($final) && $final!=[] && $final!='null')
{

$final[0]['state']=1;
echo json_encode($final);
 // $arr = array ('state'=>1,'email'=>$email,'name'=>$name);
 //echo json_encode($data_array); // {"a":1,"b":2,"c":3,"d":4,"e":5}
//echo 1;
}else{
	echo 0;
}}
mysqli_close($con);
?>  