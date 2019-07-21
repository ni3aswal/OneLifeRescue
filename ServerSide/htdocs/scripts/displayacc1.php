<?php
include 'connect.php';
$vid= $_POST["vid"];
$sql = "SELECT * FROM `acc_reg`,`hospital_reg`,`ambulance_reg`  WHERE user_id='$vid' and acc_reg.h_id=hospital_reg.h_id and acc_reg.a_id=ambulance_reg.a_id";
 $res = mysqli_query($con,$sql) or die("Query Not Executed " . mysqli_error($con));

    $data_array = array();
	
    while($rows =mysqli_fetch_assoc($res))
    {
        $data_array[] = $rows;
    }
//$data_array[0]['state']=0;	//no data
if(isset($data_array) && $data_array!=[] && $data_array!='null')
{
//$data_array[0]['state']=1; //data found
 // $arr = array ('state'=>1,'email'=>$email,'name'=>$name);
 echo json_encode($data_array); // {"a":1,"b":2,"c":3,"d":4,"e":5}

//echo 1;
}
else{
	echo 0;
}
mysqli_close($con);

?>